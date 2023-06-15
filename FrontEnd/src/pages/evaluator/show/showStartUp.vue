<template>
  <v-row>
    <v-col cols="12" class="pa-3">
      <showStartup v-if="!loading" :entrepreneurship="entrepreneurship" />
    </v-col>
    
    <v-col cols="12" class="d-sm-flex pt-8">
      <v-btn
        depressed
        :block="$vuetify.breakpoint.xsOnly"
        class="mr-auto mt-2"
        color="primary"
        :to="{ name: 'EntrepreneurshipTasksEvaluator', params: { slug: this.slug }}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>

      <v-btn
        :block="$vuetify.breakpoint.xsOnly"
        class="mr-2 mt-2"
        depressed
        color="primary"
        :loading="loading_download"
        @click="downloadPDF">
        <v-icon
          dark
        >
          mdi-download
        </v-icon>
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
  import axios from 'axios'
  import download from 'downloadjs'
  const VUE_URL_API = process.env.VUE_APP_URL_API

  import showStartup from '@/components/entrepreneurships/show/showStartUp.vue'

  export default {
    name: 'showStartupEvaluator',
    components: {
      showStartup
    },
    data: () => ({
      loading:true,
      loading_download: false,
      slug:null,
      entrepreneurship_id:null,

      entrepreneurship:null,

      attrs: {
        boilerplate: false,
      },
    }),

    methods:{
      async getEntrepreneurship(){
        await axios.get('evaluator/evaluators/'+this.slug+'/startup').then(response =>{
          this.entrepreneurship = response.data.entrepreneurship
          console.log(response.data)
          this.loading=false
        }).catch(error => {
          console.log(error)
        })
      },

      async downloadPDF(){
        this.loading_download=true

        this.url = VUE_URL_API + '/evaluator/evaluators/'+this.slug+'/startup/generate-pdf'
        await axios.get(
          this.url, 
          {responseType: 'blob'}
        ).then((response) => {
          //window.open(URL.createObjectURL(response.data));
          const content = response.headers['content-type'];
          download(response.data, this.entrepreneurship.title , content)
          this.loading_download=false
        })
      }
    },

    created(){
      this.slug = this.$route.params.slug;
      this.getEntrepreneurship()
      },
  }
</script>