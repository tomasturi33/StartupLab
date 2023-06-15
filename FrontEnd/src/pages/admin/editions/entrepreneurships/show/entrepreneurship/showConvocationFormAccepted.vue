<template>
  <v-row>

    <template v-if="!loading">
      <v-col cols="12" class="pa-3">
        <showConvocationForm  :user="entrepreneurship.user"
                              :provincia="entrepreneurship.provincia"
                              :localidad="entrepreneurship.localidad"
                              :entrepreneurship_stadia="entrepreneurship.entrepreneurship_stadia"
                              :development_degrees="entrepreneurship.development_degrees"
                              :vertical_works="entrepreneurship.vertical_works"
                              :title="entrepreneurship.title" 
                              :executive_summary="entrepreneurship.executive_summary"
                              :problem_detected="entrepreneurship.problem_detected"
                              :proposed_solution="entrepreneurship.proposed_solution"
                              :products_services_you_offer="entrepreneurship.products_services_you_offer"
                              :entrepreneurial_team="entrepreneurship.entrepreneurial_team"
                              :market="entrepreneurship.market"
                              :action_plan="entrepreneurship.action_plan"
                              :idea_need="entrepreneurship.idea_need"
                              :curriculum_idea="entrepreneurship.curriculum_idea"
                              :video="entrepreneurship.video">
        </showConvocationForm>
      </v-col>
      
      <v-col cols="12" class="d-sm-flex pt-8">
        <v-btn
          depressed
          :block="$vuetify.breakpoint.xsOnly"
          class="mr-auto mt-2"
          color="primary"
          :to="{ name: 'showEntrepreneurshipsEdition', params: { edition_id: this.edition_id }}"
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
          @click="downloadPDF" >
          <v-icon
            dark
          >
            mdi-download
          </v-icon>
          Descargar PDF
        </v-btn>
      </v-col>

    </template>

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

  import showConvocationForm from '@/components/entrepreneur/convocation/showConvocationForm.vue'

  export default {
    name: 'showConvocationFormAccepted',
    components: {
      showConvocationForm
    },
    data: () => ({
      loading:true,
      loading_download: false,
      edition_id:null,
      entrepreneurship_id:null,

      entrepreneurship:null,

      attrs: {
        boilerplate: false,
      },
    }),

    methods:{
      async getEntrepreneurship(){
        await axios.get('admin/edition/'+this.edition_id+'/convocation-form/'+this.convocation_form_id).then(response =>{
          this.entrepreneurship = response.data.entrepreneurship
          this.loading=false
        }).catch(error => {
          console.log(error)
        })
      },

      async acceptEntrepreneurship(){
        await axios.put('admin/edition/'+this.edition_id+'/convocation-form/'+this.entrepreneurship_id,{
            condition: 'accepted'
          }).then(() =>{
            this.$router.push({ name: 'entrepreneurshipsEdition' })
          })
      },

      async downloadPDF(){
        this.loading_download=true
        this.url = VUE_URL_API + '/admin/edition/'+this.edition_id+'/convocation-form/'+this.convocation_form_id+'/generate-pdf'
        await axios.get(
          this.url, 
          {responseType: 'blob'}
        ).then((response) => {
          //window.open(URL.createObjectURL(response.data));
          const content = response.headers['content-type'];
          download(response.data, this.convocation_form_id+' - '+ this.entrepreneurship.title , content)
          this.loading_download=false
        })
      },
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.entrepreneurship_id = this.$route.params.entrepreneurship_id;
      this.convocation_form_id =  this.$route.params.convocation_form_id
      this.getEntrepreneurship()
      },
  }
</script>