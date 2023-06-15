<template>
  <v-row>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row>
          <v-col cols="12" xl="4" md="2" sm="12" class="pa-8 mr-auto">
            <v-btn 
              :block="$vuetify.breakpoint.xsOnly"
              color="primary"
              :to="{name:'newEntrepreneurshipEdition'}">
              Nuevo Emprendimiento
            </v-btn>  
          </v-col>

          <v-col cols="12" lg="8" md="8" sm="12" class="pa-8">
            <v-tabs v-model="active_tab" class="d-flex justify-end">
              <v-tab key="0" >En construccion</v-tab>
              <v-tab key="1" >Pendientes</v-tab>
              <v-tab key="2" >Aceptados</v-tab>
              <v-tab key="3" >Rechazados</v-tab>
            </v-tabs>
          </v-col>

          <v-col cols="12">
            <inProgress v-if="active_tab==0"></inProgress>
            <pending v-if="active_tab==1"></pending>
            <accepted v-if="active_tab==2"></accepted>
            <rejected v-if="active_tab==3"></rejected>
          </v-col>

        </v-row>

      </v-sheet>
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
  import inProgress from '@/components/admin/editions/entrepreneurships/inProgress.vue'
  import pending from '@/components/admin/editions/entrepreneurships/pending.vue'
  import accepted from '@/components/admin/editions/entrepreneurships/accepted.vue'
  import rejected from '@/components/admin/editions/entrepreneurships/rejected.vue'

  export default {
    name: 'entrepreneurshipsEdition',
    components: {
      inProgress,
      pending,
      accepted,
      rejected
    },
    data: () => ({
      edition_id:null,
      active_tab: 2,
      loading:true,
    }),
    methods:{
      async getEntrepreneurships(){
        this.show=false
        this.entrepreneurships=null
        await axios.get('admin/edition/'+this.edition_id+'/entrepreneurships').then(() =>{
          this.loading=false
          this.active_tab=2
        }).catch(error => {
          console.log(error)
        })
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.getEntrepreneurships()
    },
  }
</script>