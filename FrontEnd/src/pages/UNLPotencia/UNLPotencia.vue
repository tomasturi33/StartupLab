<template>
  <v-main class="m-0" :class="{ 'pa-0': $vuetify.breakpoint.smAndUp }">
    <v-app-bar class="color-app-bar" app dark>
      <v-toolbar-title> 
        <b><b>UNL</b></b>Potencia
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn
        class="ma-2"
        outlined
        color="white"
        small
        to="/login"
      >
        Iniciar Sesión
      </v-btn>
    </v-app-bar>

    <v-img
      class="pt-1 image-landing"
      :src="require('@/assets/img/img_portada.png')"
      min-height="100vh"
    ></v-img>

    <div class="centered">
      <vue-typed-js 
        :strings="['UNLPotencia','Acompañamos tu startup y aceleramos su crecimiento']" 
        :loop="true"
        :contentType="'html'"
        :fadeOutDelay="500"
        :backDelay="900"
        :backSpeed="75"
        :showCursor="false">
        <h2 style="color: white;font-size:48px; font-weight: 300;" class="titulo typing"></h2>

      </vue-typed-js>
    </div>

    <v-main>
      <v-row>
        <v-col 
          cols="12" 
          class="pa-8 mt-8 mb-8"
          v-for="convocation in convocations"
          v-bind:key="convocation.id">
          <v-hover>
            <template v-slot:default="{ hover }">
              <v-card
                :class="`elevation-${hover ? 14 : 1}`"
                class="mx-auto edition-card box-shadow"
                width="440"
              >
                <v-card-text>
                  <p class="text-h4 text--primary">
                    {{ convocation.name }}
                  </p>
                  <div class="text--primary">
                    {{ convocation.description }}
                  </div>
                </v-card-text>
                <v-card-actions align="right">
                  <v-btn
                    block
                    x-large
                    color="primary"
                    @click="reveal = true"
                    :to="{name: 'register', params:{slug:convocation.slug}}" 
                  >
                    Postular mi idea
                  </v-btn>
                </v-card-actions>
              </v-card>

            </template>
          </v-hover>
        </v-col>
        
      </v-row>
    </v-main>


  </v-main>
</template>

<script>
import axios from 'axios'
import { VueTypedJs } from 'vue-typed-js' 

export default {
  name: 'UNLPotencia',
  components: {
        VueTypedJs
  },
  data: () => ({
    loading:false,
    convocations:[]
  }),

  methods: {
    async getConvocations(){
      await axios.get('index').then(response =>{
        this.convocations = response.data.convocations
        this.loading=false
      }).catch(error => {
        console.log(error)
      })
    }

  },
  created(){
    this.getConvocations()
  }
};
</script>
<style scoped>
.centered {
  position: absolute;
  top: 45vh;
  left: 50%;
  transform: translate(-50%, -50%);
}

.image-landing{
  left: 50%;
  right: 50%;
	margin-left: -50vw;
	margin-right: -50vw;
	max-width: 100vw;
  max-height: 100vh;
	position: relative;
	width: 100vw;
  border-bottom: 5px solid #00a1b8;
}

.edition-card{
  transition: transform .2s, box-shadow .3s;/* Animation */
}

.edition-card:hover{
  transform: scale(1.01);
  box-shadow: 0 0 11px rgba(33,33,33,.2); 
}

</style>