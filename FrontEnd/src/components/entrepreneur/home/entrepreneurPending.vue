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


      <v-col cols="12" class="mb-1">
        <p class="subheading font-weight-regular">
          ¡Gracias por postularte!
          <br>Tu idea está siendo evaluada por el equipo de UNL Potencia.
          <br>En breve tendrás una respuesta.
        </p>
      </v-col>
    </v-row>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'

  export default {
    name: 'entrepreneurEmpty',
    data: () => ({
      
    }),

    computed: {
      ...mapGetters([
        'isLogged', 'drawer', 'user'
      ])
    },

    methods:{
      async getEdition(){
        await axios.get('editions').then(() =>{
          
        }).catch(error => {
          console.log(error);
        })
      },
    },

    created(){

    },
  }
</script>