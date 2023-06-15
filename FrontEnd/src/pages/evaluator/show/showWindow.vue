<template>
  <v-row>
    <v-col cols="12">
      <showWindow v-if="!loading" :entrepreneurship="entrepreneurship"/>
    </v-col>

    <v-col cols="12" class="pt-8 d-sm-flex">
      <v-btn
        depressed
        color="primary"
        :block="$vuetify.breakpoint.xsOnly"
        class="mr-auto mt-2"
        :to="{ name: 'EntrepreneurshipTasksEvaluator', params: { slug: this.slug }}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>

      <v-spacer />

      <v-btn
        depressed
        :block="$vuetify.breakpoint.xsOnly"
        class="mr-2 mt-2"
        color="primary"
        :loading="loading_download"
        @click="downloadPDF()">
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

  import showWindow from '@/components/entrepreneurships/show/showWindow'

  export default {
    components: {showWindow},
    data: () => ({
      loading:true,
      loading_download: false,
      slug:'',
      entrepreneurship:null,
    }),

    methods:{
      async getWindowEntrepreneurship(){
        await axios.get('evaluator/evaluators/'+this.slug+'/window').then(response =>{
          this.entrepreneurship = response.data.window
          this.loading = false
        }).catch(error => {
          this.loading = false
          console.log(error);
        })
      },

      async downloadPDF(){
        this.loading_download=true

        this.url = VUE_URL_API + '/evaluator/evaluators/'+this.slug+'/window/generate-pdf'
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
       this.getWindowEntrepreneurship()
    },
  }
</script>
<style>
.images {
  position: fixed;
}
</style>