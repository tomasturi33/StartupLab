<template>
  <v-row>
    <template v-if="!loading">
      <v-col cols="12">
        <v-bottom-navigation
          style="border-radius: 4px;"
          v-model="value"
          :background-color="color"
          dark
          shift
        >
          <v-btn>
            <span>Módulo</span>

            <v-icon>mdi-information</v-icon>
          </v-btn>

          <v-btn>
            <span>Pildoras</span>

            <v-icon>mdi-pill-multiple</v-icon>
          </v-btn>

          <v-btn v-if="module.require_activity">
            <span>Actividad</span>

            <v-icon>mdi-file-upload</v-icon>
          </v-btn>
        </v-bottom-navigation>
      </v-col>

      <v-col cols="12">
        <v-sheet 
          class="mt-8" 
          v-if="(value===0)"
          outlined
          min-height="240">
          <infoModule :module="module" />
        </v-sheet>

        <v-sheet 
          class="mt-8" 
          v-if="(value===1)"
          outlined
          min-height="240">
          <contentModule :module="module" :pills="module.pills" />
        </v-sheet>

        <v-sheet 
          class="mt-8" 
          v-if="(value===2)"
          outlined
          min-height="240">
          <taskModule :module="module"/>
        </v-sheet>
      </v-col>
    </template>
  
    <v-col cols="12" class="pt-2 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'ModulesPreIncubation'}"
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

  import infoModule from '@/components/evaluator/pill/infoModule.vue'
  import contentModule from '@/components/evaluator/pill/contentModule.vue'
  import taskModule from '@/components/evaluator/pill/taskModule.vue'

  export default {
    name: 'ModulePreIncubation',
    components: {
      infoModule, contentModule, taskModule
    },
    data() {
      return {
        value: 0,
        slug:null,
        module:[],
        is_enabled:false,
        loading: true,

        data: [],

        pills:[],
      }
    },
    computed: {
      color () {
        switch (this.value) {
          case 0: return '#00A1B8'
          case 1: return '#11778C'
          case 2: return '#23495C'
          default: return '#00A1B8'
        }
      }
    },
    methods: {
      async getModule() {
        try {
          await axios.get('evaluator/modules/'+this.slug ).then(response => {
            this.data = response.data
            this.module = response.data.data.module
            this.pills = response.data.data.module.pills
            this.loading = false
          })
        } catch (error) {
          console.log(error);
        }
      }
    },
    created() {
      this.slug = this.$route.params.slug;
      this.getModule()
    }
  }
</script>
<style scoped>
.video {
  max-height:420px; 
  width: auto;
  aspect-ratio: 16 / 9;
}
</style>