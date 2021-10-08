<template>
  <div class="graphContainer">
    <div ref="echart" style="width:inherit;height:400px;" ></div>
    <v-container class="px-0  justify-center" flex >
      <v-icon :color="!typePie ? company.tertiaryColor : 'grey'"> mdi-chart-pie </v-icon>
      <v-switch v-model="typePie" id="switch" name="switch" color="ligtgray"></v-switch>
      <v-icon :color="typePie ? company.tertiaryColor : 'grey'"> mdi-chart-bar </v-icon>
    </v-container>
  </div>
</template>

<script>
import Vue from 'vue';
import * as echarts from 'echarts/core';
import { CanvasRenderer } from "echarts/renderers";
import { PieChart } from "echarts/charts";
import { BarChart } from "echarts/charts";
import {
  TitleComponent,
  TooltipComponent,
  GridComponent,
  DatasetComponent,
  TransformComponent,
  LegendComponent 
} from 'echarts/components';
import { LabelLayout, UniversalTransition } from 'echarts/features';

echarts.use([
  TitleComponent,
  TooltipComponent,
  GridComponent,
  DatasetComponent,
  TransformComponent,
  BarChart,
  PieChart,
  LabelLayout,
  UniversalTransition,
  CanvasRenderer,
  LegendComponent
]);

export default {
  name: "Pie",
  props: {
    dataset: {},
    title: null
  },
  data: () => ({
    localProps: {},
    chart: null,
    company: Vue.company,
    typePie: false,
    dataset_empty: {
      dimensions: [],
      source: []
    },
    options: {},
    pie: {
      showEmptyCircle: true,
      title:{
        show: true,
        text: ''
      },
      series: [
        {
          type: 'pie',
          // associate the series to be animated by id
          id: 'Score',
          radius: [0, '50%'],
          universalTransition: true,
          animationDurationUpdate: 1000
        }
      ],
      tooltip: {
        show: true ,
        trigger: "item",
        formatter: "{b}: {d}%"
      },
      legend: {
        orient: "vertical",
        left: "left",
      }
    },
    bars: {
      title:{
        show: true,
        text: ''
      },
      xAxis: {
        type: 'category'
      },
      yAxis: {},
      series: [
        {
          type: 'bar',
          id: 'Score',
          colorBy: 'data',
          encode: { x: 'name', y: 'score' },
          universalTransition: true,
          animationDurationUpdate: 1000
        }
      ],
      tooltip: {
        show: true ,
        trigger: 'item' ,
        formatter: "{c0}"
      },
      legend: {
        orient: "vertical",
        left: "left",
      }
    }
  }),
  mounted(){
    this.chart = echarts.init(this.$refs["echart"]);
    this.options = {...this.pie, dataset: [this.dataset_empty]};
    this.chart.setOption(this.options);
  },
  methods: {
    updateData() {
      if( this.typePie ){
        this.options = {...this.bars, dataset: [this.dataset]};
      }
      else{
        this.options = {...this.pie, dataset: [this.dataset]};
      }
      this.chart.setOption(this.options, true);
    },
  },
  watch: {
    typePie: {
      handler() {
        console.log( this.typePie );
        this.updateData();
      }
    },
    dataset: {
      deep: true,
      async handler(newVal){

        this.options.dataset[0].source = this.dataset.source;
        this.options.tooltip = newVal.tooltip;

        this.updateData();
      }
    }
  }
};
</script>

<style scoped>
.graphContainer {
  width: 100%;
  display: grid;
  grid-template-rows: 350px 100px;
  height: 450px;
}
body {
  margin: 0;
}
</style>