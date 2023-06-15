<template>
  <div v-if="!loading">

    <entrepreneurEmpty v-if="state_convocation_form.status=='empty'"></entrepreneurEmpty>
    <entrepreneurInProgress v-if="state_convocation_form.status=='in_progress'"></entrepreneurInProgress>
    <entrepreneurPending v-if="state_convocation_form.status=='pending'"></entrepreneurPending>
    <entrepreneurAcceptedVue v-if="state_convocation_form.status=='accepted'"></entrepreneurAcceptedVue>

  </div>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'

  import entrepreneurEmpty from '@/components/entrepreneur/home/entrepreneurEmpty'
  import entrepreneurPending from '@/components/entrepreneur/home/entrepreneurPending'
  import entrepreneurInProgress from '@/components/entrepreneur/home/entrepreneurInProgress'
  import entrepreneurAcceptedVue from '@/components/entrepreneur/home/entrepreneurAccepted.vue'

  export default {
    name: 'Home',
    components: {
      entrepreneurEmpty, entrepreneurPending, entrepreneurInProgress, entrepreneurAcceptedVue
    },
    data: () => ({
      state_convocation_form: null,
      loading: true
    }),

    computed: {
      ...mapGetters([
        'isLogged', 'drawer', 'user', 'convocation_form'
      ])
    },

    methods:{
      async getStatus(){
        await axios.get('convocation/status/'+this.convocation_form.convocation_form.id).then((response) =>{
          this.state_convocation_form=response.data;
          this.loading=false;
        }).catch(error => {
          console.log(error);
        })
      }
    },

    created(){
      this.getStatus()
    },
  }
</script>