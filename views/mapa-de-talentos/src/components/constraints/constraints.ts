import Vue from 'vue';

export default {
   name: "Constraints",
   data: () => ({

   }),
   mounted(){
      console.log('constraints');
      Vue.fetchData('GET', 'get-conditions').then( constraints => {
         console.log( constraints );
      });
   },
   medthods: {

   }
}