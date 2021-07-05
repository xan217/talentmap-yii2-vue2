import Vue from 'vue';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import Functions from './plugins/functions';

import VueToast from 'vue-toast-notification';
import Vuetify from 'vuetify/lib';

import es from 'vuetify/lib/locale/es'

import 'materialize-css/dist/css/materialize.css';
import 'materialize-css/dist/js/materialize.js';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.config.productionTip = false;
Vue.use(Functions);
Vue.use(Vuetify);
Vue.use(VueToast);

new Vue({
  vuetify,
  Functions,
  render: h => h(App),
  lang: {
   locales: { es },
   current: 'es',
 },
}).$mount('#app')
