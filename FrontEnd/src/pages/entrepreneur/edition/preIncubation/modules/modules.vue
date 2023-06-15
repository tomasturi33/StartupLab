<template>
  <v-row>
    <template :loading="loading">
      <v-col 
        cols="12" xl="4" lg="4" md="6" sm="12" xs="12"
        class="pa-8"
        v-for="mudule in modules"
        v-bind:key="mudule.id">

        <v-card
          class="pa-1 d-flex flex-column"
          height="280px"
          min-height="100%"
          color="#26c6da"
          dark
          elevation-8
          hover
          outlined
          width="100%">
          <v-card-title class="font-weight-light">
            #
          </v-card-title>

          <v-card-text>
            <h2 class="font-weight-light white--text">{{ mudule.name }}</h2>
          </v-card-text>

          <v-spacer></v-spacer>

          <v-card-actions>
            <v-btn
              color="white"
              dark
              depressed
              block
              outlined
              @click="goToModule(mudule.id)">
              Ver módulo
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </template>
  </v-row>
</template>
<script>
  export default {
    name: 'modules',
    props:['modules'],
  }
</script>
