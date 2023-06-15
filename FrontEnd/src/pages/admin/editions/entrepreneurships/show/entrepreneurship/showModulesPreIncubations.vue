<template>
  <v-row>

    <v-col cols="12">
      <v-sheet 
        width="100%"
        outlined 
        min-height="400">
        <v-row>
          <v-col cols="12" class="pa-8">

            <v-progress-linear
              :value="progress"
              height="32"
              rounded
            >
              <strong 
                class="white--text font-weight-light"
                style="text-shadow: 2px 1px 5px black;">Progreso {{ progress }}%
              </strong>
            
            </v-progress-linear>
          </v-col>

          <v-col cols="12" class="pa-8">
            <v-data-table
              class="pt-8"
              :headers="headers"
              :items="module_pre_incubation"
              :sort-by.sync="sortBy"
              :sort-desc.sync="sortDesc"
              :search="search"
              :custom-filter="customSearch"
              :items-per-page="30"
              :footer-props="{
                'items-per-page-options': [10, 20, 30, 40, 50, 100],
                'items-per-page-text':'Modulos por página',
              }"
            >
              <template v-slot:item.actions="{ item }">
                <v-btn
                  class="mx-2"
                  fab
                  dark
                  :disabled="item.task_state=='No requerida'||item.task_state=='--'"
                  x-small
                  color="primary"
                  :to="{name: 'showModulePreIncubation', params:{ module_pre_incubation_id: item.id } }"
                >
                  <v-icon dark small>
                    mdi-eye
                  </v-icon>
                </v-btn>
              </template>
            </v-data-table>
            
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="d-sm-flex pt-8">
      <v-btn
        :block="$vuetify.breakpoint.xsOnly"
        class="mr-auto mt-2"
        depressed
        color="primary"
        :to="{ name: 'showEntrepreneurshipsEdition', params: { id: this.entrepreneurship_id }}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>
    </v-col>

    <v-dialog
      v-model="loading"
      overlay
      persistent
      width="300"
    >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          <label>Cargando...</label>
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

  </v-row>
</template>
<script>
  import axios from 'axios'

  export default {
    name: 'showModulesPreIncubations',

    data: () => ({
      loading:true,
      loading_download: false,
      edition_id:null,
      entrepreneurship_id:null,

      entrepreneurship:null,
      module_pre_incubation:[],
      data:[],
      modules:[],
      progress:0,

      search: '',
      sortBy: 'order',
      sortDesc: false,
      headerProps: {
        sortByText: "Ordenar por"
      },
      headers: [
          {
            text: 'Modulo',
            align: 'start',
            sortable: true,
            value: 'name',
          },
          { 
            text: 'Estado tarea',
            align: 'center',
            sortable: true, 
            value: 'task_state' 
          },
          { 
            text: 'Acciones', 
            align: 'center',
            sortable: false,
            value: 'actions' }
        ],
    }),

    methods:{
      customSearch (value, search, item) {
          return Object.values(item).some(v=>v&&v.toString().toLowerCase().includes(search))
      },

      async getEntrepreneurship() {
        try {
          await axios.get('admin/edition/'+this.edition_id+'/entrepreneurships/'+this.entrepreneurship_id+'/modules-pre-incubation').then(response => {
            //this.modules = response.data.data.modules
            this.data = response.data
            this.progress = response.data.data.progress
            this.entrepreneurship = response.data
            this.module_pre_incubation = response.data.data.module_pre_incubation
            this.loading = false
          })
        } catch (error) {
          console.log(error);
        }
      },

      showItem(id){
        console.log(id)
        this.$router.push({name:'showModulePreIncubation', param:'id'})
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.entrepreneurship_id = this.$route.params.entrepreneurship_id;
      this.convocation_form_id =  this.$route.params.convocation_form_id
      this.getEntrepreneurship()
      },
  }
</script>