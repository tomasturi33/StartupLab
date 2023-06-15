<template>
  <v-row>
    <template v-if="!loading">
      
      <v-col>
        <showConvocationForm  :user="user"
                              :provincia="provincia"
                              :localidad="localidad"
                              :entrepreneurship_stadia="entrepreneurship_stadia"
                              :development_degrees="development_degrees"
                              :vertical_works="vertical_works"
                              :title="title" 
                              :executive_summary="executive_summary"
                              :problem_detected="problem_detected"
                              :proposed_solution="proposed_solution"
                              :products_services_you_offer="products_services_you_offer"
                              :entrepreneurial_team="entrepreneurial_team"
                              :market="market"
                              :action_plan="action_plan"
                              :idea_need="idea_need"
                              :video="video"
                              :curriculum_idea="curriculum_idea" >
        </showConvocationForm>
      </v-col>

      <v-col cols="12" class="pt-8 d-flex justify-space-between">
        <v-btn
          depressed
          color="info"
          :to="{ name: 'convocation'}"
          >
          <v-icon left>
            mdi-arrow-left
          </v-icon>
          Volver
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
  import { mapGetters } from 'vuex'

  import showConvocationForm from '@/components/entrepreneur/convocation/showConvocationForm.vue'

  export default {
    name: 'showMyIdea',
    components: {
      showConvocationForm
    },

    data: () => ({
      aux:null, 
      show: false,
      id: null,
      user:[],
      entrepreneurship_stadia:[],
      development_degrees:[],
      vertical_works:[],
      provincia:[],
      localidad:[],

      title:'',
      executive_summary:'',
      problem_detected:'',
      proposed_solution:'',
      products_services_you_offer:'',
      entrepreneurial_team:'',
      market:'',
      action_plan:'',
      idea_need:[],
      video: null,
      curriculum_idea:[],
      entrepreneurship_stadia_id: null,
      development_degrees_id: null,
      provincia_id: null,
      localidad_id: null,
      editions:null,
      loading:true
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form'
      ])
    },
    methods:{
      async getMyIdea(){
        await axios.get('convocation/'+this.convocation_form.convocation_form.id).then(response =>{
          this.aux = response.data.convocation
          this.id = response.data.convocation.id

          this.title = response.data.convocation.title
          this.executive_summary = response.data.convocation.executive_summary
          this.problem_detected = response.data.convocation.problem_detected
          this.proposed_solution = response.data.convocation.proposed_solution
          this.products_services_you_offer = response.data.convocation.products_services_you_offer
          this.entrepreneurial_team = response.data.convocation.entrepreneurial_team
          this.market = response.data.convocation.market
          this.action_plan = response.data.convocation.action_plan

          this.idea_need = response.data.convocation.idea_need
          this.video = response.data.convocation.video
          this.curriculum_idea = response.data.convocation.curriculum_idea

          this.entrepreneurship_stadia_id = response.data.convocation.entrepreneurship_stadia_id
          this.development_degrees_id = response.data.convocation.development_degrees_id
          this.provincia_id = response.data.convocation.provincia_id
          this.localidad_id = response.data.convocation.localidad_id

          this.user = response.data.convocation.user
          this.provincia = response.data.convocation.provincia
          this.localidad = response.data.convocation.localidad
          this.entrepreneurship_stadia = response.data.convocation.entrepreneurship_stadia
          this.development_degrees = response.data.convocation.development_degrees
          this.vertical_works = response.data.convocation.vertical_works
          
          this.loading = false
        }).catch(error => {
          console.log(error);
        })
      }
    },

    created(){
      this.getMyIdea()
    },
  }
</script>
<style>
.zoom {
  cursor:pointer;
  padding: 50px;
  transition: transform .15s; /* Animation */
}

.zoom:hover {
  transform: scale(1.01); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>