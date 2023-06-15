<template>
  <v-row>
    <v-col 
      cols="12" xl="4" lg="4" md="6" sm="12" xs="12"
      class="pa-8"
      v-for="module in modules"
      v-bind:key="module.id">

      <v-card
        v-if="module.is_enabled"
        class="pa-1 d-flex flex-column"
        height="280px"
        min-height="100%"
        color="#0B869C"
        dark
        elevation-8
        hover
        width="100%">

        <v-card-title class="font-weight-light">
          #{{ module.order }}
        </v-card-title>

        <v-card-text>
          <h2 class="font-weight-light white--text">{{ module.name }}</h2>
        </v-card-text>

        <v-spacer></v-spacer>

        <v-card-actions>
          <v-btn
            color="white"
            dark
            depressed
            block
            outlined
            :disabled="!module.is_enabled"
            @click="showModule(module.slug)">
            Ver módulo
          </v-btn>
        </v-card-actions>
      </v-card>

      <v-card
        v-if="!module.is_enabled"
        class="pa-1 d-flex flex-column"
        height="280px"
        min-height="100%"
        color="#9ED5E1"
        dark
        elevation-8
        hover
        width="100%">
        
        <v-card-title class="font-weight-light">
          #{{ module.order }}
        </v-card-title>

        <v-card-text>
          <h2 class="font-weight-light white--text">{{ module.name }}</h2>
        </v-card-text>

        <v-spacer></v-spacer>

        <v-card-actions>
          <v-btn
            color="white"
            dark
            depressed
            block
            outlined
            :disabled="!module.is_enabled"
            @click="showModule(module.slug)">
            Ver módulo
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
  export default {
    name: 'modules',
    props:['modules'],
    methods: {
      showModule(slug) {
        this.$router.push({ name: 'pillsModule', params: { slug: slug } })
      }
    }
  }
</script>