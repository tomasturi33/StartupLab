<template>
  <v-row>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Información del módulo:</h3>
          </v-col>

          <v-col
            cols="12"
          >
            <v-text-field
              :maxlength="200"
              :counter="200"
              :rules="[v => (v || '' ).length <= 199 || 'El nombre de la edición no debe tener mas de 200 caracteres']"
              v-model="name"
              outlined
              label="Módulo"
              required
            ></v-text-field>
            
            <v-textarea
              outlined
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1499 || 'La descripción no debe tener mas de 1500 caracteres']"
              v-model="description"
              name="description"
              label="Descripción"
            ></v-textarea>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Enunciado de la actividad:</h3>
            <v-switch
              v-model="require_activity"
              label="Actividad"
              >
            </v-switch>
            
          </v-col>

          <v-col
            cols="12"
          > 
            <v-textarea
              outlined
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1499 || 'El enunciado no debe tener mas de 1500 caracteres']"
              ref="edition.activity_statement"
              v-model="activity_statement"
              :disabled="!require_activity"
              name="activity_statement"
              label="Enunciado"
            ></v-textarea>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>


    <v-col cols="12" class="pt-8 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        @click="previousPage"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>

      <v-btn
        :loading="loading"
        depressed
        color="primary"
        @click="createModule"
        >
        Guardar
      </v-btn>
    </v-col>

    <v-dialog
      v-model="error"
      persistent
      max-width="490"
    >
      <v-card>
        <v-card-title class="text-h5">
          Advertencia
        </v-card-title>
        <v-card-text>
    
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title 
                v-for="error in errors" 
                v-bind:key="error"
                class="pa-2">
                - {{ error }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>

        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary darken-1"
            text
            @click="error = false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-row>
</template>
<script>
  import axios from 'axios'

  export default {
    name: 'preIncibation',

    data: () => ({
      loading:false,
      edition_id:null,
      module:null,

      error:false,
      errors:[],

      name:'',
      description:'',
      require_activity:false,
      activity_statement:''
    }),

    methods:{
      async createModule()
      {
        this.error = false
        this.errors = []
        this.loading = true
        try {
          await axios.post('admin/modules',{
              edition_id: this.edition_id, 
              name: this.name, 
              description: this.description,
              require_activity: this.require_activity,
              activity_statement: this.activity_statement
            }).then(()=>{
              this.$router.push({ name: 'modules', params: { id: this.edition_id } }) 
            })
        } catch (error) {
          this.loading = false
          //console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
          Object.values(error.response.data.errors).forEach(error => {
            this.errors.push(error[0])
          })
        }

        if(this.errors.length!=0){
          this.loading=false
          this.error=true
        }
      },

      previousPage(){
        this.$router.push({ name: 'modules', params: { id: this.edition_id } })
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
    },
  }
</script>