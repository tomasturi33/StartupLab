<template>
  <v-row>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Nueva Pildora:</h3>
          </v-col>

          <v-col
            cols="12"
          >
            <v-text-field
              ref="edition.name"
              v-model="name"
              outlined
              :rules="[() => !!name || 'Este campo es requerido']"
              label="Nombre"
              required
            ></v-text-field>
            
            <v-textarea
              outlined
              ref="edition.description"
              v-model="description"
              name="description"
              label="Descripción"
            ></v-textarea>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Contenido:</h3>
          </v-col>

          <v-col cols="12" class="text-center">
            <v-btn
              outlined
              color="primary"
              elevation="2"
              @click="showAddContent"
              v-if="!type_content"
            >
            <v-icon left>
              mdi-plus
            </v-icon>
            Agregar contenido
            </v-btn>
          </v-col>

          <v-col
            class="d-flex justify-center"
            v-if="type_content=='video'"
            cols="12"
          >
            <v-card
              width="500px"
              elevation="10"
              color="teal lighten-5">
              <v-card-text>
                <vue-core-video-player 
                  style="z-index:0;"
                  class="video"
                  :src="url_content"
                  :volume="0.8"
                  :autoplay="false">
                </vue-core-video-player>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon>
                  <v-icon color="black" @click="deleteContent()">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>

          <v-col
            class="d-flex justify-center"
            v-if="type_content=='pdf'"
            cols="12"
          >
            <v-card
              width="500px"
              elevation="10"
              color="teal lighten-5">
              
              <v-col
                v-if="type_content=='pdf'"
                cols="12">
                <v-img
                  :src="require('@/assets/icons/pdf-icon.png')"
                  contain
                  height="180"
                />
              </v-col>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon>
                  <v-icon color="black" @click="deleteContent()">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>

          <v-col
            class="d-flex justify-center"
            v-if="type_content && type_content=='youtube_video'"
            cols="12"
          >
            <v-card 
              width="500px"
              elevation="10"
              color="teal lighten-5">
              <v-card-text>
                <LazyYoutube :src="content" />
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn label="Borrar" @click="deleteContent()"> Borrar
                  <v-icon color="black">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>

          <v-col
            class="d-flex justify-center"
            v-if="type_content && type_content=='vimeo_video'"
            cols="12"
          >
            <v-card
              width="500px"
              elevation="10"
              color="teal lighten-5">
              <v-card-text>
                <LazyVimeo :src="content" />
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn label="Borrar" @click="deleteContent()"> Borrar
                  <v-icon color="black">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>

          <v-col
            class="d-flex justify-center"
            v-if="type_content && type_content=='nube_unl_video'"
            cols="12"
          >
            <v-card
              width="500px"
              elevation="10"
              color="teal lighten-5">
              <v-card-text>
                <video controls width="100%">
                  <source :src="content" type="video/mp4">
                </video>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn label="Borrar" @click="deleteContent()"> Borrar
                  <v-icon color="black">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>

          <v-col
            class="d-flex justify-center"
            v-if="type_content && type_content=='link'"
            cols="12">
            <v-card
              width="500px"
              elevation="10"
              color="teal lighten-5">
              <v-card-text>

                <v-img
                  :src="require('@/assets/icons/link_web.png')"
                  contain
                  height="180"
                />
                <v-row>
                  <v-col class="text-center pt-8">
                    <a :href="content_aux" target="_blank" rel="noreferrer noopener">
                      <h4>{{ content_aux }}</h4>
                    </a>
                  </v-col>
                </v-row>
                

              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn label="Borrar" @click="deleteContent()"> Borrar
                  <v-icon color="black">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Información del docente/disertante:</h3>
          </v-col>

          <v-col
            cols="12" xl="6" md="6" sm="12"
          >
            <v-text-field
              ref="edition.name"
              v-model="name_teacher"
              outlined
              label="Nombre"
              required
            ></v-text-field>
          </v-col>

          <v-col
            cols="12" xl="6" md="6" sm="12"
          >
            <v-text-field
              ref="edition.name"
              v-model="lastname_teacher"
              outlined
              label="Apellido"
              required
            ></v-text-field>
            
          </v-col>

          <v-col
            cols="12" xl="6" md="6" sm="12"
          >
            <v-text-field
              v-model="academic_title"
              outlined
              label="Maximo título académico alcanzado"
              required
            ></v-text-field>
          </v-col>

          <v-col
            cols="12" xl="6" md="6" sm="12"
          >
            <v-text-field
              v-model="abbreviated_academic_title"
              outlined
              label="Título académico abreviado"
              required
            ></v-text-field>
          </v-col>

          <v-col
            cols="12" xl="6" md="6" sm="12"
          >
            <v-text-field
              ref="edition.name"
              v-model="email"
              outlined
              label="Correo electrónico"
              required
            ></v-text-field>
            
          </v-col>

          <v-col
            cols="12" xl="6" md="6" sm="12"
          >
            <v-text-field
              ref="edition.name"
              v-model="linkedin"
              outlined
              label="Linkedin"
              required
            ></v-text-field>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        @click="previousPage"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>

      <v-btn
        depressed
        color="primary"
        :loading="loading"
        @click="createPill"
        >
        Guardar
      </v-btn>
    </v-col>

    <v-dialog v-model="dialog_upload" persistent max-width="490">
      <v-card>
        <v-card-title class="text-h5 font-weight-light">
          Cargando pildora
        </v-card-title>
        <v-card-text>
          <v-progress-linear
            v-model="uploadPercentage"
            color="primary"
            height="25"
          >
            <strong>{{ uploadPercentage}}%</strong>
          </v-progress-linear>
          <h4 class="font-weight-light" v-if="uploadPercentage!=100">Subiendo archivos al servidor...</h4>
          <h4 class="font-weight-light" v-if="uploadPercentage==100">Esperando respuesta del servidor...</h4>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialog_add_content" max-width="580">
      <v-card>
        <v-card-title class="text-h5">
          Contenido de la pildora
        </v-card-title>
        
        <v-card-text>
          <v-col cols="12">
            <v-col
              cols="12"
            >
              <v-select
                v-model="type_content_aux"
                :items="items_content"
                item-value="key" 
                item-text="name"
                label="Tipo de contenido"
                outlined
                dense
              ></v-select>
            </v-col>

            <v-col
              v-if="type_content_aux=='video'"
              cols="12"
            >
              <v-file-input
                outlined
                v-model="content_aux"
                accept="video/mp4"
                label="Video"
                dense
                :rules="[value => !value || value.size < 42000000 || 'El tamaño del video no puede ser superior a 42 MB']"
              ></v-file-input>
            </v-col>

            <v-col
              v-if="type_content_aux=='pdf'"
              cols="12"
            >
              <v-file-input
                v-model="content_aux"
                label="PDF"
                outlined
                accept="application/pdf"
                dense
              ></v-file-input>
            </v-col>
          
            <v-col
              v-if="type_content_aux=='link'"
              cols="12"
            >
              <v-text-field
                v-model="content_aux"
                outlined
                label="Link/enlace"
                required
                dense
              ></v-text-field>
            </v-col>

            <v-col
              v-if="type_content_aux=='youtube_video'"
              cols="12"
            >
              <v-text-field
                v-model="content_aux"
                outlined
                label="URL Video de Youtube"
                required
                dense
              ></v-text-field>
            </v-col>

            <v-col
              v-if="type_content_aux=='vimeo_video'"
              cols="12"
            >
              <v-text-field
                v-model="content_aux"
                outlined
                label="URL Video de Vimeo"
                required
                dense
              ></v-text-field>
            </v-col>

            <v-col
              v-if="type_content_aux=='nube_unl_video'"
              cols="12"
            >
              <v-text-field
                v-model="content_aux"
                outlined
                label="URL Video en la Nube UNL (con extensíon .mp4)"
                required
                dense
              ></v-text-field>
            </v-col>

          </v-col>
        </v-card-text>
        
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary darken-1"
            text
            @click="dialog_add_content = false"
          >
            Cancelar
          </v-btn>
          <v-btn
            color="primary darken-1"
            text
            :disabled="!content_aux"
            @click="addContent"
          >
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialog_error" width="500">
      <v-card>
        <v-card-title class="text-h5 lighten-2">
          Advertencia
        </v-card-title>

        <v-card-text class="pa-8">
          <label v-for="err in errors" v-bind:key="err">
            <p>- {{ err }}</p>
          </label>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_error = false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-row>
