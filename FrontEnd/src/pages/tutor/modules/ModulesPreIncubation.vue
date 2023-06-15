<template>
  <v-row>
    <v-col cols="12">
      <v-sheet 
        width="100%"
        outlined 
        min-height="400"
      >

        <v-row class="ma-4">
          <v-col 
            v-for="(module, id) in modules" :key="id"  
            cols="12" 
            xl="4" 
            lg="4" 
            md="6"
            sm="12" 
            xs="12"
          >

            <v-card
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
                  :to="{name: 'ModulePreIncubation', params: { slug: module.slug } }">
                  Ver módulo
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-dialog
      v-model="loading"
      overlay
      persistent
      width="300"
    >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          Cargando...
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  import axios from 'axios';
  import { mapGetters } from 'vuex'

  export default {
    name: 'preIncubation',
    data() {
      return {
        modules:null,
        loading: true,
        slug:''
      }
    },
    computed: {
      ...mapGetters([
        'convocation_form'
      ])
    },
    methods: {
      async getModules() {
        try {
          await axios.get('evaluator/modules').then(response => {
            this.modules = response.data.data.modules
            this.loading = false
          })
        } catch (error) {
          console.log(error);
        }
      }
    },
    created() {
      this.getModules()
    }
  }
</script>