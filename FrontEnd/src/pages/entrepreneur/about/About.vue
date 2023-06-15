<template>
  <v-sheet
    outlined
    width="100%">
    <v-row class="pa-6">
      <v-col cols="12">
        <h3 class="pb-4">Acerca de UNL Potencia:</h3>  

        <p>
          UNL Potencia es un programa de la Secretaría de Vinculación Tecnológica e Innovación de la UNL que busca el 
          desarrollo ágil de startups y tiene como objetivo lograr el match entre emprendedores e inversores para fortalecer 
          el ecosistema de innovación. Para lograrlo, se ponen a disposición procesos, herramientas y conocimientos para diseñar, 
          analizar y validar ideas de negocio, creando proyectos sólidos con potencial de crecimiento y obtención de inversión. 
          
          Durante el programa, se evalúa y valida el modelo de negocio, se brindan capacitaciones orientadas a la creación de la 
          empresa y se ayuda a buscar financiamiento para ponerla en marcha.
        </p> 

        <p>
          UNL Potencia consiste en un proceso basado en tres etapas: pre incubación, incubación dinámica y pre aceleración. 
          Para conocer más acerca, podés ingresar en <a href="https://www.unl.edu.ar/vinculacion/potencia/" target="_blak">www.unl.edu.ar/vinculacion/potencia/</a> 
        </p>

      </v-col>
    </v-row>
  </v-sheet>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'About',

    data: () => ({
      
    }),

    methods:{
      async getEditions(){
        await axios.get('editions').then(response =>{
          console.log(response.data)
        }).catch(error => {
          console.log(error);
        })
      },
    },

    created(){
      //this.getEditions()
    },
  }
</script>