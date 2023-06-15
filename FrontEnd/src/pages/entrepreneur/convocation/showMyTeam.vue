<template>
<v-row>
  <template>

    <v-col cols="12">
      <pendingProfile />
    </v-col>

    <v-col cols="12" class="pt-8 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'convocation'}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>
      <v-spacer />
    </v-col>
  </template>
</v-row>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'
  import pendingProfile from '@/components/entrepreneur/convocation/team/pendingProfile.vue'

  export default {
    name: 'myTeam',
    components: {
      pendingProfile
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
              alert(this.entrepreneurship_stadium)
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },	

    },

    created(){
      //this.getTeam()
    },
  }
</script>