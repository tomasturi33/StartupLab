<template>
  <v-row>
    <v-col cols="12">
      <v-sheet
          width="100%"
          outlined 
        >
        <v-row class="ma-1">
          <v-col
            cols="12"
            xl="4"
            md="4"
            sm="12"
          >
            <v-text-field
              outlined
              v-model="name"

              :counter="50"
              label="Nombre completo"
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
              outlined
              v-model="lastname"

              :counter="50"
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
              outlined
              v-model="email"
              :counter="100"
              :rules="emailRules"
              label="Correo electrónico"
              required
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
          >
            <h3 class="body-1">Mis Roles:</h3>
          </v-col>

          <v-col
            cols="12"
          >
            <v-chip 
              v-for="role in user.roles"
              v-bind:key="role.id"
              class="ma-2"
              color="primary"
            >
              <label v-if="role.name==='admin'">
                Administrador
              </label>

              <label v-if="role.name==='entrepreneur'">
                Emprendedor
              </label>

              <label v-if="role.name==='evaluator'">
                Evluador
              </label>
            </v-chip>
          </v-col>


          <v-col cols="12">
            <v-switch
              v-model="change_password"
              label="Cambiar contraseña"
            ></v-switch>
          </v-col>

          <v-col
            cols="12"
            xl="6"
            md="6"
            sm="12"
          >
            <v-text-field
              outlined
              type="password"
              :disabled="!change_password"
              v-model="password"
              :counter="50"
              label="Contraseña"
              required
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
            xl="6"
            md="6"
            sm="12"
          >
            <v-text-field
              outlined
              type="password"
              :disabled="!change_password"
              v-model="confirm_password"
              :counter="50"
              label="Confirmar contraseña"
              required
            ></v-text-field>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-8 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'home'}"
        >
        Volver
      </v-btn>

      <v-btn
        depressed
        :loading="loading_update"
        color="primary"
        @click="updateProfile"
        >
        Guardar
      </v-btn>
    </v-col>

    <v-dialog
      v-model="loading"
      persistent
      width="300"
    >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          Cargando información...
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_error"
      width="600px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">Advertencia</span>
        </v-card-title>
        <v-card-text>
          <v-list-item>
            <v-list-item-content>

              <v-list-item-title
                v-for="error in errors" v-bind:key="error">
                  {{ error }}
              </v-list-item-title>

            </v-list-item-content>
          </v-list-item>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="primary darken-1"
            text
            @click="dialog_error = false"
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
    name: 'Profile',

    data: () => ({
      loading:true,
      loading_update:false,
      show:false,
      
      dialog_error: false,

      valid:null,

      name:'',
      lastname:'',
      nameRules: [
        v => !!v || 'Name is required',
        v => v.length <= 50 || 'Name must be less than 10 characters',
      ],

      email: '',
      emailRules: [
        v => !!v || 'Correo electrónico es requerido',
        v => /.+@.+/.test(v) || 'Correo electrónico debe ser valido',
      ],

      change_password: false,
      password:'',
      confirm_password:'',

      user:[],
      errors: []
    }),

    methods:{
      async getUser()
      {
        await axios.get('user').then(response =>{
          this.user = response.data.user

          this.name = response.data.user.name
          this.lastname = response.data.user.lastname
          this.email = response.data.user.email

          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error);
        })
      },

      async updateProfile()
      {
        this.loading_update = true
        this.errors=[]
        try {
          await axios.put('user/'+this.user.id,{
            name: this.name, 
            lastname: this.lastname,
            email: this.email,
            change_password: this.change_password,
            password: this.password,
            confirm_password: this.confirm_password
          }).then(() =>{
            this.$router.push({ name: 'CheckConvocations' })  
          })
        }catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")

          if( error.response.data.errors.length != 0){
            Object.values(error.response.data.errors).forEach(error => {
              this.errors.push(error[0])
            })
          }
          this.password = ''
          this.confirm_password = ''
          this.loading_update=false
          this.dialog_error = true
        }
      }
    },

    created(){
      this.getUser()
    },
  }
</script>
