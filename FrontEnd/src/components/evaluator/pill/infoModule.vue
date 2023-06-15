<template>
  <v-row>
    <v-col cols="12" class="pa-8">
      <h2 class="font-weight-light">{{ module.name }}</h2>
      <v-divider></v-divider>
      <p class="text-pre-wrap font-weight-light pt-3">{{ module.description }}</p>
    </v-col>
  </v-row>
</template>
<script>
  export default {
    name: 'infoModule',
    props:['module']
  }
</script>