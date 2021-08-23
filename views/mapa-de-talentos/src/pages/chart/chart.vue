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
          <Pie :option="options.pie" v-if="!type"/>
          <Bars :option="options.bars" v-if="type"/>
        </div>
        <v-container class="px-0  justify-center" flex >
          <v-icon :color="!type ? company.tertiaryColor : 'grey'"> mdi-chart-pie </v-icon>
          <v-switch v-model="type" id="switch" name="switch" color="ligtgray"></v-switch>
          <v-icon :color="type ? company.tertiaryColor : 'grey'"> mdi-chart-bar </v-icon>
        </v-container>
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
  import Pie from './pie.vue';
  import Bars from './bars.vue';

   export default {
    name: "Charts",
    components: {
        Table,
        Pie,
        Bars
    },
    data: () => ({
      filter: '',
      company: null,
      base_model: null,
      height: 900,
      legend_title: '',
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
      option: {
        title: {
          text: "Traffic Sources",
          left: "center"
        },
        tooltip: {
          trigger: "item",
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          orient: "vertical",
          left: "left",
          data: [
            "Direct",
            "Email",
            "Ad Networks",
            "Video Ads",
            "Search Engines"
          ]
        },
        series: [
          {
            name: "Traffic Sources",
            type: "pie",
            radius: "55%",
            center: ["50%", "60%"],
            data: [
              { value: 335, name: "Direct" },
              { value: 310, name: "Email" },
              { value: 234, name: "Ad Networks" },
              { value: 135, name: "Video Ads" },
              { value: 1548, name: "Search Engines" }
            ],
            emphasis: {
              itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: "rgba(0, 0, 0, 0.5)"
              }
            }
          }
        ]
      },
      options: {
        pie: {
          title: {
            text: "Gráfico de proporciones",
            left: "left"
          },
          legend: {
            orient: "vertical",
            left: "right",
            data: []
          },
          series: [{
            radius: "65%",
            center: ["50%", "60%"],
            label:{
              formatter: `{d}%`
            },
            type: "pie",
            data: []
          }],
          tooltip: {
            show: true ,
            trigger: "item",
            formatter: "{b}: {d}%"
          },
          emphasis: {
            itemStyle: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: "rgba(0, 0, 0, 0.5)"
            }
          }
        },
        
        bars: {
          title: {
            text: "Gráfico de Cantidades",
            left: "left"
          },
          legend: {
            orient: "vertical",
            left: "right",
            data: []
          },
          xAxis: {
            type: 'category',
            data: []
          },
          yAxis: { 
            type: 'value' 
          },
          series: [],
          emphasis: {
            itemStyle: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: "rgba(0, 0, 0, 0.5)"
            }
          },
          label: {
            show: true,
          },
          tooltip: {
            show: true ,
            trigger: 'item' ,
            formatter: "{a}: {c}"
          }
        }
      },
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
      filter: {
        async handler(newFilter) {
          console.log( newFilter );
          this.presentation_bars = false;
          this.presentation_pie = false;

          this.options.pie.legend.data = Array();
          this.options.pie.series[0].data = Array();

          this.options.bars.legend.data = Array();
          this.options.bars.series = Array();
          this.options.bars.xAxis.data = Array();
          this.tableData = Array();

          Vue.fetchData('POST', 'rest/get-graphics', newFilter )
          .then(fetchedData => {
            
            let actualConstraint = this.constraint_list.filter( element => { return element.name == newFilter } )[0];
            this.options.pie.title.text = actualConstraint.label;
            this.options.bars.title.text = actualConstraint.label;

            this.total = fetchedData.data.reduce((acc, element) => acc += parseInt(Object.values(element)[0]), 0);

            this.options.pie.legend.data = fetchedData.data.map( (element, index) => (
              Object.keys(element)[0].toUpperCase()
            ));
            this.options.bars.legend.data = fetchedData.data.map( (element, index) => (
              Object.keys(element)[0].toUpperCase()
            ));

            this.options.pie.series[0].data = fetchedData.data.map( (element, index) => ({
              name: Object.keys(element)[0].toUpperCase(),
              value: parseInt(Object.values(element)[0])
            }));
            this.options.bars.series = fetchedData.data.map( (element, index) => ({
              type: 'bar', 
              name: Object.keys(element)[0].toUpperCase(), 
              data: [parseInt(Object.values(element)[0])]
            }));
            this.modelDefinition.items = fetchedData.data.map( (element, index) => ({
              group: Object.keys(element)[0].toUpperCase(), 
              qty: parseInt(Object.values(element)[0]), 
              proportion: (parseInt(Object.values(element)[0])*100/this.total).toFixed(2)
            }));
            
            this.overlay = false;
            console.log(this.options.bars);
          });
        },
      },
    }
   }
</script>
<style src="./chart.css"></style>