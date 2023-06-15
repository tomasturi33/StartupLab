<template>
  <v-row>
    <v-col cols="12">
      <v-sheet 
        width="100%"
        outlined
      >
        <v-row>

          <v-col cols="12" xl="4" md="2" sm="12" class="pa-8">
            <v-btn 
              @click="newUser"
              color="primary">
              Nuevo Usuario
            </v-btn>
          </v-col>

          <v-col cols="12" xl="8" md="8" xs="12" class="ma-4">
            <v-tabs v-model="active_tab" class="d-flex justify-end">
              <v-tab key="0" @click="getUsers" >Todos</v-tab>
              <v-tab key="1" @click="getAdminUsers" >Administrador</v-tab>
              <v-tab key="2" @click="getEvaluatorUsers">Evaluador</v-tab>
              <v-tab key="3" @click="getTutorUsers">Tutor</v-tab>
            </v-tabs>
          </v-col>
            
          <v-col cols="12"> 
            <v-text-field
              class="ma-4"
              v-model="search"
              append-icon="mdi-magnify"
              label="Buscar"
              single-line
              hide-details
            ></v-text-field>  
          </v-col>

          <v-col cols="12"> 
            <v-data-table
              class="pt-8"
              :headers="headers"
              :items="users"
              :search="search"
              :custom-filter="customSearch"
              :items-per-page="30"
              :footer-props="{
                'items-per-page-options': [10, 20, 30, 40, 50, 100],
                'items-per-page-text':'Usuarios por página',
              }"
              mobile="true"
            >
              <template v-slot:item.user="{ item }">
                {{ item.lastname.toUpperCase()+', '+item.name }}
              </template>
              <template v-slot:item.actions="{ item }">
                <v-btn
                  class="mx-2"
                  fab
                  dark
                  x-small
                  color="primary"
                  @click="showUser(item.id)"
                >
                  <v-icon dark small>
                    mdi-eye
                  </v-icon>
                </v-btn>

                <v-btn
                  class="mx-2"
                  fab
                  dark
                  x-small
                  color="warning"
                  @click="editUser(item.id)"
                >
                  <v-icon small>
                    mdi-pencil
                  </v-icon>
                </v-btn>

                <v-btn
                  class="mx-2"
                  fab
                  dark
                  x-small
                  color="red"
                  @click="confirmDeleteUser(item.id)"
                >
                  <v-icon dark small>
                    mdi-close
                  </v-icon>
                </v-btn>
              </template>
            </v-data-table>
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
          <label>Cargando...</label>
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <!--Dialog show loading-->
    <v-dialog
      v-model="dialog"
      hide-overlay
      persistent
      width="300"
      >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          {{ message }}
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <!--Dialog show user-->
    <v-dialog
      v-model="dialog_user"
      max-width="600px"
      >
      <v-card>
        <v-card-title>
          <span class="text-h5">Usuario</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="6"
              >
                <label>Nombre:</label>
                <p>{{ name }}</p>
              </v-col>

              <v-col
                cols="6"
              >
                <label>Apellido:</label>
                <p>{{ lastname }}</p>
              </v-col>

              <v-col
                cols="12"
              >
                <label>Correo electrónico:</label>
                <p>{{ email }}</p>
              </v-col>


              <v-col
                cols="12"
              >
                <h4>Roles:</h4>  
              </v-col>

              <v-chip 
                v-if="admin_role"
                class="ma-2"
                color="primary"
              >
                Administrador
              </v-chip>

              <v-chip 
                v-if="evaluator_role"
                class="ma-2"
                color="primary"
              >
                Evaluador
              </v-chip>

              <v-chip 
                v-if="tutor_role"
                class="ma-2"
                color="primary"
              >
                Tutor
              </v-chip>

            </v-row>
          </v-container>

        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog_user = false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!--Dialog show new user-->
    <v-dialog
      v-model="dialog_new_user"
      max-width="600px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">Nuevo usuario</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
              >
                <v-text-field
                  v-model="name"
                  label="Nombre completo*"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
              >
                <v-text-field
                  v-model="lastname"
                  label="Apellido*"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
              >
                <v-text-field
                  v-model="email"
                  :rules="emailRules"
                  label="Correo electrónico*"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
              >
                <h4>Roles:</h4>  
              </v-col>
              <v-col
                cols="12"
                xl="4"
                md="4"
                sm="12"
              >
                <v-switch
                  v-model="admin_role"
                  label="Administrador"
                ></v-switch> 
              </v-col>
              
              <v-col
                cols="12"
                xl="4"
                md="4"
                sm="12"
              >
                <v-switch
                  v-model="evaluator_role"
                  label="Evaluador"
                ></v-switch>   
              </v-col>

              <v-col
                cols="12"
                xl="4"
                md="4"
                sm="12"
              >
                <v-switch
                  v-model="tutor_role"
                  label="Tutor"
                ></v-switch>   
              </v-col>

            </v-row>
          </v-container>
          <small>*Campos requeridos</small>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            :disabled="loading_update"
            @click="dialog_new_user = false"
          >
            Cerrar
          </v-btn>
          <v-btn
            color="blue"
            text
            :loading="loading_update"
            :disabled="!evaluator_role&&!admin_role&&!tutor_role"
            @click="createUser"
          >
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!--Dialog show edit user-->
    <v-dialog
      v-model="dialog_edit_user"
      max-width="600px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">Editar usuario</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
              >
                <v-text-field
                  v-model="name"
                  label="Nombre completo*"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
              >
                <v-text-field
                  v-model="lastname"
                  label="Apellido*"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
              >
                <v-text-field
                  v-model="email"
                  :rules="emailRules"
                  label="Correo electrónico*"
                  required
                ></v-text-field>
              </v-col>
              
              <v-col
                cols="12"
              >
                <h4>Roles:</h4>  
              </v-col>

              <v-col
                cols="12"
                md="4"
                sm="12">
                <v-switch
                  v-model="admin_role"
                  label="Administrador"
                ></v-switch> 
              </v-col>

              <v-col
                cols="12"
                md="4"
                sm="12">
                <v-switch
                  v-model="evaluator_role"
                  label="Evaluador"
                ></v-switch>   
              </v-col>

              <v-col
                cols="12"
                md="4"
                sm="12">
                <v-switch
                  v-model="tutor_role"
                  label="Tutor"
                ></v-switch>   
              </v-col>

            </v-row>
          </v-container>
          <small>*Campos requeridos</small>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            :disabled="loading_update"
            @click="dialog_edit_user = false"
          >
            Cerrar
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            :loading="loading_update"
            :disabled="!evaluator_role&&!admin_role&&!tutor_role"
            @click="updateUser"
          >
            Actualizar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
        v-model="dialog_delete_user"
        width="500"
      >
      <v-card>
        <v-card-title class="text-h5 lighten-2">
          Atención 
        </v-card-title>

        <v-card-text class="pt-4 pb-6">
          ¿Está seguro que desea borrar este usuario?
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_delete_user = false"
          >
            Cancelar
          </v-btn>
          <v-btn
            color="primary"
            text
            @click="deleteUser"
          >
            Borrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialog_error" width="500">
      <v-card>
        <v-card-title class="text-h5 lighten-2">
          Advertencia
        </v-card-title>

        <v-card-text class="pa-8">
          <label v-for="err in errors" v-bind:key="err">
            <p>- {{ err }}</p>
          </label>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
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
    name: 'Users',

    data: () => ({
      loading:true,
      loading_update:false,
      show:false,
      active_tab: 0,
      
      dialog:false,
      message:'',

      dialog_user:false,
      dialog_new_user:false,
      dialog_edit_user:false,
      dialog_delete_user:false,
      dialog_error:false,

      errors:[],
      error:false,

      delete_id:null,

      id: null,
      name:'',
      lastname:'',
      email:'',
      emailRules: [
        v => !!v || 'E-mail es requerido',
        v => /.+@.+\..+/.test(v) || 'E-mail debe ser valido',
      ],
      admin_role: false,
      evaluator_role: false,
      tutor_role:false,

      roles:[],
      users:[],
      admin_users:[],
      evaluator_users:[],

      search: '',
      headers: [
        {
          text: 'Usuario',
          align: 'start',
          filterable: false,
          value: 'user',
        },
        { 
          text: 'Correo Electrónico', 
          value: 'email' 
        },
        { 
          text: 'Acciones',
          align: 'center',
          filterable: false,
          value: 'actions',
        }
      ]
    }),

    methods:{
      customSearch (value, search, item) {
          return Object.values(item).some(v=>v&&v.toString().toLowerCase().includes(search))
      },
      
      async getRoles()
      {
        await axios.get('admin/roles').then(response =>{
          this.roles = response.data.roles
        }).catch(error => {
          console.log(error);
        })
      },

      async getUsers()
      {
        this.loading=true
        await axios.get('admin/users').then(response =>{
          this.users = response.data.users
          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error);
        })
      },

      async getAdminUsers()
      {
        this.loading=true
        await axios.get('admin/admin-users').then(response =>{
          this.users = response.data.users
          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error);
        })
      },

      async getEvaluatorUsers()
      {
        this.loading=true
        await axios.get('admin/evaluator-users').then(response =>{
          this.users = response.data.users
          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error);
        })
      },

      async getTutorUsers()
      {
        this.loading=true
        await axios.get('admin/tutor-users').then(response =>{
          this.users = response.data.users
          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error);
        })
      },

      newUser(){
        this.name = ''
        this.lastname = ''
        this.email = ''
        this.admin_role = false
        this.evaluator_role = false
        this.tutor_role = false
        this.dialog_new_user = true
      },

      async createUser()
      {
        this.message = 'Agregando usuario...'
        this.loading_update = true 
        
        try {
          await axios.post('admin/users',{
            name: this.name,
            lastname: this.lastname,
            email: this.email,
            admin_role: this.admin_role,
            evaluator_role: this.evaluator_role,
            tutor_role: this.tutor_role
          }).then(() =>{
            this.getUsers()
            this.active_tab=0
            this.message = ''
            this.loading_update = false
            this.dialog_new_user = false
          })
        } catch (error) {
          console.log(error)
          this.errors=[]
          if( error.response.data.errors.length != 0){
            Object.values(error.response.data.errors).forEach(error => {
              this.errors.push(error[0])
            })
          }
          this.message = ''
          this.loading_update = false

          this.loading=false
          this.dialog_upload=false
          this.dialog_error = true
        }
      },

      async editUser(id)
      {
        this.message = 'Obteniendo usuario...'
        this.dialog = true 
        
        try {
          await axios.get('admin/users/'+id).then((response) =>{
            this.id = response.data.user.id
            this.name = response.data.user.name
            this.lastname = response.data.user.lastname
            this.email = response.data.user.email
            this.admin_role = response.data.user.admin_role
            this.evaluator_role = response.data.user.evaluator_role   
            this.tutor_role = response.data.user.tutor_role

            this.roles = response.data.user.roles

            this.message = ''
            this.dialog = false
            this.dialog_edit_user = true
            })
        } catch (error) {
          console.log(error.response.data);
          this.message = ''
          this.dialog = false
        }
      },

      async updateUser()
      {
        this.message = 'Actualizando usuario...'
        this.loading_update = true 
        
        try {
          await axios.put('admin/users/'+this.id,{
            name: this.name,
            lastname: this.lastname,
            email: this.email,
            admin_role: this.admin_role,
            evaluator_role: this.evaluator_role,
            tutor_role: this.tutor_role
          }).then(() =>{
            if(this.active_tab==0){
              this.getUsers()
            }
            if(this.active_tab==1){
              this.getAdminUsers()
            }
            if(this.active_tab==2){
              this.getEvaluatorUsers()
            }
            if(this.active_tab==3){
              this.getTutorUsers()
            }
            this.message = ''
            this.loading_update = false
            this.dialog_edit_user = false
          })
        } catch (error) {
          console.log(error.response.data);
          this.message = ''
          this.loading_update = false
        }
      },

      async showUser(id)
      {
        this.message = 'Obteniendo usuario...'
        this.dialog = true 
        
        try {
          await axios.get('admin/users/'+id).then((response) =>{
            this.id = response.data.user.id
            this.name = response.data.user.name
            this.lastname = response.data.user.lastname
            this.email = response.data.user.email
            this.admin_role = response.data.user.admin_role
            this.evaluator_role = response.data.user.evaluator_role   
            this.tutor_role = response.data.user.tutor_role

            this.message = ''
            this.dialog = false
            this.dialog_user = true
            })
        } catch (error) {
          console.log(error.response.data);
          this.message = ''
          this.dialog = false
        }
      },

      confirmDeleteUser(id){
        this.dialog_delete_user = true
        this.delete_id = id
      },

      async deleteUser(){
        this.dialog_delete_user = false
        try {
          this.message = 'Eliminando usuario...'
          this.dialog = true
          await axios.delete('admin/users/'+this.delete_id).then(() =>{
            if(this.active_tab==0){
            this.getUsers()
          }
          if(this.active_tab==1){
            this.getAdminUsers()
          }
          if(this.active_tab==2){
            this.getEvaluatorUsers()
          }
          if(this.active_tab==3){
            this.getTutorUsers()
          }
            this.message = ''
            this.dialog = false
          })
        } catch (error) {
          console.error(error.response.data);
          this.message = ''
          this.dialog = false
        }
      }
    },

    created(){
      this.getUsers()
      this.getRoles()
    },
  }
</script>
