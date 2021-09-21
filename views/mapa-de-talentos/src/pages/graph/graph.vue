<template>
  <div class="component_container">
    <div class="component_area">     
      <div class="subcomponent_area">
        <Constraints @updateData="updateData" />
        <div v-for="(data, key) in tableData" :key="key" >
          <br/><hr/><br/>
          <Table 
            :tableHeaders="data.headers"
            :modelDefinition="data.model"
            :editable="false"
          />
          
        </div>
      </div>
      <div class="subcomponent_area">
          <Directed :data="data" :userCount="user_count"/>
      </div>
    </div>
    <div class="component_container">
      <div class="subcomponent_area">
        
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue';
import Constraints from '../../components/constraints/constraints'
import Directed from '../../components/directed/directed'
import Table from '../../components/table/table'


export default {
  name: "Users",
  components: {
    Constraints,
    Directed,
    Table,
  },
  data: () => ({
    tableHeaders: [
      { text: "Nombre",                   value: "name",          align: "start",   sortable: true },
      { text: "Apellido",                 value: "lastname",      align: "start",   sortable: true },
      { text: "Número de identificación", value: "idCard",        align: "start",   sortable: true },
      { text: "Género",                   value: "gender",        align: "start",   sortable: true },
      { text: "Estado civil",             value: "civilStatus",   align: "start",   sortable: true },
    ],
    modelDefinition: 
      { id: null, name: 'Usuario', model: 'userprofile', items: [] },
    nodes: [],
    userBaseModel: {},
    showingUser: {},
    userModal: false,
    filtered_groups: [],
    d3_structured_data: [],
    data: null,
    tableData: null,
    user_count: 0,
  }),
  methods: {
    async updateData( data ) {
      const serverResponse = await Vue.fetchData( 'POST', 'rest/get-groups', data );
      if( serverResponse.code === "200" ){
        this.data = [];
        this.user_count = 0;
        this.d3_structured_data = [];
        this.filtered_groups = serverResponse.data;
        
        let nodes = [];
        let links = [];
        let aux_index = 0;
        let tableData = [];

        nodes.push({'name': Vue.company.name, 'group': 0, 'class': "sistema"});

        this.filtered_groups.forEach((group, group_index) => {
          nodes.push({'name': 'Condición '+ (group_index+1), 'group': (group_index+1), 'class': "consulta"});
          links.push({'source': (group_index+1), 'target': 0, 'value': ++aux_index, 'type': "anclaje"});
        });
        this.filtered_groups.forEach((group, group_index) => {
          let modelDefinition = Object.assign({}, this.modelDefinition );
          delete modelDefinition.items;
          tableData.push({
            headers: this.tableHeaders,
            model: modelDefinition
          });
          tableData[group_index].model.items = [];
          tableData[group_index].model.name = 'Condición '+ (group_index+1);

          group.forEach((user, user_index) => {
            if(user['pk_id'] !== null){
              nodes.push({'name': user['name'], 'group': (group_index+1), 'user_id': user['pk_id'], 'class': "persona"});
              links.push({'source': (++aux_index), 'target': (group_index+1), 'value': user['pk_id'], 'type': "dependencia"});
              this.user_count++;
            }
            tableData[group_index].model.items.push({
              'name': user['name'], 
              'lastname': user['lastname'], 
              'idCard': user['idCard'], 
              'gender': user['gender'], 
              'civilStatus': user['civilStatus']
            });
          });
        });

        this.tableData = tableData;

        this.d3_structured_data.push({"nodes":nodes, "links":links});
        this.data = this.d3_structured_data[0];
      }
      else{
        Vue.$toast.open({ 
            message: 'Ha ocurrido un error al cargar los datos',
            type: 'error',
            dismissible: true,
            pauseOnHover: true,
            duration: 5000
         });
      }
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
      },
   },
   compute: {},
   watch: {}
}
</script>
<style src="./graph.css"></style>