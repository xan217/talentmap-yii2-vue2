<template>
  <v-app>
    <v-card>
      <v-toolbar color="indigo darken-4" dark flat >
         <v-app-bar-nav-icon></v-app-bar-nav-icon>

         <v-toolbar-title class="justify-center py-6">
            <h2>
               CORPREFER
            </h2>
         </v-toolbar-title>

         <v-spacer></v-spacer>

         <template v-slot:extension>
            <v-tabs v-model="tab" grow icons-and-text>
               <v-tabs-slider color="amber lighten-1"></v-tabs-slider>

               <v-tab v-for="(item, index) in items" :key="index" :click="currentView = item.component">
                  <p>{{ item.name }}<br></p>
                  <v-icon>{{ item.icon }}</v-icon>
               </v-tab>
            </v-tabs>
         </template>
      </v-toolbar>

      <v-tabs-items v-model="tab">
         <v-tab-item v-for="(item, index) in items" :key="index" >
            <v-card flat :key="index">
              <component :is="item.component"></component>
            </v-card>
         </v-tab-item>
      </v-tabs-items>
    </v-card>
    <footer class="foot">
       
    </footer>
  </v-app>
</template>

<script>
import Chart  from './pages/chart/chart.vue';
import Graph  from './pages/graph/graph.vue';
import Home   from './pages/home/home.vue';
import Users  from './pages/users/users.vue';
import Values from './pages/values/values.vue';

export default {
  name: 'App',

  components: {
      Home,
      Values,
      Users,
      Graph,
      Chart
  },

  data: () => ({
    currentView: 'Home',
    tab: null,
    items: [
      { name: 'Inicio', icon: 'mdi-home', component: 'Home'}, 
      { name: 'Valores', icon: 'mdi-clipboard-list', component: 'Values'}, 
      { name: 'Usuarios', icon: 'mdi-account-group', component: 'Users'}, 
      { name: 'Mapa de Talentos', icon: 'mdi-graph', component: 'Graph'}, 
      { name: 'Reportes', icon: 'mdi-chart-histogram', component: 'Chart'}
    ],
    text: ''
    }),
};
</script>

<style src="./App.css"></style>