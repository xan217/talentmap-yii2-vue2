<template>
   <div class="subcomponent-container" v-if="tableHeaders.length && modelDefinition.items">
      <v-data-table :headers="tableHeaders" :items="modelDefinition.items" class="elevation-2" locale="es">
         <template v-slot:top>
            <v-toolbar flat >
               <v-toolbar-title>{{ modelDefinition.name || 'Seleccione un Filtro' }}</v-toolbar-title>
               <v-spacer></v-spacer>
               <v-dialog v-model="dialog" max-width="60%" v-if="modelDefinition.name && editable" >
                  <template v-slot:activator="{ on, attrs }" >
                     <v-btn :color="companyConfig.primaryColor" dark class="mb-2" v-bind="attrs" v-on="on" >
                        Agregar
                     </v-btn>
                  </template>
                  <v-card v-if="formFields.length">
                     <v-card-title>
                        <span class="text-h5">{{ formTitle }}</span>
                     </v-card-title>

                     <v-card-text >
                        <v-row>
                           <v-col 
                              v-for="(item, index) in formFields" 
                              :class="item.containerClasses"
                              :md="item.size" 
                              :key="index" 
                              col="12" 
                           >
                              <v-item-group>
                                 <v-item v-if="item.type === 'block'">
                                    <span class="sectionTitle" color="indigo darken-4"><b>{{ item.label }}</b></span>
                                 </v-item>
                                 <!-- UNDER DEVELOPMENT -->
                                 <!-- #TODO: make a conditional constraint over another field -->
                                 <v-item v-else-if="item.requirements">
                                    <v-select 
                                       v-if="editedItem"
                                       v-model="editedItem[item.field]" 
                                       :items="item.list" 
                                       :label="item.label"
                                       :required="item.required"
                                       @change="item.requirements ? loadExtraData(item) : () => {}"
                                       :class="item.fieldClasses">
                                    </v-select>
                                    <v-select 
                                       v-if="editedItem"
                                       v-model="editedItem[item.field]" 
                                       :items="item.list" 
                                       :label="item.label"
                                       :required="item.required"
                                       :class="item.fieldClasses">
                                    </v-select>
                                 </v-item>
                                 <!-- ################## -->
                                 <v-item v-else-if="item.type === 'text' || item.type === 'number'">
                                    <v-text-field 
                                       v-if="editedItem"
                                       v-model="editedItem[item.field]" 
                                       :label="item.label" 
                                       :type="item.type" 
                                       :required="item.required"
                                       :class="item.fieldClasses"
                                       :min="item.type === 'number' ? 0 : ''">
                                    </v-text-field>
                                 </v-item>
                                 <v-item v-else-if="item.type === 'select' || item.type === 'enum'">
                                    <v-select 
                                       v-if="editedItem"
                                       v-model="editedItem[item.field]" 
                                       :items="item.list" 
                                       :label="item.label"
                                       :required="item.required"
                                       :class="item.fieldClasses">
                                    </v-select>
                                 </v-item>
                              </v-item-group>
                           </v-col>
                        </v-row>
                     </v-card-text>

                     <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn :color="companyConfig.tertiaryColor" text @click="close" >
                           Cancelar
                        </v-btn>
                        <v-btn :color="companyConfig.primaryColor" text @click="save" >
                           Guardar
                        </v-btn>
                     </v-card-actions>
                  </v-card>
               </v-dialog>
               <v-dialog v-if="tableHeaders[tableHeaders.length - 1].value === 'actions' && editable" v-model="dialogDelete" max-width="500px">
                  <v-card>
                     <v-card-title class="text-h5">¿Seguro deseas eliminar este registro?</v-card-title>
                     <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn :color="companyConfig.primaryColor" text @click="closeDelete">No</v-btn>
                        <v-btn :color="companyConfig.tertiaryColor" text @click="deleteItemConfirm">Si</v-btn>
                        <v-spacer></v-spacer>
                     </v-card-actions>
                  </v-card>
               </v-dialog>
            </v-toolbar>
         </template>
         <template v-if="tableHeaders[tableHeaders.length - 1].value === 'actions' && editable" v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)" :color="companyConfig.secondaryColor" >
               mdi-pencil
            </v-icon>
            <v-icon small @click="deleteItem(item)" :color="companyConfig.tertiaryColor" >
               mdi-delete
            </v-icon>
         </template>
      </v-data-table>
   </div>
</template>

