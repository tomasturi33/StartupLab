<template>
  <v-row>
    <v-col cols="12" class="pa-8">
      <h2 class="font-weight-light">Actividad</h2>
      <v-divider></v-divider>
      <v-row v-if="module.activity_statement">
        <v-col cols="12">
          <p class="text-pre-wrap font-weight-light pt-3">{{ module.activity_statement }}</p>
        </v-col>
      </v-row>

      <v-row class="pt-2 pb-8" v-if="!module.activity_statement">
        <v-col cols="12" class="text-center pt-8">
          <v-icon
            x-large
          >
            mdi-timer-sand-empty
          </v-icon>
          
          <h1 class="font-weight-light pt-8 pb-8">
            El administrador aún no subió la actividad de este módulo.
          </h1>
        </v-col>
      </v-row>
      
    </v-col>
  </v-row>
</template>
<script>
  export default {
    name: 'taskModule',
    props:['module']
  }
</script>