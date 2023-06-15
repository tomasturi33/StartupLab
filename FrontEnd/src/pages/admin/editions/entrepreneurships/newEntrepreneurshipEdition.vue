<template>
  <v-row>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Información del Emprendimiento:</h3>
          </v-col>

          <v-col
            cols="12"
          >
            <v-text-field
              :maxlength="200"
              :counter="200"
              :rules="[v => (v || '' ).length <= 199 || 'El nombre de la edición no debe tener mas de 200 caracteres']"
              v-model="title"
              outlined
              label="Título de la idea"
              required
            ></v-text-field>
            
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Información del responsable del Emprendimiento:</h3>
          </v-col>

          <v-col
            cols="12"
            xl="4"
            md="4"
            sm="12"
          >
            <v-text-field
              :maxlength="50"
              :counter="50"
              :rules="[v => (v || '' ).length <= 199 || 'El nombre de la edición no debe tener mas de 200 caracteres']"
              v-model="name"
              outlined
              label="Nombre"
              required
            ></v-text-field>
            
          </v-col>

          <v-col
            cols="12"
            xl="4"
            md="4"
            sm="12"
          >
            <v-text-field
              :maxlength="50"
              :counter="50"
              :rules="[v => (v || '' ).length <= 199 || 'El nombre de la edición no debe tener mas de 200 caracteres']"
              v-model="lastname"
              outlined
              label="Apellido"
              required
            ></v-text-field>
            
          </v-col>

          <v-col
            cols="12"
            xl="4"
            md="4"
            sm="12"
          >
            <v-text-field
              :maxlength="50"
              :counter="50"
              :rules="[v => (v || '' ).length <= 199 || 'El nombre de la edición no debe tener mas de 200 caracteres']"
              v-model="email"
              outlined
              label="Correo eletrónico"
              required
            ></v-text-field>
            
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>
  
    <v-col cols="12" class="d-sm-flex pt-8">
      <v-btn
        depressed
        class="mr-auto mt-2"
        color="primary"
        :block="$vuetify.breakpoint.xsOnly"
        :to="{ name: 'entrepreneurshipsEdition', params: { id: this.edition_id }}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>


      <v-btn
        :loading="loading"
        depressed
        class="mt-2"
        color="primary"
        :block="$vuetify.breakpoint.xsOnly"
        @click="confirm_dialog=true"
        >
        Agregar
      </v-btn>
    </v-col>

    <v-dialog
      v-model="confirm_dialog"
      persistent
      max-width="490"
    >
      <v-card>
        <v-card-title class="text-h5">
          Advertencia
        </v-card-title>
        <v-card-text>

          <p>
            Se enviara un correo eletrónico al responsable del emprendimiento con
            un link a un formulario de la Idea Proyecto. Una vez completado y enviado
            todo el formulario, la Idea Proyecto aparecera como PENDIENTE para que 
            sea evaluada y aceptada por el administrador
          </p>

        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary darken-1"
            text
            @click="confirm_dialog = false"
          >
            Cerrar
          </v-btn>

          <v-btn
            color="primary darken-1"
            text
            @click="createInvitation()"
          >
            Enviar
          </v-btn>

        </v-card-actions>
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
          <v-list-item 
            v-for="e in errors" 
            v-bind:key="e">
            - {{ e }}
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
          <label>Enviando notificación...</label>
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
  import axios from 'axios'

  export default {
    name: 'newEntrepreneurshipEdition',

    data: () => ({
      loading:false,
      snackbar:false,
      edition_id:null,
      module:null,

      error:false,
      errors:[],

      title:'',
      name:'',
      lastname:'',
      email:'',

      confirm_dialog:false,

      text:'',
    }),

    methods:{
      async createInvitation()
      {
        this.error = false
        this.errors = []
        this.loading = true
        this.confirm_dialog= false
        try {
          await axios.post('admin/edition/'+this.edition_id+'/entrepreneurships/add-entrepreneurship-edition',{
              edition_id: this.edition_id, 
              name: this.name, 
              lastname: this.lastname,
              email: this.email,
              title: this.title
            }).then(()=>{
              this.$router.push({ name: 'entrepreneurshipsEdition', params: { id: this.edition_id } }) 
            }).catch(error=>{
              this.loading = false
              console.log(error)
              Object.values(error.response.data.errors).forEach(error => {
                this.errors.push(error[0])
              })
            })
        } catch (error) {
          this.loading = false
          //console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
          Object.values(error.response.data.errors).forEach(error => {
            this.errors.push(error)
          })
        }

        if(this.errors.length!=0){
          this.loading=false
          this.error=true
        }
      },

      previousPage(){
        this.$router.push({ name: 'entrepreneurshipsEdition', params: { id: this.edition_id } })
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
    },
  }
</script>