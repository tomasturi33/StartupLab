<template>
  <v-row>
    <v-col cols="12">
       <showStartUp  v-if="!loading" :entrepreneurship="entrepreneurship" />
    </v-col>
    
    <v-col cols="12" class="pt-8 d-sm-flex">
      <v-btn
        depressed
        color="primary"
        :block="$vuetify.breakpoint.xsOnly"
        class="mr-auto mt-2"
        :to="{ name: 'showEntrepreneurships', params: { id: entrepreneurship_id } }"
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
        @click="donwloadPDF()"
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
  import axios from 'axios'
  import download from 'downloadjs'
  import showStartUp from '@/components/entrepreneurships/show/showStartUp'

  const VUE_URL_API = process.env.VUE_APP_URL_API

  export default {
    name: 'showEntrepreneurshipsStartup',
    components:{ showStartUp },
    data: () => ({
      loading: true,
      loading_download:false,
      entrepreneurship_id:null,
      entrepreneurship:null,
      convocation_form:null
    }),

    methods:{
      async getStartUp(){
        await axios.get('admin/entrepreneurships/'+this.entrepreneurship_id+'/startup').then(response =>{
          this.entrepreneurship = response.data.entrepreneurship
          this.loading = false
        }).catch(error => {
          this.loading = false
          console.log(error);
        })
      },

      async donwloadPDF(){
        this.loading_download=true

        this.url = VUE_URL_API + '/admin/entrepreneurships/'+this.entrepreneurship_id+'/startup/generate-pdf'
        await axios.get(
          this.url, 
          {responseType: 'blob'}
        ).then((response) => {
          const content = response.headers['content-type'];
          download(response.data, this.entrepreneurship.title , content)
          this.loading_download=false
        })
      }
    },

    created(){
       this.entrepreneurship_id = this.$route.params.id;
       this.getStartUp()
    },
  }
</script>
<style>
.images {
  position: fixed;
}
</style>