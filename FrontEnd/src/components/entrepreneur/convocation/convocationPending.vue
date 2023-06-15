<template>
  <v-container class="no-gutters">
    <v-row class="text-center">

      <v-col class="pa-4">
        <v-hover>
          <template v-slot:default="{ hover }">
            <v-card
              class="mx-auto rounded-xl"
              max-width="280"
            >
              <v-img :src="require('@/assets/icons/startup.png')"></v-img>

              <v-fade-transition>
                <v-overlay
                  v-if="hover"
                  absolute
                  color="#036358"
                >
                  <v-btn
                    :to="{name: 'showMyIdea'}">
                    Ver más
                  </v-btn>
                </v-overlay>
              </v-fade-transition>
            </v-card>
          </template>
        </v-hover>
      </v-col>

      <v-col class="pa-4">
        <v-hover>
          <template v-slot:default="{ hover }">
            <v-card
              class="mx-auto rounded-xl"
              max-width="280"
            >
              <v-img :src="require('@/assets/icons/team.png')"></v-img>

              <v-fade-transition>
                <v-overlay
                  v-if="hover"
                  absolute
                  color="#036358"
                >
                  <v-btn
                    :to="{name: 'showMyTeam'}">
                    Ver más
                  </v-btn>
                </v-overlay>
              </v-fade-transition>
            </v-card>
          </template>
        </v-hover>
      </v-col>

    </v-row>
  </v-container>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'

  export default {
    name: 'convocationPending',
    
    data: () => ({
      loading: true,
      state_convocation_form:null
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form'
      ])
    },
    methods:{
      async getStatus(){
        await axios.get('convocation/status/'+this.convocation_form.convocation_form.id).then((response) =>{
          this.state_convocation_form=response.data;
          this.loading=false;
          console.log(response)
        }).catch(error => {
          console.log(error);
        })
      }
    },

    created(){
      this.getStatus();
    },
  }
</script>