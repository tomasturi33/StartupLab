<template>
  <v-row>

    <v-col cols="12" class="pa-8">
      <h2 class="font-weight-light">Actividad</h2>
      <v-divider></v-divider>
  
      <v-row v-if="module.activity_statement">
        
        <v-col cols="12">
          <p class="text-pre-wrap font-weight-light pt-3">{{ module.activity_statement }}</p>
        </v-col>

        <v-col cols="12">
          <v-divider></v-divider>
        </v-col>

        <v-col cols="12" class="pa-8" v-if="tasks.length>0">
          <v-timeline dense>
            <v-slide-x-reverse-transition
              group
              hide-on-leave
            >
              <v-timeline-item
                v-for="item in tasks"
                :key="item.id"
                color="info"
                small
                fill-dot
              >
                <v-row>

                  <v-col cols="12" v-if="item.condition=='pending'">
                    <v-sheet
                      outlined
                      rounded
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
                            small
                            color="primary"
                            outlined
                            :loading="loading_task"
                            @click="donwloadTask(item.url)"
                            >
                            Tarea
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
                          <h2 class="subtitle-2 text-uppercase">Comentario:</h2>
                          <p class="text-pre-wrap font-weight-light pt-2">--</p>
                        </v-col>
                      </v-row>
                    </v-sheet>
                  </v-col>

                  <v-col cols="12" v-if="item.condition=='approved'">
                    <v-sheet
                      outlined
                      rounded
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
                            small
                            color="primary"
                            outlined
                            :loading="loading_task"
                            @click="donwloadTask(item.url)"
                            >
                            Tarea
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
                          <h2 class="subtitle-2 text-uppercase">Comentario:</h2>
                          <p class="text-pre-wrap font-weight-light pt-2">{{ item.devolution }}</p>
                        </v-col>
                      </v-row>
                    </v-sheet>
                  </v-col>

                  <v-col cols="12" v-if="item.condition=='not_approved'">
                    <v-sheet
                      outlined
                      rounded
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
                            small
                            color="primary"
                            outlined
                            :loading="loading_task"
                            @click="donwloadTask(item.url)"
                            >
                            Tarea
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
                          <h2 class="subtitle-2 text-uppercase">Comentario:</h2>
                          <p class="text-pre-wrap font-weight-light pt-2">{{ item.devolution }}</p>
                        </v-col>
                      </v-row>
                    </v-sheet>
                  </v-col>

                </v-row>

              </v-timeline-item>
            </v-slide-x-reverse-transition>
          </v-timeline>
        </v-col>

        <v-col cols="12" class="pa-8 text-center" v-if="!is_enabled">
          <v-banner
            color="info"
            dark
            rounded
            shaped
            tile>
            Debes tener aprobado el modulo anterior para poder enviar esta tarea 
          </v-banner>
        </v-col>

        <v-col cols="12" class="pa-8 text-center" v-if="is_enabled&&active_upload_task">
          <v-btn
            color="primary"
            elevation="2"
            large
            @click="attachTask"
          >
            Subir actividad
            <v-icon
              right
              dark
            >
              mdi-cloud-upload
            </v-icon>
          </v-btn>
        </v-col>
      </v-row>

      <v-row class="pt-2 pb-8" v-if="!module.activity_statement">
        <v-col cols="12" class="text-center pt-8">
          <v-icon
            x-large
          >
            mdi-timer-sand-empty
          </v-icon>
          
          <h1 class="font-weight-light pt-8 pb-8">
            El administrador aún no subió la actividad de este módulo.
          </h1>
        </v-col>
      </v-row>
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

    <v-dialog
      v-model="upload_task"
      persistent
      max-width="680"
    >
      <v-card>
        <v-card-title class="text-h5">
          Actividad
        </v-card-title>
        <v-card-text>
          <v-col cols="12">
            Adjunte la actividad en formato PDF, puede dejar un mensaje al evaluador que corregirá la actividad.
          </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="message"
              :counter="100"
              :maxlength="100"
              label="Comentario"
              outlined
              dense
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-file-input
              clearable
              dense
              v-model="task"
              outlined
              accept=".pdf"
              truncate-length="15"
              label="Actividad"
            ></v-file-input>
          </v-col>
        </v-card-text>
        
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            :disabled="send_task"
            @click="upload_task = false"
          >
            Cerrar
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            :loading="send_task"
            :disabled="!task"
            @click="sendTask"
          >
            Enviar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_errors"
      persistent
      max-width="640"
    >
      <v-card>
        <v-card-title class="text-h6">
          Advertencia
        </v-card-title>
        <v-card-text>

          <v-list-item v-for="error in errors" :key="error">
            - {{ error }}
          </v-list-item>
          
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_errors = false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-row>
</template>
<script>
  import axios from 'axios';
  import download from 'downloadjs'

  const APP_URL  = process.env.VUE_APP_URL 

  export default {
    name: 'taskModule',
    props:['module', 'convocation_form_id', 'is_enabled'],
    data() {
      return {
        loading:true,
        upload_task:false,
        send_task:false,
        loading_task:false,
        dialog_errors:false,
        active_upload_task:false,
        tasks:[],
        task:null,
        message:null,
        messageRules: [
          v => (v && v.length <= 99) || 'El mensaje no debe tener mas de 100 caracteres',
        ],
        errors:[]
      }
    },
    methods: {
      async getTasks(){
        this.loading=true
        await axios.get('entrepreneurship-tasks/'+ this.module.id +'/'+ this.convocation_form_id).then(response =>{
          this.tasks = response.data.data.tasks

          this.tasks.forEach( (task) => {
            if(task.condition=='not_approved'){
              this.active_upload_task=true
            }

            if(task.condition=='pending'||task.condition=='approved'){
              this.active_upload_task=false
            }
          })

          if(this.tasks.length==0){
            this.active_upload_task=true
          }
          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      attachTask(){
        this.task=null
        this.message=null
        this.upload_task = true
      },

      async sendTask(){
        this.send_task=true
        this.dialog=true
        this.errors = []
        let that = this

        let formData = new FormData();
        formData.append('module_pre_incubation_id', this.module.id);
        formData.append('convocation_form_id', this.convocation_form_id);
        formData.append('message', this.message);
        formData.append('task', this.task);

        try{
          await axios.post( 'entrepreneurship-tasks',
            formData,
            {
              headers: {
                  'Content-Type': 'multipart/form-data'
              }
            }
          ).then(function(){
            that.dialog=false
            that.upload_task=false
            that.send_task=false
            that.getTasks()
          }).catch(error=>{
            if( error.errors.length != 0){
              Object.values(error.response.data.errors).forEach(error => {
                this.errors.push(error[0])
              })
            }
            that.dialog=false
            that.upload_task=false
            that.send_task=false
            that.dialog_errors = true
          })
        }catch(err) {
          that.errors.push('Error inesperado, intente nuevamente mas tarde o pongase en contacto con el administrador')
          that.dialog=false
          that.upload_task=false
          that.send_task=false
          that.dialog_errors = true
          console.log(err)
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
      this.getTasks()
    },
  }
</script>