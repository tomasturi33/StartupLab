<template>
  <v-row>
    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
        v-if="!loading" 
      >
        <v-row class="ma-4">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Emprendimiento:
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text">
              {{ entrepreneurship.title  }}
            </p>
          </v-col>
        </v-row>

        <v-row class="ma-4">
          <v-col cols="12" xl="6" md="6" sm="12">
            <v-btn
              large
              block
              color="primary"
              :to="{name: 'showStartUpTutor'}">
              StartUp
            </v-btn>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <v-btn
              large
              block
              color="primary"
              :to="{name: 'showStartUpTeamTutor' }">
              Integrantes
            </v-btn>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <v-btn
              large
              block
              color="primary"
              :to="{name: 'showStartupWindowTutor'}">
              Vidriera
            </v-btn>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <notes 
              :entrepreneurship_id="entrepreneurship.id" 
              :btn_block="true" 
            />
          </v-col>

        </v-row> 
      </v-sheet>
    </v-col>

    <v-col cols="12">
      <v-sheet 
        outlined
        min-height="300px"
        v-if="!loading" >
        <v-row class="ma-4">
          <v-col cols="12">
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
        </v-row>
        <v-row>
          <v-col cols="12" class="pa-12">
            <label class="font-weight-regular text-uppercase">
              Tareas:
            </label>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Buscar"
              single-line
              hide-details
            ></v-text-field>
          </v-col>

          <v-col cols="12">
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
                  :to="{name: 'entrepreneurshipTasksModuleTutor', params:{ module_pre_incubation_id: item.id } }"
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
        :to="{ name: 'EntrepreneurshipsAssignedTutor' }"
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
          Cargando...
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
  import notes from '@/components/notes/notes.vue'

  export default {
    name: 'EntrepreneurshipTasks',
    components: {
      notes
    },
    data: () => ({
      slug:null,
      loading:true,

      search: '',

      headers: [
          {
            text: 'Modulo',
            align: 'start',
            sortable: true,
            value: 'name',
            searcheable:true
          },
          { 
            text: 'Estado tarea',
            align: 'center',
            sortable: true, 
            value: 'task_state',
            searcheable:true
          },
          { 
            text: 'Acciones', 
            align: 'center',
            sortable: false,
            value: 'actions' }
        ],
      
      entrepreneurship:[],
      module_pre_incubation:[],
      data:[],
      modules:[],
      progress:0,

      sortBy: 'order',
      sortDesc: false,
      headerProps: {
        sortByText: "Ordenar por"
      },
    }),
    
    methods:{
      customSearch (value, search, item) {
          return Object.values(item).some(v=>v&&v.toString().toLowerCase().includes(search))
      },

      async getTasksEntrepreneurship(){
        await axios.get('tutor/tutors/'+this.slug).then((response) =>{
          this.data = response.data
          this.entrepreneurship = response.data.data.entrepreneurship
          this.progress = response.data.data.progress
          this.module_pre_incubation = response.data.data.module_pre_incubation

          this.loading=false;
        }).catch(error => {
          console.log(error);
        })
      },

      showTask(id){
        this.$router.push({ name: 'EntrepreneurshipTask', params: { task_id: id } })
      }
    },

    created(){
      this.slug = this.$route.params.slug
      this.getTasksEntrepreneurship()
    }
  }
</script>