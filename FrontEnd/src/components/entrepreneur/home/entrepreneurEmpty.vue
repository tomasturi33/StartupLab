<template>
  <v-row class="text-center">
    <v-col cols="12" class="display-1 pt-8">
        Bienvenid@ a la convocatoria <b>UNL Potencia</b>
    </v-col>
  
    <v-col cols="12">
      <v-img
        :src="require('@/assets/icons/rocket-joypixels.gif')"
        contain
        height="180"
      />
    </v-col>

    <v-col cols="12" class="mb-8 mt-3 pl-8 pr-8">
      <h3 class="font-weight-regular" v-if="!loading"><b>{{ edition.name }}</b> cierra en</h3>
      <Countdown v-if="!loading" :date="end" @onFinish="finish()"></Countdown>
    </v-col>

    <v-col cols="12" class="mb-1">
      <p class="subheading font-weight-regular">
        Lo primero que tenés que hacer es cargar tu idea, tu equipo
        <br>y luego enviarla para la evaluación
      </p>
    </v-col>
    <v-col cols="12" class="mb-1">
      <v-btn color="red" dark large to="/convocation">
        <v-icon>mdi-arrow-up-circle-outline</v-icon> 
        Cargar mi proyecto
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'

  import Countdown from "@/components/Countdown";

  export default {
    name: 'entrepreneurEmpty',
    components: {
      Countdown
    },
    data: () => ({
      loading:true,
      edition:[],
      time_left:null,
      end: null
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form'
      ])
    },
    methods:{
      finish() {
        console.log("finish");
      },
      
      async getEdition(){
        let edition_id = this.convocation_form.convocation_form.edition_id
        await axios.get('edition/'+edition_id).then(response =>{
          this.edition = response.data.edition

          let aux = this.edition.finish_date+'T'+this.edition.finish_time
          this.end = new Date(aux)

          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },
    },

    created(){
      this.getEdition()
    },
  }
</script>