</template>
<script>
  import axios from 'axios'
  import { LazyYoutube, LazyVimeo  } from "vue-lazytube";

  export default {
    name: 'newPill',
    components: {
        LazyYoutube,
        LazyVimeo 
    },

    data: () => ({
      loading:false,
      edition_id:null,
      module_id:null,

      dialog_upload:false,
      dialog_error:false,
      dialog_add_content:false,

      name:'',
      description:'',

      type_content: null,
      type_content_aux: 'video',
      items_content: [
          {key:'video', name:'Video'}, 
          {key:'link', name:'Link'}, 
          {key:'pdf', name:'PDF'}, 
          {key:'youtube_video', name:'Video de Youtube'}, 
          {key:'vimeo_video', name:'Video de Vimeo'},
          {key:'nube_unl_video', name:'Video de la Nube UNL'}
      ],

      content:null,
      content_aux:null,

      url_content:null,
      url_content_aux:null,
      
      video_youtube: null,
      video_youtube_aux: null,
      
      video_vimeo: null,
      video_vimeo_aux: null,

      academic_title:'',
      abbreviated_academic_title:'',
      name_teacher:'',
      lastname_teacher:'',
      email:'',
      linkedin:'',
      
      uploadPercentage:0,

      errors:[],
      error:false
    }),

    methods:{
      async createPill() {
        this.uploadPercentage = 0
        this.errors = []
        //this.loading=true

        let formData= new FormData()
        formData.append('module_pre_incubation_id', this.module_id);
        formData.append('name', this.name);
        formData.append('description', this.description);
        formData.append('type_content', this.type_content);
        
        if(this.content!=null){
          formData.append('content', this.content);
        }
        
        formData.append('academic_title', this.academic_title);
        formData.append('abbreviated_academic_title', this.abbreviated_academic_title);
        formData.append('name_teacher', this.name_teacher);
        formData.append('lastname_teacher', this.lastname_teacher);

        if(this.email!=null){
          formData.append('email', this.email)
        }

        if(this.linkedin!=null){
          formData.append('linkedin', this.linkedin)
        }

        this.dialog_upload=true
        await axios({
          method: 'post',
          url: 'admin/pills',
          data: formData,
          headers: {
            'Content-Type': 'multipart/form-data'
          },
          onUploadProgress: function( progressEvent ) {
            this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ) );
          }.bind(this)
        }).then(()=>{
          this.loading=false
          this.$router.push({ name: 'pills', params: { module_id: this.module_id } })
        }).catch((error)=>{
          console.log(error)
          if( error.response.data.errors.length != 0){
            Object.values(error.response.data.errors).forEach(error => {
              this.errors.push(error[0])
            })
          }

          this.loading=false
          this.dialog_upload=false
          this.dialog_error = true
        })      
      },

      onTypeContentChange() {
        this.content = null
        this.video_youtube = null
        this.vimeo_video = null
      }, 

      onContentChange() {
        this.url_content = URL.createObjectURL(this.content_aux)
      }, 

      showAddContent(){
        this.type_content_aux = 'video'

        this.content_aux = null
        this.video_youtube_aux = null
        this.video_vimeo_aux = null

        this.dialog_add_content = true 
      },

      addContent(){
        switch (this.type_content_aux) {
          case 'video':
          case 'pdf':
            this.type_content = this.type_content_aux
            this.content = this.content_aux
            this.url_content = URL.createObjectURL(this.content_aux)
            break;
          case 'link':
            this.type_content = this.type_content_aux
            this.content = this.content_aux
            break;
          case 'youtube_video':
            this.type_content = this.type_content_aux
            this.content = this.content_aux
            break;
          case 'vimeo_video':
            this.type_content = this.type_content_aux
            this.content = this.content_aux
            break;
          case 'nube_unl_video':
            this.type_content = this.type_content_aux
            this.content = this.content_aux
            break;
          default:
            console.log('Lo lamentamos, por el momento no disponemos de.');
        }

        this.dialog_add_content = false 
      },

      deleteContent(){
        this.type_content = null
        this.content = null
        this.url_content = null
        this.video_youtube = null
        this.video_vimeo = null
      },

      previousPage(){
        this.$router.push({ name: 'pills', params: { module_id: this.module_id } })
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.module_id = this.$route.params.module_id
      },
  }
</script>
<style scoped>
.video {
  max-height:360px; 
  width: auto;
  aspect-ratio: 16 / 9;
}
</style>