<template>
   <div class="component_area">
      <v-container>
         <Table 
            :tableHeaders="tableHeaders" 
            :itemModel="itemModel" 
            :formFields="formFields" 
            :selectableLists="selectableLists" 
            :modelDefinition="modelDefinition"
            :editable="true"
            @reloadData="loadData"
         />
      </v-container>
   </div>
</template>

<script>
import Vue from 'vue';
import Table from '../../components/table/table'

export default {
   name: "Users",
   components: {
      Table
   },
   data: () => ({
      editedIndex: -1,
      right: null,
      selectedModel: null,
      dialog: false,
      dialogDelete: false,
      selectableLists: [],
      baseModelDefinition: 
         { id: null, name: 'Usuario', model: 'userprofile', items: [] },
      modelDefinition: 
         { id: null, name: 'Usuario', model: 'userprofile', items: [] },
      itemModel: 
         { 
            id: '', name: '', lastname: '', idCard: '', status: '', 
            bloodtype: '', civilstatustype: '', livesAlone: '',
            hometype: '',  smokertype: '', transporttype: '',
            drinkertype: '', gendertype: '', 
            employeetype: '', 
            // address:
               regiontype: '', citytype: '', streetType: '',
               streetNumber: '', streetChar: '', streetCardinal: '',
               intersectionNumber: '', intersectionChar: '', intersectionCardinal: '',
               buildingNumber: '', complement: '', details: ''
         },
      formFields: [
         { label: 'Datos personales',        type: 'block',                size: 12},
         { label: 'Nombre',                  field: 'name',                size: 4, type: 'text',     required: true,    containerClasses: '', fieldClasses: 'required'},
         { label: 'Apellido',                field: 'lastname',            size: 4, type: 'text',     required: true,    containerClasses: '', fieldClasses: 'required'},
         { label: 'DNI',                     field: 'idCard',              size: 4, type: 'text',     required: true,    containerClasses: '', fieldClasses: 'required'},
         { label: 'Estado',                  field: 'status',              size: 4, type: 'enum',     required: true,    containerClasses: '', fieldClasses: 'required',
         list: [
            { text: 'ACTIVO',                value: 'ACTIVO' },
            { text: 'INACTIVO',              value: 'INACTIVO' },
            { text: 'ELIMINADO',             value: 'ELIMINADO' },
         ]},

         { label: 'Salud',                   type: 'block',                size: 12},
         { label: 'Género',                  field: 'gendertype',          size: 3, type: 'select',   required: false,   containerClasses: '', fieldClasses: '', list: []},
         { label: 'Tipo de sangre',          field: 'bloodtype',           size: 3, type: 'select',   required: false,   containerClasses: '', fieldClasses: '', list: []},
         { label: 'Tipo de fumador',         field: 'smokertype',          size: 3, type: 'select',   required: false,   containerClasses: '', fieldClasses: '', list: []},
         { label: 'Ingesta de alcohol',      field: 'drinkertype',         size: 3, type: 'select',   required: false,   containerClasses: '', fieldClasses: '', list: []},
         
         { label: 'Entorno personal',        type: 'block',                size: 12},
         { label: 'Estado civil',            field: 'civilstatustype',     size: 4, type: 'select',   required: false,   containerClasses: '', fieldClasses: '', list: []},
         { label: 'Tipo de vivienda',        field: 'hometype',            size: 4, type: 'select',   required: false,   containerClasses: '', fieldClasses: '', list: []},
         { label: 'Tipo de transporte',      field: 'transporttype',       size: 4, type: 'select',   required: false,   containerClasses: '', fieldClasses: '', list: []},
         { label: 'Tipo de empleado',        field: 'employeetype',        size: 4, type: 'select',   required: false,   containerClasses: '', fieldClasses: '', list: []},
         { label: 'Número de hijos',         field: 'childNumber',         size: 4, type: 'number',   required: false,   containerClasses: '', fieldClasses: ''},
         { label: 'Vive solo',               field: 'livesAlone',          size: 4, type: 'enum',     required: false,   containerClasses: '', fieldClasses: '',
         list: [
            { text: 'SI',                    value: 'SI' },
            { text: 'NO',                    value: 'NO' },
         ]},

         { label: 'Dirección',               type: 'block',                size: 12},
         { label: 'Municipio',               field: 'regiontype',          size: 6, type: 'select',   required: true,    containerClasses: '', fieldClasses: 'required', list: []},
         { label: 'Ciudad',                  field: 'citytype',            size: 6, type: 'select',   required: true,    containerClasses: '', fieldClasses: 'required', list: []},
         { label: 'Tipo de Calle',           field: 'streetType',          size: 3, type: 'enum',     required: false,   containerClasses: '', fieldClasses: '', 
         list: [
            { text: 'Avenida',               value: 'AVENIDA' },
            { text: 'Autopista',             value: 'AUTOPISTA' },
            { text: 'Carrera',               value: 'CARRERA' },
            { text: 'Calle',                 value: 'CALLE' },
            { text: 'Circular',              value: 'CIRCULAR' },
         ]},
         { label: 'Número de Calle',         field: 'streetNumber',        size: 3, type: 'number',   required: false,   containerClasses: '', fieldClasses: ''},
         { label: 'Letra de Calle',          field: 'streetChar',          size: 3, type: 'text',     required: false,   containerClasses: '', fieldClasses: ''},
         { label: 'Cardinal de Calle',       field: 'streetCardinal',      size: 3, type: 'enum',     required: false,   containerClasses: '', fieldClasses: '', 
         list: [
            { text: 'Norte',                 value: 'NORTE' },
            { text: 'Sur',                   value: 'SUR' },
            { text: 'Estae',                 value: 'ESTE' },
            { text: 'Oeste',                 value: 'OESTE' },
         ]},
         { label: 'Número de Intersección',  field: 'intersectionNumber',  size: 3, type: 'number',   required: false,   containerClasses: '', fieldClasses: ''},
         { label: 'Letra de Intersección',   field: 'intersectionChar',    size: 3, type: 'text',     required: false,   containerClasses: '', fieldClasses: ''},
         { label: 'Cardinal de Intersección',field: 'intersectionCardinal',size: 3, type: 'enum',     required: false,   containerClasses: '', fieldClasses: '', 
         list: [
            { text: 'Norte',                 value: 'NORTE' },
            { text: 'Sur',                   value: 'SUR' },
            { text: 'Estae',                 value: 'ESTE' },
            { text: 'Oeste',                 value: 'OESTE' },
         ]},
         { label: 'Número de edificio',      field: 'buildingNumber',      size: 3, type: 'number',   required: false,   containerClasses: '', fieldClasses: ''},
         { label: 'Complemento',             field: 'complement',          size: 6, type: 'text',     required: false,   containerClasses: '', fieldClasses: ''},
         { label: 'Detalles',                field: 'details',             size: 6, type: 'text',     required: false,   containerClasses: '', fieldClasses: ''},
         
      ],
      tableHeaders: [
         { text: "Nombre",                value: "name",          align: "start",      sortable: true },
         { text: "Apellido",              value: "lastname",      align: "start",      sortable: true },
         { text: "DNI",                   value: "idCard",        align: "start",      sortable: true },
         { text: "Estado",                value: "status",        align: "start",      sortable: true },
         { text: "Acciones",              value: "actions",       align: 'end',        sortable: false },
      ],
   }),
   async mounted(){
      try{
         let selectableLists;
         let formFields = this.formFields;
         await Vue.fetchData('GET', 'rest/get-conditions')
         .then( response => {
            selectableLists = response.data.map( constraint => ({
               id: constraint.id,
               name: constraint.label,
               model: constraint.field,
               items: constraint.values
            }));

            formFields.forEach( field => {
               if( field.type === 'select' ){
                  field.list = selectableLists
                                 .filter( list => list.model === field.field )[0]
                                 .items.map( item => (
                                    { text: item.label, value: item.value }
                                 ));
               }
            });

            this.selectableLists = selectableLists;
            this.formFields = formFields;
         });

         await Vue.fetchData('GET', 'userprofile/list')
         .then( response => {
            this.modelDefinition.items = response.data;
         })
      }
      catch( e ){
         console.log(e);
         Vue.$toast.open({ 
            message: 'Ha ocurrido un error al cargar los datos',
            type: 'error',
            dismissible: true,
            pauseOnHover: true,
            duration: 5000
         });
      }
      this.loadData()
   },
   computed: {},
   methods: {
      async loadData() {
         this.modelDefinition = Object.assign({}, this.baseModelDefinition);
         try{
            await Vue.fetchData('GET', 'userprofile/list')
            .then( response => {
               this.modelDefinition.items = response.data;
            })
         }
         catch( e ){
            console.log(e);
            Vue.$toast.open({ 
               message: 'Ha ocurrido un error al cargar los datos',
               type: 'error',
               dismissible: true,
               pauseOnHover: true,
               duration: 5000
            });
         }
      }
   },
   watch: {}
}
</script>

<style src="./users.css"></style>