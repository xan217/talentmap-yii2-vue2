<template>
   <div class="component_area">
      <div class="subcomponent_area">
         <Constraints @updateData="updateData" />
      </div>
      <!-- <div class="subcomponent_area">
         <Directed :nodes="nodes"/>
      </div>
      <div class="subcomponent_area">
         <Table :modelDefinition="modelDefinition" :editable="false"/>
      </div> -->
   </div>
</template>

<script>
// import Vue from 'vue';
import Constraints from '../../components/constraints/constraints'
// import Directed from '../../components/directed/directed'
// import Table from '../../components/table/table'


export default {
   name: "Users",
   components: {
      Constraints,
      // Directed,
      // Table,
   },
   data: () => ({
      modelDefinition: 
         { id: null, name: 'Usuario', model: 'userprofile', items: [] },
      nodes: [],
      userBaseModel: {},
      showingUser: {},
      userModal: false,
   }),
   methods: {
      updateData( data ) {
         console.log( data );
         // Process the data
      },
      updateNodes( nodes ) {
         this.nodes = nodes;
      },
      showUser( user ) {
         this.user = user;
         this.userModal = true;
      },
      closeUserModal() {
         this.showingUser = Object.assign({}, this.userBaseModel);
         this.userModal = false;
      }
   },
   compute: {},
   watch: {}
}
</script>
<style src="./graph.css"></style>