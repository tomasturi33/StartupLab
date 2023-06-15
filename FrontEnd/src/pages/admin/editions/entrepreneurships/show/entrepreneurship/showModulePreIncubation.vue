<template>
  <v-row>
    <v-col cols="12">
      <v-sheet
        outlined >
        <v-row>
          <v-col cols="12" class="pa-8">
            <h2 class="font-weight-light">Actividad</h2>

            <v-divider></v-divider>
        
            <v-row v-if="module_pre_incubation.activity_statement">
              
              <v-col cols="12">
                <p class="text-pre-wrap font-weight-light pt-3">{{ module_pre_incubation.activity_statement }}</p>
              </v-col>

              <v-col cols="12">
                <v-divider></v-divider>
              </v-col>

              <v-col cols="12" class="pa-8" v-if="module_pre_incubation_tasks.length>0">
                <v-timeline dense>
                  <v-slide-x-reverse-transition
                    group
                    hide-on-leave
                  >
                    <v-timeline-item
                      v-for="item in module_pre_incubation_tasks"
                      :key="item.id"
                      :color="(item.condition=='not_approved')?'error':'info'"
                      small
                      fill-dot
                    >
                      <v-row>

                        <v-col cols="12" class="mt-4 mb-5" v-if="item.condition=='pending'">
                          <v-sheet
                            color="grey-lighten-4"
                          >
                            <v-sheet
                              outlined
                              elevation="8"
                              >
                              <v-row class="pa-3">
                                <v-col cols="12">
                                  <h3 class="text-pre-wrap font-weight-light pt-2 text-uppercase">Tarea</h3>
                                </v-col>
                              </v-row>

                              <v-divider></v-divider>

                              <v-row class="pa-3">
                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Enviada por:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.user.lastname.toUpperCase() +', '+item.user.name }}</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Fecha:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.created_date  }}</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Tarea:</h2>
                                  <v-btn
                                    x-small
                                    color="primary"
                                    outlined
                                    :loading="loading_task"
                                    @click="donwloadTask(item.url)"
                                    >
                                    Descargar tarea
                                  </v-btn>
                                </v-col>

                                <v-col cols="12" v-if="item.message!='null'">
                                  <h2 class="subtitle-2 text-uppercase">Comentario:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.message }}</p>
                                </v-col>

                              </v-row>

                              <v-divider></v-divider>

                              <v-row class="pa-3">

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Evaluador:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">--</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Fecha:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">--</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Estado:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">Pendiente</p>
                                </v-col>

                                <v-col cols="12">
                                  <h2 class="subtitle-2 text-uppercase">Devolución:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">--</p>
                                </v-col>
                              </v-row>
                            </v-sheet>
                          </v-sheet>
                        </v-col>

                        <v-col cols="12" class="mt-4 mb-5" v-if="item.condition=='approved'">
                          <v-sheet
                            color="grey-lighten-4"
                          >
                            <v-sheet
                              outlined
                              elevation="8"
                              >
                              <v-row class="pa-3">
                                <v-col cols="12">
                                  <h3 class="text-pre-wrap font-weight-light pt-2 text-uppercase">Tarea</h3>
                                </v-col>
                              </v-row>

                              <v-divider></v-divider>

                              <v-row class="pa-3">
                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Enviada por:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.user.lastname.toUpperCase() +', '+item.user.name }}</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Fecha:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.created_date  }}</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Tarea:</h2>
                                  <v-btn
                                    x-small
                                    color="primary"
                                    outlined
                                    :loading="loading_task"
                                    @click="donwloadTask(item.url)"
                                    >
                                    Descargar tarea
                                  </v-btn>
                                </v-col>

                                <v-col cols="12" v-if="item.message!='null'">
                                  <h2 class="subtitle-2 text-uppercase">Comentario:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.message }}</p>
                                </v-col>
                              </v-row>

                              <v-divider></v-divider>

                              <v-row class="pa-3">

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Evaluador:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.evaluator.lastname.toUpperCase() +', '+item.evaluator.name  }}</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Fecha:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.updated_date  }}</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Estado:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">Aprobado</p>
                                </v-col>

                                <v-col cols="12">
                                  <h2 class="subtitle-2 text-uppercase">Devolución:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.devolution }}</p>
                                </v-col>
                              </v-row>
                            </v-sheet>
                          </v-sheet>
                        </v-col>

                        <v-col cols="12" class="mt-4 mb-5" v-if="item.condition=='not_approved'">
                          <v-sheet
                            color="grey-lighten-4"
                          >
                            <v-sheet
                              outlined
                              elevation="8"
                              >
                              <v-row class="pa-3">
                                <v-col cols="12">
                                  <h3 class="text-pre-wrap font-weight-light pt-2 text-uppercase">Tarea</h3>
                                </v-col>
                              </v-row>

                              <v-divider></v-divider>

                              <v-row class="pa-3">
                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Enviada por:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.user.lastname.toUpperCase() +', '+item.user.name }}</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Fecha:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.created_date  }}</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Tarea:</h2>
                                  <v-btn
                                    x-small
                                    color="primary"
                                    outlined
                                    :loading="loading_task"
                                    @click="donwloadTask(item.url)"
                                    >
                                    Descargar tarea
                                  </v-btn>
                                </v-col>

                                <v-col cols="12" v-if="item.message!='null'">
                                  <h2 class="subtitle-2 text-uppercase">Comentario:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.message }}</p>
                                </v-col>
                              </v-row>

                              <v-divider></v-divider>

                              <v-row class="pa-3">

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Evaluador:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.evaluator.lastname.toUpperCase() +', '+item.evaluator.name }}</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Fecha:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.updated_date  }}</p>
                                </v-col>

                                <v-col cols="12" xl="4" md="4" sm="12">
                                  <h2 class="subtitle-2 text-uppercase">Estado:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">Realizar correcciones</p>
                                </v-col>
                                
                                <v-col cols="12">
                                  <h2 class="subtitle-2 text-uppercase">Devolución:</h2>
                                  <p class="text-pre-wrap font-weight-light pt-2">{{ item.devolution }}</p>
                                </v-col>
                              </v-row>
                            </v-sheet>
                          </v-sheet>
                        </v-col>

                      </v-row>

                    </v-timeline-item>
                  </v-slide-x-reverse-transition>
                </v-timeline>
              </v-col>
            </v-row>
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
        :to="{ name: 'showModulesPreIncubations', params: { id: this.entrepreneurship_id }}"
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
  import download from 'downloadjs'

  const APP_URL  = process.env.VUE_APP_URL 

  export default {
    name: 'showModulePreIncubation',

    data: () => ({
      loading:true,
      loading_download: false,
      loading_task:false,
      edition_id:null,
      entrepreneurship_id:null,
      module_pre_incubation_id:null,

      entrepreneurship:null,
      module_pre_incubation:[],
      module_pre_incubation_tasks:[],
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

      async getModulePreIncubationTask() {
        try {
          await axios.get('admin/edition/'+this.edition_id+'/entrepreneurships/'+this.entrepreneurship_id+'/modules-pre-incubation/'+this.module_pre_incubation_id).then(response => {
            //this.modules = response.data.data.modules
            this.data = response.data
            // this.progress = response.data.data.progress
            // this.entrepreneurship = response.data
            this.module_pre_incubation = response.data.data.module_pre_incubation
            this.module_pre_incubation_tasks = response.data.data.module_pre_incubation_tasks
            this.loading = false
          })
        } catch (error) {
          console.log(error);
        }
      },

      async donwloadTask(url){
        this.loading_task=true
        await axios.get(
          APP_URL + url, 
          {responseType: 'blob'}
        ).then((response) => {
          console.log(response)
          const content = response.headers['content-type'];
          download(response.data, 'Entrega.pdf', content)
          this.loading_task=false
        })
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.entrepreneurship_id = this.$route.params.entrepreneurship_id;
      this.module_pre_incubation_id =  this.$route.params.module_pre_incubation_id
      this.getModulePreIncubationTask()
      },
  }
</script>