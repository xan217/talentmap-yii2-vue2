<template>
   <div class="subcomponent-container">
      <v-toolbar color="grey lighten-3" dense>
         <v-toolbar-title>GRUPOS CONDICIONALES</v-toolbar-title>

         <v-spacer></v-spacer>

         <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
               <v-btn icon color="green" @click="addConstraint()"  v-bind="attrs" v-on="on">
                  <v-icon>mdi-filter</v-icon>
               </v-btn>
            </template>
            <span>Agregar grupo condicional</span>
         </v-tooltip>
         <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
               <v-btn icon color="indigo" @click="getData()"  v-bind="attrs" v-on="on">
                  <v-icon>mdi-graphql</v-icon>
               </v-btn>
            </template>
            <span>Crear Grafo</span>
         </v-tooltip>
         <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
               <v-btn icon color="red" @click="removeContraints()"  v-bind="attrs" v-on="on">
                  <v-icon>mdi-eraser</v-icon>
               </v-btn>
            </template>
            <span>Limpiar condicionales</span>
         </v-tooltip>
         <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
               <v-btn icon color="orange" @click="print()"  v-bind="attrs" v-on="on">
                  <v-icon>mdi-printer</v-icon>
               </v-btn>
            </template>
            <span>Imprimir</span>
         </v-tooltip>
         
      </v-toolbar>
      <v-list v-if="constraints.length">
         <v-list-group v-for="(constraint, i) in constraints" :key="i" v-model="constraint.displayed" no-action>
            <template v-slot:activator>
               <v-list-item-content>
                  <v-list-item-title>Grupo condicional {{i+1}}</v-list-item-title>
               </v-list-item-content>
            </template>
            <v-list-item>
               <br>
               <v-row class="pt-3">
                  <v-col v-for="(filter, index) in filters" :key="index" col="12" md="4" >
                     <v-item-group>
                        <v-item>
                           <v-select 
                              v-model="constraint[filter.model]" 
                              :items="filter.items" 
                              item-text="label"
                              item-value="value"
                              :label="filter.name">
                           </v-select>
                        </v-item>
                     </v-item-group>
                  </v-col>
               </v-row>
            </v-list-item>
         </v-list-group>
      </v-list>
   </div>
</template>

<script>
import Vue from 'vue';

export default {
   name: "Constraints",
   data: () => ({
      data: [],
      filters: [],
      constraints: [],
      constraintModel: {},
      loadedFilters: false
   }),
   async mounted(){
      try{
         const response = await Vue.fetchData('GET', 'rest/get-conditions');
         this.filters = response.data.map( constraint => ({
            id: constraint.id,
            name: constraint.label,
            model: constraint.field,
            items: [...constraint.values, {label:"SIN INFORMACIÓN", value: null}],
            requirement: constraint.requirements
         }));
         response.data.forEach( constraint => {
            this.constraintModel[constraint.field] = "";
         });
         this.addConstraint();
      }
      catch( e ){
         console.log(e)
         Vue.$toast.open({ 
            message: 'Ha ocurrido un erro al cargar los datos',
            type: 'error',
            dismissible: true,
            pauseOnHover: true,
            duration: 5000
         });
      }
   },
   methods: {
      getData(){
         Vue.fetchData( 'POST', 'rest/get-groups', this.constraints ).then( response => {
            console.log( response.data );
            //this.$emit('updateitems', this.data);
         });
      },
      addConstraint(){
         let model = Object.assign({}, this.constraintModel );
         model.displayed = false;
         this.constraints.push(model);
      },
      removeContraints(){
         this.constraints = [];
         this.addConstraint();
      },
      print(){
         Vue.$toast.open({ 
            message: 'Función deshabilitada temporalmente.',
            type: 'warning',
            dismissible: true,
            pauseOnHover: true,
            duration: 5000
         });
      }
   },
   watch: {
   }
}
</script>
<style src="./constraints.css"></style>