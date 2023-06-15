<template>
  <v-card min-height="400">
    <v-row class="text-center">
      <v-col cols="12">
        <v-img
          :src="require('@/assets/img/page-not-found.jpg')"
          contain
          height="400"
        />
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
  export default {
    name: 'About',
  }
</script>