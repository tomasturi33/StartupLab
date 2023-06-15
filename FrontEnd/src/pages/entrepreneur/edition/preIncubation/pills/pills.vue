<template>
  <v-row>
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
        <contentModule :module="module" :pills="pills" />
      </v-sheet>

      <v-sheet 
        class="mt-8" 
        v-if="(value===2)"
        outlined
        min-height="240">
        <taskModule :module="module" :convocation_form_id="convocation_form.convocation_form.id" :is_enabled="is_enabled" />
      </v-sheet>
    </v-col>
  
    <v-col cols="12" class="pt-2 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'preIncubationEntrepreneurship'}"
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

  import infoModule from '@/components/entrepreneur/pill/infoModule.vue'
  import contentModule from '@/components/entrepreneur/pill/contentModule.vue'
  import taskModule from '@/components/entrepreneur/pill/taskModule.vue'

  export default {
    name: 'pillsModule',
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
      ...mapGetters([
        'convocation_form', 'user'
      ]),
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
      async getPillsModule() {
        try {
          await axios.get('modules-pre-incubation/module/'+this.slug+'/'+this.convocation_form.convocation_form.id ).then(response => {
            this.data = response.data.data
            this.is_enabled = response.data.data.is_enabled
            this.module = response.data.data.module
            this.pills = response.data.data.module.pills
            this.loading = false

            this.cheackViewModule()
          })
        } catch (error) {
          console.log(error);
        }
      },

      async cheackViewModule(){
        if(!this.module.require_activity){
          axios.post('entrepreneurship-tasks/view_module', {
            module_pre_incubation_id: this.module.id,
            convocation_form_id:this.convocation_form.convocation_form.id
          })
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          })
        }
      }
    },
    created() {
      this.slug = this.$route.params.slug;
      this.getPillsModule()
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