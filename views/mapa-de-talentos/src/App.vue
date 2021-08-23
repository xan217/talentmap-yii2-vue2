<template>
  <v-app>
    <v-card v-if="company">
      <v-toolbar :color="company.primaryColor" dark flat >

         <v-toolbar-title class="justify-left py-6 title">
            <img :src="company.logo" class="company_logo">
            <h2>{{company.name}}</h2>
         </v-toolbar-title>

         <v-spacer></v-spacer>

         <template v-slot:extension>
            <v-tabs v-model="tab" grow icons-and-text>
               <v-tabs-slider :color="company.tertiaryColor"></v-tabs-slider>

               <v-tab v-for="(item, index) in items" :key="index" :click="currentView = item.component">
                  <p>{{ item.name }}<br></p>
                  <v-icon>{{ item.icon }}</v-icon>
               </v-tab> 
            </v-tabs>
         </template>
      </v-toolbar>

      <v-tabs-items v-model="tab">
         <v-tab-item v-for="(item, index) in items" :key="index" >
            <div flat :key="index" v-if="tab === index">
              <component :is="item.component"></component>
            </div>
         </v-tab-item>
      </v-tabs-items>
    </v-card>
    
    <footer class="foot">
       Desarrollado, registrado y distribuído por <b><a href="#">CORPREFER S.A.S.</a></b> Todos los derechos reservados.
    </footer>
  </v-app>
</template>

<script>
import Vue from 'vue';
import Chart  from './pages/chart/chart.vue';
import Graph  from './pages/graph/graph.vue';
import Home   from './pages/home/home.vue';
import Users  from './pages/users/users.vue';
import Values from './pages/values/values.vue';
import Config from './pages/config/config.vue';

export default {
  name: 'App',

  components: {
      Home,
      Values,
      Users,
      Graph,
      Chart,
      Config
  },

  data: () => ({
    currentView: 'Home',
    tab: null,
    company: null,
    items: [
      { name: 'Inicio', icon: 'mdi-home', component: 'Home'}, 
      { name: 'Mapa de Talentos', icon: 'mdi-graph', component: 'Graph'}, 
      { name: 'Reportes', icon: 'mdi-chart-histogram', component: 'Chart'},
      { name: 'Usuarios', icon: 'mdi-account-group', component: 'Users'}, 
      { name: 'Valores', icon: 'mdi-clipboard-list', component: 'Values'}, 
      { name: 'Configuración', icon: 'mdi-cog', component: 'Config'}
    ],
    text: ''
  }),
  async mounted () {
    await Vue.getCompanyConfig();
    this.company = Vue.company;
    console.log('company in app', this.company);
  }
};
</script>

<style src="./App.css"></style>