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
              ref="module.name"
              v-model="name"
              outlined
              label="Ediciòn"
              required
            ></v-text-field>
            
            <v-textarea
              outlined
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1499 || 'La descripción no debe tener mas de 1500 caracteres']"
              ref="description"
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
              v-model="activity_statement"
              :disabled="!require_activity"
              name="activity_statement"
              label="Enunciado"
            ></v-textarea>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2 d-flex justify-space-between">
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
        depressed
        :loading="loading_update"
        color="primary"
        @click="updateModule"
        >
        Actualizar
      </v-btn>
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
          <label>Cargando...</label>
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

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
      loading:true,
      loading_update:false,
      error:false,
      errors:[],

      id:null,
      id_module:null,
      module:null,
      name:null,
      description:null,
      require_activity:null,
      activity_statement:null
    }),

    methods:{
      async getModule(){
        await axios.get('admin/modules/'+this.id_module).then(response =>{
          this.module = response.data.module
          this.name= response.data.module.name
          this.description= response.data.module.description
          this.require_activity = (response.data.module.require_activity==1)?true:false
          this.activity_statement = response.data.module.activity_statement
          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      async updateModule(){
        this.loading_update=true
        this.error = false
        this.errors = []

        try {
          await axios.put('admin/modules/'+this.id_module, {
              edition_id: this.edition_id, 
              name: this.name, 
              description: this.description,
              require_activity: this.require_activity,
              activity_statement: this.activity_statement
            }).then(()=>{
              this.$router.push({ name: 'modules', params: { id: this.edition_id } }) 
            })
        } catch (error) {
          this.loading_update = false
          Object.values(error.response.data.errors).forEach(error => {
            this.errors.push(error[0])
          })
        }

        if(this.errors.length!=0){
          this.loading_update=false
          this.error=true
        }
      },

      previousPage(){
        this.$router.push({ name: 'modules', params: { id: this.id } })
      }
    },

    created(){
      this.id = this.$route.params.id;
      this.id_module = this.$route.params.id_module;
      this.getModule();
    },
  }
</script>