<script>
   import Vue from 'vue';

   export default {
      name: "Users",
      data: () => ({
         dialog: false,
         dialogDelete: false,
         defaultItem: null,
         editedItem: null,
         editedIndex: -1,
         condotionalSelects: [],
         responses: [ 'success', 'info', 'warning', 'error', 'default' ],
         companyConfig: Vue.company
      }),
      props: {
         tableHeaders: [],
         itemModel: {},
         formFields: [],
         selectableLists: [],
         modelDefinition: {},
         editable: null,
         controller: null
      },
      mounted () {
         this.defaultItem = Object.assign({}, this.itemModel);
         this.editedItem = Object.assign({}, this.itemModel);   
         console.log('tableHeaders', this.tableHeaders)     
         console.log('modelDefinition', this.modelDefinition)     
         // #TODO: Subcondition issue
         // this.conditionalSelects = this.modelDefinition.items.filter( item => item.rerequirement );
      },
      methods: {
         changeLocale () {
            this.$vuetify.lang.current = 'es';
         },
         editItem (item) {
            this.editedIndex = this.modelDefinition.items.indexOf(item);
            this.editedItem = Object.assign({}, this.modelDefinition.items[this.editedIndex]);
            this.dialog = true;
         },
         
         deleteItem (item) {
            this.editedIndex = this.modelDefinition.items.indexOf(item);
            this.editedItem = Object.assign({}, this.modelDefinition.items[this.editedIndex]);
            this.dialogDelete = true;
         },
         
         deleteItemConfirm () {
            const editedIndex = this.editedIndex;
            Vue.fetchData('DELETE', `${this.controller}/delete?name=${this.modelDefinition.model}`, this.editedItem )
            .then( response => {
               if( response.status === 200 ){
                  this.modelDefinition.items.splice( editedIndex, 1 );
                  Vue.$toast.open({ 
                     message: response.message,
                     type: response.type,
                     dismissible: true,
                     pauseOnHover: true
                  });
               }
            });

            this.closeDelete();
         },
         
         close () {
            this.dialog = false;
            this.editedItem = Object.assign({}, this.defaultItem);
            this.editedIndex = -1;
         },
         
         closeDelete () {
            this.dialogDelete = false;
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1;
         },
         
         async save () {
            /** */
            let serverResponse = {
               message: '',
               type: 'default'
            };
            const editedIndex = this.editedIndex;
            if( this.editedIndex > -1 ){
               await Vue.fetchData(
                  'PATCH', 
                  `${this.controller}/update?name=${this.modelDefinition.model}`, 
                  this.editedItem
               )
               .then( response => {
                  if( response.status === 200 ){
                     this.modelDefinition.items[editedIndex] = Object.assign({}, response.data);
                  }
                  serverResponse = response;
               });
            }
            else{
               await Vue.fetchData(
                  'POST', 
                  `${this.controller}/create?name=${this.modelDefinition.model}`, 
                  this.editedItem
               )
               .then( response => {
                  if( response.status === 200 ){
                     this.modelDefinition.items.push(
                        response.data
                     );
                  }
                  serverResponse = response;
               });
            }

            if(this.responses.indexOf(serverResponse.type.toLowerCase()) === -1){
               serverResponse.message = 'Error en el servidor. Favor revise el log de transacciones.';
               serverResponse.type = 'error';
            }

            Vue.$toast.open({ 
               message: serverResponse.message,
               type: serverResponse.type,
               dismissible: true,
               pauseOnHover: true,
               duration: serverResponse.type === 'error' ? 5000 : 3000
            });
            this.close();
            this.$emit('reloadData');
            /** */
         },

         // #TODO: Subcondition issue
         async loadExtraData( item ) {
            let editingItem = -1;
            await Vue.fetchData(
               'GET', 
               `${this.modelDefinition.model}/get-subcondition`, 
               item.table
            )
            .then( response => {
               if( response.status === 200 ){
                  editingItem = this.modelDefinition.items.indexOf( constraint => constraint.model == item.table);
                  this.modelDefinition.items[editingItem].items = editingItem !== -1
                     ?  response.data
                     : [];
               }
            });
         }
      },
      computed: {
         formTitle () {
            return this.editedIndex === -1 ? `Nuevo ${this.modelDefinition.name}` : `Editar ${this.modelDefinition.name}`
         },
      },
      watch: {
         dialog( val ) {
            val || this.close();
         },
         dialogDelete( val ) {
            val || this.closeDelete()
         }
      }
   }
</script>
<style src="./table.css"></style>