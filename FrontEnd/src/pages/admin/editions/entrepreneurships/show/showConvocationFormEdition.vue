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
                              :video="entrepreneurship.video"
                              :curriculum_idea="entrepreneurship.curriculum_idea">
        </showConvocationForm>
      </v-col>

      <v-col cols="12" class="pt-2">
        <v-sheet
          width="100%"
          outlined 
        >
          <v-row>
            <v-col cols="12" class="ma-8">
              <label class="font-weight-regular text-uppercase">
                Equipo emprendedor:
              </label>
            </v-col>
            <v-col cols="12">
              <showProfiles />
            </v-col>
          </v-row>
        </v-sheet>
      </v-col>

      <v-col cols="12" class="d-sm-flex pt-8">

        <v-btn 
          :block="$vuetify.breakpoint.xsOnly"
          class="mr-auto mt-2"
          depressed
          color="primary"
          :to="{ name: 'entrepreneurshipsEdition', params: { id: this.edition_id }}"
          >
          <v-icon left>
            mdi-arrow-left
          </v-icon>
          Volver
        </v-btn>

        <v-btn
          v-if="entrepreneurship.condition=='pending'"
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

        <v-btn
          v-if="entrepreneurship.condition=='pending'"
          :block="$vuetify.breakpoint.xsOnly"
          class="mr-2 mt-2"
          depressed
          color="primary"
          @click="inProgressEntrepreneurship">
          Marcar como en progreso
        </v-btn>
        
        <v-btn
          v-if="entrepreneurship.condition=='pending'"
          :block="$vuetify.breakpoint.xsOnly"
          class="mt-2 mr-2"
          depressed
          color="primary"
          @click="rejectedEntrepreneurship">
          Rechazar
        </v-btn>
        <v-btn
          v-if="entrepreneurship.condition=='pending'"
          :block="$vuetify.breakpoint.xsOnly"
          class="mt-2"
          depressed
          color="primary"
          @click="confirmEntrepreneurship">
          Aceptar
        </v-btn>
      </v-col>
    </template>

    <v-dialog
      v-model="dialog_confirm"
      max-width="420"
    >
      <v-card>
        <v-card-title class="text-h5">
          Advertencia
        </v-card-title>

        <v-card-text>
          {{ message_confirm }}
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="info darken-1"
            text
            @click="dialog_confirm = false"
          >
            Cancelar
          </v-btn>

          <v-btn
            color="info darken-1"
            text
            @click="changeConditionEntrepreneurship"
          >
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

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
  import showProfiles from '@/components/team/showProfiles.vue'

  export default {
    name: 'showEntrepreneurshipsEdition',
    components: {
      showConvocationForm,
      showProfiles
    },
    data: () => ({
      dialog_confirm:false,
      message_confirm:null,
      condition:null,

      loading_download:false,
      loading:true,
      edition_id:null,
      convocation_form_id:null,
      url:null,

      entrepreneurship:[],

      attrs: {
        boilerplate: false,
      },
    }),

    methods:{
      async getEntrepreneurship(){
        await axios.get('admin/edition/'+this.edition_id+'/convocation-form/'+this.convocation_form_id).then(response =>{
          this.entrepreneurship = response.data.entrepreneurship

          //this.url = APP_URL + '/generate-pdf/' + this.convocation_form_id
          
          this.loading=false
        }).catch(error => {
          console.log(error)
        })
      },

      confirmEntrepreneurship(){
        this.condition = 'accepted'
        this.message_confirm = '¿Estas seguro de querer aceptar este emprendimiento?'
        this.dialog_confirm = true
      },

      rejectedEntrepreneurship(){
        this.condition = 'rejected'
        this.message_confirm = '¿Estas seguro de querer rechazar este emprendimiento?'
        this.dialog_confirm = true
      },

      inProgressEntrepreneurship(){
        this.condition = 'in_progress'
        this.message_confirm = '¿Estas seguro de querer marcar como en progreso a este emprendimiento?'
        this.dialog_confirm = true
      },

      async changeConditionEntrepreneurship(){
        await axios.put('admin/edition/'+this.edition_id+'/convocation-form/'+this.convocation_form_id,{
            condition: this.condition
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

      async downloadPDF2() {

        await axios({
          url: this.url,
          method: 'GET',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          responseType: 'blob',
        }).then((res) => {
          var FILE = window.URL.createObjectURL(new Blob([res.data]));
        
          var docUrl = document.createElement('x');
          docUrl.href = FILE;
          docUrl.setAttribute('download', 'sample.pdf');
          document.body.appendChild(docUrl);
          docUrl.click();
        });
      },
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.convocation_form_id = this.$route.params.convocation_form_id;
      this.getEntrepreneurship()
      },
  }
</script>