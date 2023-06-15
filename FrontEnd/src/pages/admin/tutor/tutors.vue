<template>
  <v-row>
    <v-col cols="12"> 
      <v-sheet 
        width="100%"
        outlined
      >
        <v-row>        
          <v-col cols="12">
            <v-row>
              <v-col cols="12" class="pa-8"> 
                <v-text-field
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
                  :items="tutors"
                  :search="search"
                  :custom-filter="customSearch"
                  :items-per-page="30"
                  :footer-props="{
                    'items-per-page-options': [10, 20, 30, 40, 50, 100],
                    'items-per-page-text':'Evaluadores por página',
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
                      @click="showTutor(item.id)"
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
                      color="success"
                      @click="moduleAssigned(item.id)"
                    >
                      <v-icon dark small>
                        mdi-view-module-outline
                      </v-icon>
                    </v-btn>
                  </template>
                </v-data-table>
              </v-col>
            </v-row>

          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <!--Dialog show evaluators-->
    <v-dialog
      v-model="dialog_tutor"
      max-width="750px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">Tutor</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row> 
              <v-col cols="12">
                <label class="font-weight-bold text-uppercase">Apellido y Nombre:</label><br>
                <label class="pt-4">{{ lastname.toUpperCase() + ', ' + name }}</label>
              </v-col>


              <v-col
                cols="12"
              >
                <label class="font-weight-bold text-uppercase">Emprendimientos asignados:</label>


                <v-simple-table striped>
                    <tbody>
                      <tr
                        v-for="item in entrepreneurship_assigned_to_tutor"
                        :key="item"
                      >
                        <td>{{ item.entrepreneurship.title }}</td>
                      </tr>
                    </tbody>
                </v-simple-table>
              </v-col>

            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog_tutor = false"
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
          <label>Cargando...</label>
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
    name: 'Evaluators',

    data: () => ({
      loading:true,
      dialog_tutor:false,

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

      roles:[],

      tutor:[],
      tutors:[],

      entrepreneurship_assigned_to_tutor:[],
      
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
        },
      ],
    }),

    methods:{
      customSearch (value, search, item) {
          return Object.values(item).some(v=>v&&v.toString().toLowerCase().includes(search))
      },

      async getTutors()
      {
        await axios.get('admin/tutors').then(response =>{
          this.tutors = response.data.data
          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error);
        })
      },

      async showTutor(id)
      {
        this.loading = true 
        try {
          await axios.get('admin/tutors/'+id).then((response) =>{
            this.tutor = response.data.data

            this.entrepreneurship_assigned_to_tutor  = response.data.data.tutor.entrepreneurship_assigned_to_tutor 
            this.id = response.data.data.tutor.id
            this.name = response.data.data.tutor.name
            this.lastname = response.data.data.tutor.lastname
            this.email = response.data.data.tutor.email
            this.admin_role = response.data.data.tutor.admin_role
            this.tutor_role = response.data.data.tutor.evaluator_role   

            this.message = ''
            this.loading = false
            this.dialog_tutor = true
            })
        } catch (error) {
          console.log(error.response.data);
          this.message = ''
          this.loading = false
        }
      },

      moduleAssigned(tutor_id)
      {
        this.$router.push({ name: 'entrepreneurshipsAssignedTutors', params: { tutor_id: tutor_id } })  
      }
    },

    created(){
      this.getTutors()
    },
  }
</script>
