<template>
  <v-row>
    <v-col cols="12">
      <v-sheet
          outlined 
        >
        <v-row class="ma-1" >

          <v-col cols="12" :md="cols" sm="12">

            <v-col 
              cols="12">
                <v-alert icon="mdi-information" v-if="entrepreneurship.published==0" type="warning">
                  Esta vidriera aún se encuentra en construcción, por lo que la información aquí mostrada 
                  puede variar hasta que el equipo emprendedor la marque como PUBLICADA.
                </v-alert>
            </v-col>

            <v-col 
              cols="12">
              <label class="font-weight-regular text-uppercase">Idea:</label>
                <p class="text-pre-wrap font-weight-light pt-2">
                  {{ entrepreneurship.title }}
                </p>
            </v-col>

            <v-col cols="12">
                <label class="font-weight-regular text-uppercase">Resumen ejecutivo:</label>
                <p class="text-pre-wrap font-weight-light pt-2">
                  {{ (entrepreneurship.executive_summary)?entrepreneurship.executive_summary:'(vacio)' }}
                </p>
            </v-col>

            <v-col cols="12">
                <label class="font-weight-regular text-uppercase">Problema Detectado:</label>
                <p class="text-pre-wrap font-weight-light pt-2">
                  {{ (entrepreneurship.problem_detected)?entrepreneurship.problem_detected:'(vacio)' }}
                </p>
            </v-col>

            <v-col cols="12">
                <label class="font-weight-regular text-uppercase">Solución propuesta:</label>
                <p class="text-pre-wrap font-weight-light pt-2">
                  {{ (entrepreneurship.proposed_solution)?entrepreneurship.proposed_solution:'(vacio)' }}
                </p>
            </v-col>

            <v-col cols="12">
                <label class="font-weight-regular text-uppercase">Mercado:</label>
                <p class="text-pre-wrap font-weight-light pt-2">
                  {{ (entrepreneurship.market)?entrepreneurship.market:'(vacio)' }}
                </p>
            </v-col>
            
            <v-col cols="12">
                <label class="font-weight-regular text-uppercase">Asociación estrategica:</label>
                <p class="text-pre-wrap font-weight-light pt-2">
                  {{ (entrepreneurship.strategic_alliance)?entrepreneurship.strategic_alliance:'(vacio)' }}
                </p>
            </v-col>

            <v-col cols="12">
                <label class="font-weight-regular text-uppercase">Equipo emprendedor:</label>
                <p class="text-pre-wrap font-weight-light pt-2">
                  {{ (entrepreneurship.entrepreneurial_team)?entrepreneurship.entrepreneurial_team:'(vacio)' }}
                </p>
            </v-col>

            <v-col cols="12">
                <label class="font-weight-regular text-uppercase">Contacto:</label>
                <p class="text-pre-wrap font-weight-light pt-2">
                  {{ (entrepreneurship.contact)?entrepreneurship.contact:'(vacio)' }}
                </p>
            </v-col>
          </v-col>

          <v-col cols="12" md="3" sm="12">
            <v-row  style="position: sticky; top: 82px;">
              <v-col cols="12">
                <v-img
                  v-if="url_logo"
                  style="position: sticky; top: 82px; cursor: pointer;"
                  class="rounded"
                  contain
                  v-bind:src="url_logo"
                  max-height="140px"
                  @click="showImage(0)"
                ></v-img>
              </v-col>

              <v-col cols="6" v-if="url_image_1">
                <v-img
                  class="rounded img-windows"
                  v-bind:src="url_image_1"
                  hover
                  @click="showImage(1)"
                ></v-img>
              </v-col>

              <v-col cols="6" v-if="url_image_2">
                <v-img
                  class="rounded img-windows"
                  v-bind:src="url_image_2"
                  hover
                  @click="showImage(2)"
                ></v-img>
              </v-col>

              <v-col cols="6" v-if="url_image_3">
                <v-img
                  class="rounded img-windows"
                  v-bind:src="url_image_3"
                  hover
                  @click="showImage(3)"
                ></v-img>
              </v-col>

              <v-col cols="6" v-if="url_image_4">
                <v-img
                  class="rounded img-windows"
                  v-bind:src="url_image_4"
                  hover
                  @click="showImage(4)"
                ></v-img>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>
  </v-row>
</template>

<script>
  const APP_URL = process.env.VUE_APP_URL
  //import axios from 'axios'

  export default {
    name: 'showWindow',
    props:['entrepreneurship'],
    data: () => ({
      entrepreneurship_id:null,

      cols:6,

      show: false,
      title:'',

      url_logo: null,
      url_image_1: null,
      url_image_2: null,
      url_image_3: null,
      url_image_4: null,
      loading:true,
      images_window: []
    }),

    methods:{
      getWindowEntrepreneurship(){
        if(this.entrepreneurship.logo){
            this.url_logo = APP_URL + this.entrepreneurship.logo
            this.images_window.push(this.url_logo)
          }

          if(this.entrepreneurship.image_1){
            this.url_image_1 = APP_URL + this.entrepreneurship.image_1
            this.images_window.push(this.url_image_1)
          }
          
          if(this.entrepreneurship.image_2){
            this.url_image_2 = APP_URL + this.entrepreneurship.image_2
            this.images_window.push(this.url_image_2)
          }

          if(this.entrepreneurship.image_3){
            this.url_image_3 = APP_URL + this.entrepreneurship.image_3
            this.images_window.push(this.url_image_3)
          }
          
          if(this.entrepreneurship.image_4){
            this.url_image_4 = APP_URL + this.entrepreneurship.image_4
            this.images_window.push(this.url_image_4)
          }

          if( this.entrepreneurship.logo || 
              this.entrepreneurship.image_1 || 
              this.entrepreneurship.image_2 ||
              this.entrepreneurship.image_3 ||
              this.entrepreneurship.image_4)
          {
            this.cols =8
          }else{
            this.cols =12
          }
      },

      showImage(image) {
        let images_aux = this.images_window
        images_aux = this.rotate(images_aux, image)
        this.$viewerApi({
          images: images_aux,
        })
      },

      rotate(arr, count = 1){
        return [...arr.slice(count, arr.length), ...arr.slice(0, count)];
      },

    },

    created(){
       this.getWindowEntrepreneurship()
    },
  }
</script>
<style>
.images {
  position: fixed;
}

.img-windows {
  width: 100%;
  height: 110px;
  object-fit: scale-down;

  position: sticky; 
  top: 82px; 
  cursor: pointer;
}
</style>