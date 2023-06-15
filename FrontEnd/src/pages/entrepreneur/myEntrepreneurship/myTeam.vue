<template>
  <v-row>
    <v-col cols="12">
      <responsibleProfile v-if="convocation_form.convocation_form.user_id===user.user_id" />
      <noResponsibleProfile v-if="convocation_form.convocation_form.user_id!==user.user_id" />
    </v-col>

    <v-col cols="12" class="pt-8 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'myEntrepreneurship'}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>
      <v-spacer />
      <v-btn
        depressed
        :loading="loading"
        color="primary"
        v-if="id"
        @click="updateMyIdea"
        >
        Actualizar
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'
  import responsibleProfile from '@/components/entrepreneur/entrepreneurship/team/responsibleProfile.vue'
  import noResponsibleProfile from '@/components/entrepreneur/entrepreneurship/team/noResponsibleProfile.vue'

  export default {
    name: 'myTeam',
    components: {
      responsibleProfile,
      noResponsibleProfile
    },
    data: () => ({
      aux:null, 
      show: false,
      id: null,
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form', 'user'
      ])
    },
    methods:{
      async getEntrepreneurshipStadium(){
        try {
          await axios.get('entrepreneurship-stadium').then(response =>{
            if(response.data.length!==0){
              this.entrepreneurship_stadium = response.data.entrepreneurship_stadium
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },	

      async getMyIdea(){
        await axios.get('convocation').then(response =>{
          if(response.data.length!==0){
            this.aux = response.data
            this.id = response.data.id
            this.title = response.data.title
            this.executive_summary = response.data.executive_summary
            this.problem_detected = response.data.problem_detected
            this.proposed_solution = response.data.proposed_solution
            this.products_services_you_offer = response.data.products_services_you_offer
            this.market = response.data.market
            this.entrepreneurial_team = response.data.entrepreneurial_team
            this.action_plan = response.data.action_plan

            this.vertical_works_id = response.data.vertical_works_id

            this.entrepreneurship_stadia_id = response.data.entrepreneurship_stadia_id
            this.development_degrees_id = response.data.development_degrees_id

            this.provincia_id = response.data.provincia_id
            this.localidad_id = response.data.localidad_id
            
            this.getProvincias()
            this.getLocalidadesCreated()
            this.getEntrepreneurshipStadium()
            this.getDevelopmentDegree()
            this.getVerticalWorks()
          }
          this.loading = false
        }).catch(error => {
          console.log(error);
        })
      }

    },

    created(){
      //this.getTeam()
    },
  }
</script>