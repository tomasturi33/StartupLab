<template>
  <v-row>
    <v-col cols="12">
      <v-sheet 
        width="100%"
        outlined 
        min-height="400">
        <v-row>
          <v-col cols="12" class="pa-8">

            <v-progress-linear
              :value="progress"
              height="32"
              rounded
            >
              <strong 
                class="white--text font-weight-light"
                style="text-shadow: 2px 1px 5px black;">Progreso {{ progress }}%
              </strong>
            
            </v-progress-linear>

            <v-divider></v-divider>
            
          </v-col>
        </v-row>

        <modules :modules="modules"></modules>

      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'home'}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>
      <v-spacer />
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
  import modules from '@/components/entrepreneur/modules/modules';

  export default {
    name: 'preIncubation',
    components: {
      modules,
    },
    data() {
      return {
        modules:[],
        data:[],
        loading: true,
        progress:0,
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
          await axios.get('modules-pre-incubation/'+this.convocation_form.convocation_form.id).then(response => {
            this.modules = response.data.data.modules
            this.data = response.data
            this.progress = response.data.data.progress
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