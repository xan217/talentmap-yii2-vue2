import Vue from 'vue';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import Request from './plugins/request';

Vue.config.productionTip = false;

Vue.use(Request);

new Vue({
  vuetify,
  Request,
  render: h => h(App)
}).$mount('#app')
