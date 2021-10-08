<template>
   <div class="component_graphics">
      <div class="cosntraints_container">
        <div style="padding: 0px 20px;">
          <v-radio-group v-model="filter" v-if="constraint_list != null && constraint_list != []">
            <v-radio v-for="(item, index) in constraint_list" :key="index" :value="item.name" :color="company.primaryColor">
              <template v-slot:label>
                <div class="uppercase">{{ item.label }}</div>
              </template>
            </v-radio>
          </v-radio-group>
          <v-row v-else>
            Cargando Filtros
          </v-row>
        </div>
      </div>
      <div class="component_data">
        <div class="graphic_container">
          <!-- <Pie :option="options.pie" v-if="!type"/>
          <Bars :option="options.bars" v-if="type"/> -->
          <Echart :dataset="chartData" :title="actualConstraint.label" />
        </div>
        <div class="table_container">
          <Table 
            :tableHeaders="tableHeaders"
            :modelDefinition="modelDefinition"
            :editable="false"
          />
        </div>
      </div>
   </div>
</template>

<script>
  import Vue from 'vue';
  import Table from '../../components/table/table';
  import Echart from './echart.vue';

   export default {
    name: "Charts",
    components: {
        Table,
        Echart
    },
    data: () => ({
      filter: '',
      company: Vue.company,
      base_model: null,
      height: 900,
      actualConstraint: {},
      total: 0,
      tableHeaders: [
        { text: "Grupo",       value: "group",       align: "start",   sortable: true },
        { text: "Cantidad",    value: "qty",         align: "start",   sortable: true },
        { text: "Proporción",  value: "proportion",  align: "start",   sortable: true },
      ],
      modelDefinition: 
        { id: null, name: 'Datos', model: 'models', items: [
          {group: 'No hay datos cargados', qty: 0, proportion: 0}
        ]},
      constraint: null,
      constraint_list: [],
      users_qty: 1,
      users_filtered: 1,
      type: false,
      overlay: false,
      dataset: {
        dimensions: ['value', 'score'],
        source: [],
      },
      chartData: {},
    }),
    mounted(){
      this.company = Vue.company;
      try{
        Vue.fetchData('GET', 'rest/get-conditions').then( response => {
          this.constraint_list = response.data.map( constraint => ({
            name: constraint.field,
            label: constraint.label,
            values: constraint.values
          }))
        });
        Vue.fetchData('GET', 'rest/get-qty').then(fetchedData => {
          this.users_qty = fetchedData.data.users_qty;
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
    methods: {
      setFilter( model ) {
        try{
        Vue.fetchData('GET', 'rest/get-graphics').then( response => {
          this.data = response.data;
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
      }
    },
    watch: {
      type: {
        handler( newVal ){
          this.chartData = newVal ? this.options.bars : this.options.pie;
        }
      },
      filter: {
        async handler(newFilter) {

          Vue.fetchData('POST', 'rest/get-graphics', newFilter )
          .then(fetchedData => {
            
            this.actualConstraint = this.constraint_list.filter( element => { return element.name == newFilter } )[0];
            this.total = fetchedData.data.reduce((acc, element) => acc += parseInt(Object.values(element)[0]), 0);

            this.dataset.source = fetchedData.data.map( element => {
              return [Object.keys(element)[0].toUpperCase(), parseInt(Object.values(element)[0])]
            });

            this.modelDefinition.items = fetchedData.data.map( (element, index) => ({
              group: Object.keys(element)[0].toUpperCase(), 
              qty: parseInt(Object.values(element)[0]), 
              proportion: (parseInt(Object.values(element)[0])*100/this.total).toFixed(2)
            }));
          });
          this.chartData = this.dataset;
          console.log('chartdata', this.chartData)
        },
      },
    }
   }
</script>
<style src="./chart.css"></style>