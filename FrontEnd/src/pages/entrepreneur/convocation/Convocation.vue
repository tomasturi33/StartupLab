<template>
  <v-row style="padding-top:5rem;">
    <convocationEmpty v-if="state_convocation_form=='empty'"></convocationEmpty>
    <convocationInProgress v-if="state_convocation_form=='in_progress'"></convocationInProgress>
    <convocationPending v-if="state_convocation_form=='pending'"></convocationPending>

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
  import convocationEmpty from '@/components/entrepreneur/convocation/convocationEmpty'
  import convocationInProgress from '@/components/entrepreneur/convocation/convocationInProgress'
  import convocationPending from '@/components/entrepreneur/convocation/convocationPending.vue'

  export default {
    name: 'Convocation',
    components: {
      convocationEmpty,
      convocationInProgress,
      convocationPending
    },

    data: () => ({
      state_convocation_form:'',
      loading:true
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form'
      ])
    },
    methods:{
      async getStatus(){
        await axios.get('convocation/status/'+this.convocation_form.convocation_form.id).then((response) =>{
          this.state_convocation_form = response.data.status;
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
.zoom {
  cursor:pointer;
  padding: 50px;
  transition: transform .15s; /* Animation */
}

.zoom:hover {
  transform: scale(1.01); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

 {

  class="cartel"border-radius: 10px 100px / 120px;
}
</style>