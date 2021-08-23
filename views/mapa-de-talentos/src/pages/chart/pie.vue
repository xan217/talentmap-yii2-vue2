<template>
    <v-chart class="chart" :option="option" />
</template>

<script>
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { PieChart } from "echarts/charts";
import {
  TitleComponent,
  TooltipComponent,
  LegendComponent
} from "echarts/components";
import VChart, { THEME_KEY } from "vue-echarts";

use([
  CanvasRenderer,
  PieChart,
  TitleComponent,
  TooltipComponent,
  LegendComponent
]);

export default {
  name: "Pie",
  props: {
    option: {}
  },
  components: {
    VChart
  },
  provide: {
    [THEME_KEY]: "light"
  },
  data: () => ({
    localProps: {}
  }),
  watch: {
    option: {
      async handler(newVal){
        console.log( 'newVal', newVal );
        this.localProps = Object.assign( {}, newVal );
      }
    }
  }
};
</script>

<style scoped>
.chart {
  width: 100%;
  height: 50vh;
}
</style>

<style>
body {
  margin: 0;
}
</style>