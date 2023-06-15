<template>
  <v-row>
    <v-col cols="12">
      <showTeam v-if="!loading" :team="team"/>
    </v-col>

    <v-col cols="12" class="pt-8 d-flex justify-space-between">
      <v-btn
        depressed
        :block="$vuetify.breakpoint.xsOnly"
        color="primary"
        :to="{ name: 'showEntrepreneurships', params: { id : this.entrepreneurship_id }}"
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
  import showTeam from '@/components/entrepreneurships/show/showTeam'

  export default {
    name: 'showEntrepreneurshipsTeam',
    components:{ showTeam },
    data: () => ({
      loading:true,
      dialog_show:false,
      entrepreneurship_id:null,
      convocation_form_id:null,

      data:[],
      team:[],
      entrepreneur:[],
    }),

    methods:{
      async getTeam(){
        await axios.get('admin/entrepreneurships/'+this.entrepreneurship_id+'/team').then(response =>{
          this.entrepreneurship = response.data.entrepreneurship
          this.team = response.data.team
          this.data = response.data
          this.loading = false
        }).catch(error => {
          this.loading = false
          console.log(error);
        })
      }
    },

    created(){
      this.entrepreneurship_id = this.$route.params.id
      this.getTeam()
    }
  }
</script>