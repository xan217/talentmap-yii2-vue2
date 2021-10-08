<template>
  <div class="component_container">
    <div class="flex">
      <v-navigation-drawer permanent class="w-25">
         <v-list-item>
            <v-list-item-content>
               <v-list-item-title class="text-h6">
                  Valores
               </v-list-item-title>
               <v-list-item-subtitle class="description">
                  Los datos seleccionables en esta sección son los valores que se desplegarán directamente en los campos de los filtros.
               </v-list-item-subtitle>
            </v-list-item-content>
         </v-list-item>

         <v-divider></v-divider>

         <v-list dense nav>
            <v-list-item-group v-model="selectedModel" >
               <v-list-item v-for="item in filters" :key="item.model" >
                  <v-list-item-content>
                     <v-list-item-title>{{ item.name }}</v-list-item-title>
                  </v-list-item-content>
               </v-list-item>
            </v-list-item-group>
         </v-list>
      </v-navigation-drawer>
      <v-container class="w-74 mt-3">
         <div class="values" v-if="filters.length">
            <Table 
               :tableHeaders="tableHeaders"
               :itemModel="itemModel"
               :formFields="formFields"
               :modelDefinition="modelDefinition"
               :editable="true"
               :controller="'models'"
            />
         </div>
      </v-container>
    </div>
  </div>
</template>

<script>
   import Vue from 'vue';
   import Table from '../../components/table/table';

   export default {
      name: "Values",
      components: {
         Table
      },
      data: () => ({
         editedIndex: -1,
         right: null,
         selectedModel: null,
         dialog: false,
         dialogDelete: false,
         filters: [],
         modelDefinition: 
            { id: null, name: null, model: null, items: [] },
         formFields: [
            { label: 'Nombre', field: 'label', size: 12, type: 'text', required: true, containerClasses: '', fieldClasses: 'required'}
         ],
         itemModel: 
            { value: '', label: '' },
         tableHeaders: [
            { text: "Valor",     value: "label",      align: "start",   sortable: true },
            { text: 'Acciones',  value: 'actions',    align: 'end',     sortable: false },
         ],
      }),
      mounted(){
         try{
            Vue.fetchData('GET', 'rest/get-conditions').then( response => {
               this.selectedModel = response.data[0].model;
               this.filters = response.data.map( constraint => ({
                  id: constraint.id,
                  name: constraint.label,
                  model: constraint.field,
                  items: constraint.values,
                  requirement: constraint.requirements
               }));
               this.modelDefinition = this.filters[0];
            });
         }
         catch( e ){
            Vue.$toast.open({ 
               message: 'Ha ocurrido un erro al cargar los datos',
               type: 'error',
               dismissible: true,
               pauseOnHover: true,
               duration: 5000
            });
         }
      },
      methods: {},
      computed: {},
      watch: {
         selectedModel( id ) {
            if( id >= 0 ){
               this.modelDefinition = this.filters[id];
            }
         }
      }
   }
</script>
<style src="./values.css"></style>