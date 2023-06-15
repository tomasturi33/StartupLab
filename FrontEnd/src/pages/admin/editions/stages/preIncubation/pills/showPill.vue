<template>
  <v-row>
    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
        v-if="!loading"
      >
        <v-row class="pa-8">

          <v-col 
            cols="12" 
            xl="3" 
            md="3" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left">
              <label class="font-weight-regular text-uppercase">
                N° Orden:
              </label>
          </v-col>
          <v-col 
            cols="12" 
            xl="9" 
            md="9" 
            sm="12">
              <label class="font-weight-light">
                {{ pill.order }}
              </label>
          </v-col>

          <v-col 
            cols="12" 
            xl="3" 
            md="3" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left">
              <label class="font-weight-regular text-uppercase">
                Pildora:
              </label>
          </v-col>
          <v-col 
            cols="12" 
            xl="9" 
            md="9" 
            sm="12">
              <label class="font-weight-light">
                {{ pill.name }}
              </label>
          </v-col>

          <v-col 
            cols="12" 
            xl="3" 
            md="3" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left"
            v-show="pill.description">
              <label class="font-weight-regular text-uppercase">
                Descripción:
              </label>
          </v-col>

          <v-col 
            cols="12" 
            xl="9" 
            md="9" 
            sm="12"
            v-show="pill.description">
              <label class="font-weight-light">
                {{ pill.description }}
              </label>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
        v-if="!loading"
      >
        <v-row class="pa-8">

          <v-col 
            cols="12" 
            xl="3" 
            md="3" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left">
              <label class="font-weight-regular text-uppercase">
                Tipo de contenido:
              </label>
          </v-col>
          <v-col 
            cols="12" 
            xl="9" 
            md="9" 
            sm="12">
              <label class="font-weight-light">
                {{ type_content.toUpperCase()  }}
              </label>
          </v-col>

          <v-col 
            cols="12" 
            xl="3" 
            md="3" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left">
              <label class="font-weight-regular text-uppercase">
                Contenido:
              </label>
          </v-col>    
          <v-col 
            style="z-index: 0;"
            cols="12" 
            xl="9" 
            md="9" 
            sm="12"
            v-if="pill.type_content=='video'">
            <vue-core-video-player 
              class="video"
              :src="url"
              :volume="0.8"
              :autoplay="false">
            </vue-core-video-player>
          </v-col>

          <v-col
            cols="12" 
            xl="9" 
            md="9" 
            sm="12"
            v-if="pill.type_content=='pdf'">
            <v-btn
              outlined
              color="indigo"
              :href="url"
              >
              <v-icon>mdi-download</v-icon>
              Descargar PDF
            </v-btn>
          </v-col>

          <v-col
            cols="12" 
            xl="9" 
            md="9" 
            sm="12"
            v-if="pill.type_content=='youtube_video'">
            <LazyYoutube :src="pill.content" />
          </v-col>

          <v-col
            cols="12" 
            xl="9" 
            md="9" 
            sm="12"
            v-if="pill.type_content=='vimeo_video'">
            
            <LazyVimeo :src="pill.content" />
          </v-col>

          <v-col
            cols="12" 
            xl="9" 
            md="9" 
            sm="12"
            v-if="pill.type_content=='nube_unl_video'">

            <video controls width="100%">
              <source :src="pill.content" type="video/mp4">
            </video>
          </v-col>

          <v-col
            cols="12" 
            xl="9" 
            md="9" 
            sm="12"
            v-if="pill.type_content=='link'">
              <a :href="pill.content" target="_blank" rel="noreferrer noopener">
                <h4>{{ pill.content }}</h4>
              </a>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
        v-if="!loading"
      >
        <v-row class="pa-8">

          <v-col 
            cols="12" 
            xl="3" 
            md="3" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left">
              <label class="font-weight-regular text-uppercase">
                Profesor:
              </label>
          </v-col>
          <v-col 
            cols="12" 
            xl="9" 
            md="9" 
            sm="12">
              <label class="font-weight-light">
                {{ pill.pill_teacher.abbreviated_academic_title }}
                {{ pill.pill_teacher.name_teacher }}
                {{ pill.pill_teacher.lastname_teacher }}
              </label>
          </v-col>

          <v-col 
            v-if="pill.pill_teacher.academic_title"
            cols="12" 
            xl="3" 
            md="3" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left">
              <label class="font-weight-regular text-uppercase">
                Título:
              </label>
          </v-col>
          <v-col 
            v-if="pill.pill_teacher.academic_title"
            cols="12" 
            xl="9" 
            md="9" 
            sm="12">
              <label class="font-weight-light">
                {{ pill.pill_teacher.academic_title }}
              </label>
          </v-col>

          <v-col 
            v-if="pill.pill_teacher.email"
            cols="12" 
            xl="3" 
            md="3" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left">
              <label class="font-weight-regular text-uppercase">
                Correo electrónico:
              </label>
          </v-col>
          <v-col 
            v-if="pill.pill_teacher.email"
            cols="12" 
            xl="9" 
            md="9" 
            sm="12">
              <label class="font-weight-light">
                {{ pill.pill_teacher.email }}
              </label>
          </v-col>

          <v-col 
            v-if="pill.pill_teacher.linkedin"
            cols="12" 
            xl="3" 
            md="3" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left">
              <label class="font-weight-regular text-uppercase">
                Linkedin:
              </label>
          </v-col>
          <v-col 
            v-if="pill.pill_teacher.linkedin"
            cols="12" 
            xl="9" 
            md="9" 
            sm="12">
              <label class="font-weight-light">
                {{ pill.pill_teacher.linkedin }}
              </label>
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
  import { LazyYoutube, LazyVimeo  } from "vue-lazytube";

  const APP_URL = process.env.VUE_APP_URL

  export default {
    name: 'showPill',
    components: {
        LazyYoutube,
        LazyVimeo 
    },

    data: () => ({
      loading:true,
      edition_id:null,
      module_id:null,
      
      pill_id:null,
      pill:[],
      type_content:null,
      isPlaying:false,
      url:''
    }),

    methods:{
      handler: function(e) {
        e.preventDefault();
     },

     play() {
        this.$refs.myvideo.play()
        this.isPlaying = true
      },
      stop() {
        this.$refs.myvideo.pause()
        this.isPlaying = false
      },

      async getPill(){
        await axios.get('admin/pills/'+this.pill_id).then(response =>{
          this.pill = response.data.pill

          this.url = APP_URL + response.data.pill.url

          switch (this.pill.type_content) {
            case 'youtube_video':
              this.type_content = 'Video de Youtube'
              break;
            
            case 'vimeo_video':
              this.type_content = 'Video de Vimeo'
              break;
            
            case 'nube_unl_video':
              this.type_content = 'Video en la Nube UNL'
              break;
          
            case 'video':
              this.type_content = 'Video'
              break;
            
            case 'pdf':
              this.type_content = 'PDF'
              break;
            
            case 'link':
              this.type_content = 'Link/enlace'
              break;
          }

          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      async downloadFile() {
        await axios.get(
          this.url, 
          {responseType: 'blob'} // !!!
        ).then((response) => {
          window.open(URL.createObjectURL(response.data));
        })
      },

      previousPage(){
        this.$router.push({ name: 'pills', params: { module_id: this.module_id } })
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.module_id = this.$route.params.module_id;
      this.pill_id = this.$route.params.pill_id
      this.getPill()
      },
  }
</script>
<style scoped>
.video {
  max-height:420px; 
  width: auto;
  aspect-ratio: 16 / 9;
}
</style>
