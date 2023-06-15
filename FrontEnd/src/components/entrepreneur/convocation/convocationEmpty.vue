<template>
  <v-row class="text-center">

    <v-col class="pa-4">
      <v-hover>
        <template v-slot:default="{ hover }">
          <v-card
            class="mx-auto rounded-xl"
            max-width="280"
          >
            <v-img :src="require('@/assets/icons/upload_idea.png')"></v-img>

            <v-fade-transition>
              <v-overlay
                v-if="hover"
                absolute
                color="#036358"
              >
                <v-btn
                  :to="{name: 'my-idea'}">
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
            disabled
          >
            <v-img :src="require('@/assets/icons/upload_team.png')"></v-img>

            <v-fade-transition>
              <v-overlay
                v-if="hover"
                absolute
                color="#036358"
              >
                <v-btn
                  :to="{name: 'my-idea'}">
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
            disabled
          >
            <v-img :src="require('@/assets/icons/upload_idea.png')"></v-img>

            <v-fade-transition>
              <v-overlay
                v-if="hover"
                absolute
                color="#036358"
              >
                <v-btn
                  :to="{name: 'my-idea'}">
                  Ver más
                </v-btn>
              </v-overlay>
            </v-fade-transition>
          </v-card>
        </template>
      </v-hover>
    </v-col>

  </v-row>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'

  export default {
    name: 'convocationEmpty',
    data: () => ({
      loading: true,
      state_convocation_form:'empty'
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form'
      ])
    },
    methods:{
      async getStatus(){
        await axios.get('convocation/status/'+this.convocation_form.id).then((response) =>{
          this.state_convocation_form=response.data.status;
          this.loading=false;
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
<style scoped>
  .row-width{
    width: 100%;
  }

  .card{
    position: relative;
    overflow: hidden;
    display: flex;
    
    width: 200px; /* Box dimensions */
    height: 200px; 
    
    border-radius: 4px; /* Styling */
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);  
    transition: box-shadow 0.56s ease-in-out; /* Animation */
    /* background-color: rgba(0,0,0,.2); /* for debugging */
  }

  /* Prepares a container to have cover background */
  .has-bg-img{
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
  }
  /* Loads a specific image to a container */
  .bg-img-nature{
    background-image:require('@/assets/icons/rocket_white.png');
  }
</style>