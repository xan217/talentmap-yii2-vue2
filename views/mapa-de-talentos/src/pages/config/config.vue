<template>
   <div class="component_area_home">
      <div class="description_section_config">
        <div class="config_form">
          <h4 class="project_title">
              Configuración de estilos
          </h4>
           <div class="formField">
             <label>Nombre de la empresa</label>
             <input type="text" v-model="company.name">
           </div>
           <div class="formField">
             <label>Logo</label>
             <input type="file" accept="image/*" id="file-input" name="file-input" @change="onFileChanged">
           </div>
           <div class="colors">
            <div class="formFieldInline">
              <label>Color principal</label>
              <input type="color" v-model="company.primaryColor">
            </div>
            <div class="formFieldInline">
              <label>Color secundario</label>
              <input type="color" v-model="company.secondaryColor">
            </div>
            <div class="formFieldInline">
              <label>Color terciario</label>
              <input type="color" v-model="company.tertiaryColor">
            </div>
          </div>
          <h4 class="project_title">
              Campos condicionales
          </h4>
          <div class="colors">
            <div class="formFieldInline" v-for="(table, index) in tables" :key="index">
              <v-switch
                :color="company.primaryColor"
                v-model="table.status"
                :label="table.mask"
              ></v-switch>
            </div>
          </div>
          <div class="formField">
             <span><b>IMPORTANTE:</b> Todos los cambios deben ser guardados para que premanezcan en el tiempo, en caso contrario, al volver a acceder al sistema, los cambios se revertirán a los anteriormente guardados.</span>
          </div>
          <div class="button_section">
            <v-btn :color="company.tertiaryColor" dark @click="resetChanges()"> Reestablecer </v-btn>
            <v-btn :color="company.primaryColor" dark @click="saveChanges()"> Guardar Cambios </v-btn>
          </div>
         </div>
      </div>
   </div>
</template>

<script>
   import Vue from 'vue';
   import axios from "axios";

   export default {
      name: "Config",
      data: () => ({
        company: Vue.company,
        selectedFile: null,
        formData: null,
        tables: []
      }),
      async mounted() {
        const response = await Vue.fetchData("GET", 'config/get-tables');
        this.tables = response.data.tables.map( table => ({ ...table, status: table.value === 'active' }));
      },
      methods: {
        async saveChanges(){
          try{
            if( this.selectedFile ){
              const serverImageResponse = await axios.post(`${Vue.api_route}config/save-logo`, this.formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }});

              if( serverImageResponse.status === 200 ){
                this.company.logo = serverImageResponse.data.data.config.logo;
                Vue.company.logo = serverImageResponse.data.data.config.logo;
              }

              Vue.$toast.open({ 
                message: serverImageResponse.data.message,
                type: serverImageResponse.data.type,
                dismissible: true,
                pauseOnHover: true,
                duration: serverImageResponse.data.type === 'error' ? 5000 : 3000
              });
            }

            const serverResponse = await Vue.fetchData( 'POST', 'config/save', this.company );
            if( serverResponse.status === 200 ){
              Vue.company = serverResponse.data.config;
            }
            
            this.tables = this.tables.map( table => ({
              ...table, 
              value: table.status 
                ? 'active' 
                : 'inactive' 
            }) );

            const tablesResponse = await Vue.fetchData( 'POST', 'config/save-tables', {tables: this.tables});
            if( tablesResponse.status === 200 ){
              this.tables = tablesResponse.data.tables;
            }

            Vue.$toast.open({ 
              message: serverResponse.message,
              type: serverResponse.type,
              dismissible: true,
              pauseOnHover: true,
              duration: serverResponse.type === 'error' ? 5000 : 3000
            });

            Vue.$toast.open({ 
              message: tablesResponse.message,
              type: tablesResponse.type,
              dismissible: true,
              pauseOnHover: true,
              duration: tablesResponse.type === 'error' ? 5000 : 3000
            });
          }
          catch( e ){
            console.log(e);
            Vue.$toast.open({ 
              message: 'Error en el proceso de guardado',
              type: 'error',
              dismissible: true,
              pauseOnHover: true,
              duration: 5000
            });
          }
        },
        resetChanges(){
          this.editedCompany = Object.assign({}, Vue.company);
        },
        onFileChanged (event) {
          this.formData = new FormData();
          this.selectedFile = event.target.files[0];
          this.formData.append('logo', this.selectedFile, this.selectedFile.name);
        }
      }
   }
</script>
<style src="./config.css"></style>