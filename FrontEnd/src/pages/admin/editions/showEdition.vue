<template>
  <v-row>

    <information 
      :name="name" 
      :description="description" />
    
    <estadios 
      :module_pre_incubations="module_pre_incubations" />
    
    <convocation 
      :published="published"
      :start_date="start_date"
      :start_time="start_time"
      :finish_date="finish_date"
      :finish_time="finish_time" />

    <termsConditionsVue
      :terms_and_conditions="terms_and_conditions" />

    
    <v-col cols="12" class="pt-2 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'editions'}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
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
  import information from '@/components/admin/editions/show/information.vue'
  import estadios from '@/components/admin/editions/show/estadios.vue'
  import convocation from '@/components/admin/editions/show/convocation.vue'
  import termsConditionsVue from '@/components/admin/editions/show/TermsConditions.vue'

  export default {
    name: 'showEdition',
    components: { information, estadios, convocation, termsConditionsVue },

    data: () => ({
      loading:true,
      edition_id:null,
      edition:null,

      name:null,
      description:null,
      module_pre_incubations:null,
      published:null,
      start_date:null,
      start_time:null,
      finish_date:null,
      finish_time:null,
      startDate:null,
      finishDate:null,

      terms_and_conditions:null,
    }),

    methods:{
      async getEdition(){
        await axios.get('admin/editions/'+this.edition_id).then(response =>{
          this.edition = response.data.edition
          this.loading=false

          this.name = response.data.edition.name
          this.description = response.data.edition.description
          this.module_pre_incubations = response.data.edition.module_pre_incubations
          this.published = response.data.edition.published

          if(this.published){
            this.start_date = this.dateConvert(response.data.edition.start_date)
          }
            
          this.start_time = response.data.edition.start_time

          if(this.published){
            this.finish_date = this.dateConvert(response.data.edition.finish_date)
          }
            
          this.finish_time = response.data.edition.finish_time
          this.terms_and_conditions = response.data.edition.terms_and_conditions
        }).catch(error => {
          console.log(error);
        })
      },

      dateConvert(date){
        const parts = date.split(/[- :]/);
        return `${parts[2]}/${parts[1]}/${parts[0]}`;
      },

      showModule(id){
        alert(id)
        //this.$router.push({ name: 'showModule', params: { id: id }})
      },
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.getEdition()
      },
  }
</script>