<template>
  <v-row>
    <v-col cols="12">
      <v-sheet
          width="100%"
          outlined 
          v-if="!loading"
        >
        <v-row class="ma-1" >

          <v-col cols="12" :md="cols" sm="12">

            <v-col 
              cols="12">
              <label class="font-weight-regular text-uppercase">Idea:</label>
                <p class="text-pre-wrap font-weight-light pt-2">{{ entrepreneurship.title }}</p>
            </v-col>

            <v-col 
              v-if="entrepreneurship.executive_summary"
              cols="12">
                <label class="font-weight-regular text-uppercase">Resumen ejecutivo:</label>
                <p class="text-pre-wrap font-weight-light pt-2">{{ entrepreneurship.executive_summary }}</p>
            </v-col>

            <v-col 
              v-if="entrepreneurship.problem_detected"
              cols="12">
                <label class="font-weight-regular text-uppercase">Problema Detectado:</label>
                <p class="text-pre-wrap font-weight-light pt-2">{{ entrepreneurship.problem_detected }}</p>
            </v-col>

            <v-col 
              v-if="entrepreneurship.proposed_solution"
              cols="12">
                <label class="font-weight-regular text-uppercase">Solución propuesta:</label>
                <p class="text-pre-wrap font-weight-light pt-2">{{ entrepreneurship.proposed_solution }}</p>
            </v-col>

            <v-col 
              v-if="entrepreneurship.market && entrepreneurship.market!='null'"
              cols="12">
                <label class="font-weight-regular text-uppercase">Mercado:</label>
                <p class="text-pre-wrap font-weight-light pt-2">{{ entrepreneurship.market }}</p>
            </v-col>

            <v-col 
              v-if="entrepreneurship.strategic_alliance && entrepreneurship.strategic_alliance!='null'"
              cols="12">
                <label class="font-weight-regular text-uppercase">Asociación estrategica:</label>
                <p class="text-pre-wrap font-weight-light pt-2">{{ entrepreneurship.strategic_alliance }}</p>
            </v-col>

            <v-col 
              v-if="entrepreneurship.entrepreneurial_team && entrepreneurship.entrepreneurial_team!='null'"
              cols="12">
                <label class="font-weight-regular text-uppercase">Equipo emprendedor:</label>
                <p class="text-pre-wrap font-weight-light pt-2">{{ entrepreneurship.entrepreneurial_team }}</p>
            </v-col>

            <v-col 
              v-if="entrepreneurship.contact && entrepreneurship.contact!='null'"
              cols="12">
                <label class="font-weight-regular text-uppercase">Contacto:</label>
                <p class="text-pre-wrap font-weight-light pt-2">{{ entrepreneurship.contact }}</p>
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
                  style="position: sticky; top: 82px; cursor: pointer;"
                  class="rounded"
                  contain
                  v-bind:src="url_image_1"
                  height="100%"
                  max-height="100px"
                  @click="showImage(1)"
                ></v-img>
              </v-col>

              <v-col cols="6" v-if="url_image_2">
                <v-img
                  style="position: sticky; top: 82px; cursor: pointer;"
                  class="rounded"
                  contain
                  v-bind:src="url_image_2"
                  height="100%"
                  max-height="100px"
                  hover
                  @click="showImage(2)"
                ></v-img>
              </v-col>

              <v-col cols="6" v-if="url_image_3">
                <v-img
                  style="position: sticky; top: 82px; cursor: pointer;"
                  class="rounded"
                  contain
                  v-bind:src="url_image_3"
                  height="100%"
                  max-height="100px"
                  @click="showImage(3)"
                ></v-img>
              </v-col>

              <v-col cols="6" v-if="url_image_4">
                <v-img
                  style="position: sticky; top: 82px; cursor: pointer;"
                  class="rounded"
                  contain
                  v-bind:src="url_image_4"
                  height="100%"
                  max-height="100px"
                  @click="showImage(4)"
                ></v-img>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'otherentrepreneurships'}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>

      <v-spacer />

      <v-btn
        depressed
        color="primary"
        :loading="loading_download"
        @click="downloadPDF()"
        >
        Descargar PDF
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
  const APP_URL = process.env.VUE_APP_URL
  import axios from 'axios'
  import download from 'downloadjs'
  const VUE_URL_API = process.env.VUE_APP_URL_API

  export default {
    name: 'showOtherEntrepreneurships',

    data: () => ({
      loading_download:false,
      slug:'',
      show: false,
      title:'Top western road trips Top western Top western road trips Top western',
      entrepreneurship:null,
      url_logo: null,
      url_image_1: null,
      url_image_2: null,
      url_image_3: null,
      url_image_4: null,
      loading:true,
      images_window: [],
      cols:8
    }),

    methods:{
      showImage(image) {
        let images_aux = this.images_window
        images_aux = this.rotate(images_aux, image)
        this.$viewerApi({
          images: images_aux,
            options: {
              toolbar: false,
              title: false,
              button: true,
            }
        })
      },

      rotate(arr, count = 1){
        return [...arr.slice(count, arr.length), ...arr.slice(0, count)];
      },

      async getEntrepreneurship(){
        await axios.get('entrepreneurship-windows/'+this.slug).then(response =>{
          this.entrepreneurship = response.data.window
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

          this.loading = false
        }).catch(error => {
          this.loading = false
          console.log(error);
        })
      },

      async downloadPDF(){
        this.loading_download=true
        this.url = VUE_URL_API + '/entrepreneurship-windows/'+this.slug+'/generate-pdf'
        await axios.get(
          this.url, 
          {responseType: 'blob'}
        ).then((response) => {
          const content = response.headers['content-type'];
          download(response.data,  this.entrepreneurship.title , content)
          this.loading_download=false
        })
      },

      getImgUrl(emp) {
        console.log(APP_URL +emp)
        var images = require.context('@/assets/img/emprendimientos/', false, /\.jpg$/)
        let number = this.getRandomInt(3)+1
        return images("./"+ number +".jpg")
      },

      getRandomInt(max) {
        return Math.floor(Math.random() * max);
      }
    },

    created(){
       this.slug = this.$route.params.slug;
       this.getEntrepreneurship()
    },
  }
</script>
<style>
.images {
  position: fixed;
}
</style>