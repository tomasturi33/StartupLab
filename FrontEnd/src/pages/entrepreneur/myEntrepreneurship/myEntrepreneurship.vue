<template>
  <v-row  class="justify-space-around text-center" style="padding-top:3rem;">
    
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
                  :to="{name: 'myStartUp'}">
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
                  :to="{name: 'myEntrepreneurialTeam'}">
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
            <v-img :src="require('@/assets/icons/window.png')"></v-img>

            <v-fade-transition>
              <v-overlay
                v-if="hover"
                absolute
                color="#036358"
              >
                <v-btn
                  :to="{name: 'myWindow'}"
                  >
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
    name: 'myEntrepreneurship',

    data: () => ({
      loading:true,
      state_convocation_form:'',
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form'
      ])
    },
    methods:{
      async getStatus(){
        await axios.get('convocation/status/'+this.convocation_form.convocation_form.id).then((response) =>{
          this.state_convocation_form=response.data.status;
          this.loading=false;
        }).catch(error => {
          console.log(error);
        })
      }
    },

    created(){
      this.getStatus()
    }
  }
</script>
<style>
.rounded-card{
    border-radius:100px;
}

.zoom {
  cursor:pointer;
  padding: 50px;
  transition: transform .15s; /* Animation */
}

.zoom:hover {
  transform: scale(1.01); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>