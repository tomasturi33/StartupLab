<template>
  <v-row>
    <v-col cols="12" class="pa-8">
      <h2 class="font-weight-light">Pildoras</h2>
      <v-divider></v-divider>

      <v-row v-if="(pills.length > 0)?true:false">
        <v-col cols="12" xl="8" md="8" sm="12">
          <v-sheet 
            outlined min-height="720" 
            class="overflow-auto"  
            style="z-index: 0;">

            <v-card-text v-if="show_video&&pill.type_content=='video'">
              <v-col cols="12" align="center">
                <vue-core-video-player 
                  class="video"
                  :src="url"
                  :volume="0.8"
                  :autoplay="false">
                </vue-core-video-player>
              </v-col>

              <v-col cols="12" class="pt-2">
                <h3>{{ pill.name }}</h3>
                <v-divider></v-divider>
                <p class="text-pre-wrap pt-4">
                  {{ pill.description }}
                </p>
              </v-col>

              <v-col cols="12" class="pt-1">
                <h3>Docente:</h3>
                <v-divider></v-divider>
              </v-col>
              <v-row  class="pa-3">
                <v-col cols="12" xl="6" md="6" sm="12">
                  <h4>Apellido y nombre:</h4>
                  {{ pill.pill_teacher.abbreviated_academic_title }}
                  {{ pill.pill_teacher.lastname_teacher.toUpperCase() }}, 
                  {{ pill.pill_teacher.name_teacher }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.academic_title">
                  <h4>Título:</h4>
                  {{ pill.pill_teacher.academic_title }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.email">
                  <h4>Correo eletrónico:</h4>
                  {{ pill.pill_teacher.email }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.linkedin">
                  <h4>Linkedin:</h4>
                  {{ pill.pill_teacher.linkedin }}
                </v-col>
              </v-row>
              
            </v-card-text>

            <v-card-text v-if="show_video&&pill.type_content=='youtube_video'">
              <v-col cols="12" align="center">
                <LazyYoutube :src="pill.content" />
              </v-col>

              <v-col cols="12" class="pt-2">
                <h3>{{ pill.name }}</h3>
                <v-divider></v-divider>
                <p class="text-pre-wrap pt-4">
                  {{ pill.description }}
                </p>
              </v-col>

              <v-col cols="12" class="pt-1">
                <h3>Docente:</h3>
                <v-divider></v-divider>
              </v-col>
              <v-row  class="pa-3">
                <v-col cols="12" xl="6" md="6" sm="12">
                  <h4>Apellido y nombre:</h4>
                  {{ pill.pill_teacher.abbreviated_academic_title }}
                  {{ pill.pill_teacher.lastname_teacher.toUpperCase() }}, 
                  {{ pill.pill_teacher.name_teacher }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.academic_title">
                  <h4>Título:</h4>
                  {{ pill.pill_teacher.academic_title }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.email">
                  <h4>Correo eletrónico:</h4>
                  {{ pill.pill_teacher.email }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.linkedin">
                  <h4>Linkedin:</h4>
                  {{ pill.pill_teacher.linkedin }}
                </v-col>
              </v-row>
            </v-card-text>

            <v-card-text v-if="show_video&&pill.type_content=='vimeo_video'">
              <v-col cols="12" align="center">
                <LazyVimeo :src="pill.content" />
              </v-col>
              

              <v-col cols="12" class="pt-2">
                <h3>{{ pill.name }}</h3>
                <v-divider></v-divider>
                <p class="text-pre-wrap pt-4">
                  {{ pill.description }}
                </p>
              </v-col>

              <v-col cols="12" class="pt-1">
                <h3>Docente:</h3>
                <v-divider></v-divider>
              </v-col>
              <v-row  class="pa-3">
                <v-col cols="12" xl="6" md="6" sm="12">
                  <h4>Apellido y nombre:</h4>
                  {{ pill.pill_teacher.abbreviated_academic_title }}
                  {{ pill.pill_teacher.lastname_teacher.toUpperCase() }}, 
                  {{ pill.pill_teacher.name_teacher }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.academic_title">
                  <h4>Título:</h4>
                  {{ pill.pill_teacher.academic_title }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.email">
                  <h4>Correo eletrónico:</h4>
                  {{ pill.pill_teacher.email }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.linkedin">
                  <h4>Linkedin:</h4>
                  {{ pill.pill_teacher.linkedin }}
                </v-col>
              </v-row>
            </v-card-text>

            <v-card-text v-if="show_video&&pill.type_content=='nube_unl_video'">
              <v-col cols="12" align="center">
                <video controls width="100%">
                  <source :src="pill.content" type="video/mp4">
                </video>
              </v-col>
              

              <v-col cols="12" class="pt-2">
                <h3>{{ pill.name }}</h3>
                <v-divider></v-divider>
                <p class="text-pre-wrap pt-4">
                  {{ pill.description }}
                </p>
              </v-col>

              <v-col cols="12" class="pt-1">
                <h3>Docente:</h3>
                <v-divider></v-divider>
              </v-col>
              <v-row  class="pa-3">
                <v-col cols="12" xl="6" md="6" sm="12">
                  <h4>Apellido y nombre:</h4>
                  {{ pill.pill_teacher.abbreviated_academic_title }}
                  {{ pill.pill_teacher.lastname_teacher.toUpperCase() }}, 
                  {{ pill.pill_teacher.name_teacher }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.academic_title">
                  <h4>Título:</h4>
                  {{ pill.pill_teacher.academic_title }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.email">
                  <h4>Correo eletrónico:</h4>
                  {{ pill.pill_teacher.email }}
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="pill.pill_teacher.linkedin">
                  <h4>Linkedin:</h4>
                  {{ pill.pill_teacher.linkedin }}
                </v-col>
              </v-row>
            </v-card-text>

            <v-card-text v-if="show_video&&pill.type_content=='pdf'">
              <v-col cols="12" align="center">
                <v-img
                  :src="require('@/assets/icons/pdf-icon.png')"
                  contain
                  height="180"
                />
                <v-btn 
                  class="mt-8 pa-6"
                  color="success"
                  :href="url" >
                  <v-icon
                    dark
                  >
                    mdi-download
                  </v-icon>
                    Descargar
                </v-btn>
              </v-col>
              <v-col cols="12" class="pt-8">
                <h3>{{ pill.name }}</h3>
                <v-divider></v-divider>
                <p class="text-pre-wrap pt-4">
                  {{ pill.description }}
                </p>
              </v-col>
            </v-card-text>

            <v-card-text v-if="!show_video" align="center" style="padding-top:164px;">
              <v-progress-circular
                :size="70"
                :width="7"
                color="purple"
                indeterminate
              ></v-progress-circular>
            </v-card-text>
          </v-sheet>
        </v-col>

        <v-col cols="12" xl="4" md="4" sm="12">
          <v-sheet 
            height="100%" 
            class="overflow-auto mx-auto" 
            outlined>
            <v-list flat>
              <v-subheader>CONTENIDO</v-subheader>
              <v-list-item-group
                v-model="selectedItem"
                mandatory
                color="indigo"
              >
                <v-list-item
                  v-for="(pill, i) in pills"
                  :key="i"  
                  @click="getPill(pill.slug)"
                >
                  <v-list-item-icon>
                    <v-icon > {{ (pill.type_content=='pdf')?'mdi-file':'mdi-video' }}</v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title v-text="pill.name"></v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-sheet>
        </v-col>
      </v-row>

      <v-row class="pt-2 pb-8" v-if="(pills.length > 0)?false:true">
        <v-col cols="12" class="text-center pt-8">
          <v-icon
            x-large
          >
            mdi-timer-sand-empty
          </v-icon>
          
          <h1 class="font-weight-light pt-8 pb-8">
            El administrador aún no subió píldoras a este módulo.
          </h1>
        </v-col>
      </v-row>

    </v-col>

  </v-row>
</template>
<script>
  import axios from 'axios'
  import { LazyYoutube, LazyVimeo  } from "vue-lazytube"
  const APP_URL = process.env.VUE_APP_URL

  export default {
    name: 'contentModule',
    components: {
        LazyYoutube,
        LazyVimeo 
    },
    props:['module', 'pills'],
    data() {
      return {
        slug:null,
        overlay:true,

        show_video:true,
        url:'',
        selectedItem: 0,
        
        pill:[]
      }
    },
    methods: {
      async getPill(slug) {
        this.show_video=false
        this.overlay = true
        try {
          await axios.get('modules-pre-incubation/pill/'+ slug ).then(response => {
            this.pill = response.data.pill
            this.url = APP_URL + response.data.pill.url
            this.show_video=true
            this.overlay = false
          })
        } catch (error) {
          console.log(error);
          //this.$router.push({ name: 'home' })
        }
      },

      cheackPills(){
        if(this.pills.length!=0){
          this.getPill(this.pills[0].slug)
        }
      }
    },
    created() {
      this.slug = this.$route.params.slug;
      this.cheackPills()
    }
  }
</script>
<style scoped>
.video {
  max-height:420px; 
  width: auto;
  aspect-ratio: 16 / 9;
}
</style>