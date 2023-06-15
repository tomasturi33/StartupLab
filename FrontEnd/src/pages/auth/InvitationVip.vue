<template>
  <v-main :class="{ 'pa-2': $vuetify.breakpoint.smAndUp }" :dark="darkTheme" id="inspire">
    <v-container>
      <v-layout wrap>

        <v-flex sm12 md8 offset-md2>
          <v-layout align-center justify-space-between>
            <v-sheet outlined>
              <v-card-title>
                <v-layout>
                  <v-row>
                    <v-col cols="6">
                      <h3 class="headline">
                        {{ platformName }}
                      </h3>
                    </v-col>
                    <v-col cols="6">
                      <v-img 
                      :alt="platformName" 
                      class="mr-3" 
                      contain 
                      height="38px" 
                      position="center right" 
                      :src="require('@/assets/icons/unl.png')">
                    </v-img>
                    </v-col>
                  </v-row>
                </v-layout>
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text>
                <p>Complete el siguiente formulario para registrarse en la plataforma:</p>
                <v-form>
                  <v-row>

                    <v-col cols="12">
                      <h2 class="font-weight-light">Datos de la Idea</h2>
                    </v-col>

                    <v-col cols="12">
                      <v-text-field
                        :maxlength="200"
                        :counter="200"
                        :rules="[v => (v || '' ).length <= 199 || 'El nombre de la idea no debe tener mas de 200 caracteres']"
                        ref="title"
                        outlined
                        v-model="title"
                        label="Titúlo idea*"
                        required
                      ></v-text-field>
                      
                      <v-textarea
                        :maxlength="300"
                        :counter="300"
                        :rules="[v => (v || '' ).length <= 299 || 'El resumen ejecutivo no debe tener mas de 200 caracteres']"
                        outlined
                        ref="executive_summary"
                        name="executive_summary"
                        v-model="executive_summary"
                        label="Resumen ejecutivo*"
                      ></v-textarea>

                      <v-textarea
                        :maxlength="1500"
                        :counter="1500"
                        :rules="[v => (v || '' ).length <= 1499 || 'El problema detectado no debe tener mas de 1500 caracteres']"
                        outlined
                        ref="problem_detected"
                        name="problem_detected"
                        v-model="problem_detected"
                        label="Problema detectado*"
                      ></v-textarea>

                      <v-textarea
                        :maxlength="1500"
                        :counter="1500"
                        :rules="[v => (v || '' ).length <= 1499 || 'La solición propuesta no debe tener mas de 1500 caracteres']"
                        outlined
                        ref="proposed_solution"
                        name="proposed_solution"
                        v-model="proposed_solution"
                        label="Solución propuesta*"
                      ></v-textarea>

                      <v-textarea
                        :maxlength="1500"
                        :counter="1500"
                        :rules="[v => (v || '' ).length <= 1499 || 'El servicio o producto que ofrece no debe tener mas de 1500 caracteres']"
                        outlined
                        ref="products_services_you_offer"
                        name="products_services_you_offer"
                        v-model="products_services_you_offer"
                        label="Producto o servicio que ofrecen*"
                      ></v-textarea>

                      <v-textarea
                        :maxlength="2000"
                        :counter="2000"
                        :rules="[v => (v || '' ).length <= 1999 || 'El mercado no debe tener mas de 2000 caracteres']"
                        outlined
                        ref="market"
                        name="market"
                        v-model="market"
                        label="Mercado*"
                      ></v-textarea>

                      <v-textarea
                        :maxlength="1500"
                        :counter="1500"
                        :rules="[v => (v || '' ).length <= 1499 || 'El mercado no debe tener mas de 1500 caracteres']"
                        outlined
                        ref="entrepreneurial_team"
                        name="entrepreneurial_team"
                        v-model="entrepreneurial_team"
                        label="Equipo emprendedor (integrantes, roles, aportes)*"
                      ></v-textarea>

                      <v-textarea
                        outlined
                        :maxlength="1500"
                        :counter="1500"
                        :rules="[v => (v || '' ).length <= 1499 || 'El plan de acción no debe tener mas de 1500 caracteres']"
                        ref="action_plan"
                        name="action_plan"
                        v-model="action_plan"
                        label="Plan de acción*"
                      ></v-textarea>
                    </v-col>

                    <v-col cols="12">
                      <v-select
                        :items="vertical_works"
                        v-model="vertical_works_id"
                        item-text="name"
                        item-value="id"
                        label="Vertical de trabajo*"
                        outlined
                      ></v-select>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-select
                        :items="entrepreneurship_stadium"
                        v-model="entrepreneurship_stadia_id"
                        item-text="name"
                        item-value="id"
                        label="Estadio de la StartUp*"
                        outlined
                      ></v-select>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-select
                        :items="development_degree"
                        v-model="development_degrees_id"
                        :disabled="entrepreneurship_stadia_id==1||entrepreneurship_stadia_id==null"
                        item-text="name"
                        item-value="id"
                        label="Grado de desarrollo actual*"
                        outlined
                      ></v-select>
                    </v-col>

                    <v-col
                      cols="12"
                    >
                      <v-select
                        v-model="entrepreneurship_needs"
                        :items="needs"
                        :menu-props="{ maxHeight: '400' }"
                        label="¿Qué busca de la convocatoria?"
                        item-text="name"
                        item-value="id"
                        multiple
                        outlined
                      ></v-select>
                    </v-col>

                    <v-col
                      cols="12">
                      <v-text-field
                        :maxlength="200"
                        :counter="200"
                        :rules="[v => (v || '' ).length <= 199 || 'El nombre de la idea no debe tener mas de 200 caracteres']"
                        ref="title"
                        outlined
                        v-model="video"
                        label="Si tienes un video en alguna plataforma tipo YouTube, pega el link aquí"
                        required
                      ></v-text-field>          
                    </v-col>

                    <v-col cols="12">
                      <h2 class="font-weight-light">Currículum de la StartUp </h2>
                      <label class="text--secondary"> Contanos los avances y logros de la startup agregándolos aquí</label>
                    </v-col>

                    <v-col cols="12">
                      <v-simple-table>
                        <thead>
                          <tr>
                            <th class="text-left" width="20%">
                              Tipo
                            </th>
                            <th class="text-left" width="60%">
                              Name
                            </th>
                            <th class="text-center">
                              Acciones
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(item, index) in curriculum_idea"
                            :key="index"
                          >
                            <td>{{ item.type }}</td>
                            <td>{{ item.description }}</td>
                            <td class="text-center">
                              <v-btn
                                fab
                                dark
                                x-small
                                color="red"
                                @click="deleteMileston(index)"
                              >
                                <v-icon dark>
                                  mdi-trash-can-outline
                                </v-icon>
                              </v-btn>
                            </td>
                          </tr>
                        </tbody>
                      </v-simple-table>
                    </v-col>

                    <v-col cols="12" class="text-center">
                      <v-btn 
                        outlined
                        @click="add_hito=true"
                        color="primary">
                        <v-icon dark>
                          mdi-plus
                        </v-icon>
                        Agregar
                      </v-btn>
                    </v-col>

                    <v-col cols="12">
                      <h2 class="font-weight-light">Datos de radicación:</h2>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-select
                        :items="provincias"
                        v-model="provincia_id"
                        v-on:change="getLocalidades"
                        item-text="name"
                        item-value="id"
                        label="Provincia*"
                        outlined
                      ></v-select>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-select
                        :items="localidades"
                        v-model="localidad_id"
                        item-text="name"
                        item-value="id"
                        label="Localidad*"
                        outlined
                      ></v-select>
                    </v-col>

                  </v-row>
                </v-form>
              </v-card-text>
              
              <v-divider></v-divider>

              <v-row>
                <v-col cols="12" class="pt-8 pl-8 pr-8">
                  <h2 class="font-weight-light">Datos del Usuario</h2>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12"  class="pl-8 pr-8">
                  <v-text-field
                    outlined
                    v-model="username"
                    :maxlength="50"
                    :counter="50"
                    :rules="[v => (v || '' ).length <= 49 || 'La contraseña no debe tener mas de 50 caracteres']"
                    label="Usuario*"
                    required
                    disabled
                  ></v-text-field>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12"  class="pl-8 pr-8">
                  <v-text-field
                    outlined
                    v-model="email"
                    :maxlength="50"
                    :counter="50"
                    :rules="[v => (v || '' ).length <= 49 || 'La contraseña no debe tener mas de 50 caracteres']"
                    label="Correo electrónico*"
                    required
                    disabled
                  ></v-text-field>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12"  class="pl-8 pr-8">
                  <v-text-field
                    outlined
                    v-model="password"
                    :maxlength="50"
                    :counter="50"
                    :rules="[v => (v || '' ).length <= 49 || 'La contraseña no debe tener mas de 50 caracteres']"
                    label="Contraseña*"
                    required
                    type="password"
                  ></v-text-field>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" class="pl-8 pr-8">
                  <v-text-field
                    outlined
                    v-model="confirm_password"
                    :maxlength="50"
                    :counter="50"
                    :rules="[v => (v || '' ).length <= 49 || 'La contraseña no debe tener mas de 50 caracteres']"
                    label="Confirmar contraseña*"
                    required
                    type="password"
                  ></v-text-field>
                </v-col>

                <v-col cols="12" class="pa-8">
                  <label class="text--secondary text--danger">Los campos señalados con * son obligatorios</label>
                </v-col>
              </v-row>
              
              <v-divider></v-divider>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn 
                color="info" 
                large
                :loading="loading" 
                @click="register">
                  <v-icon left>lock</v-icon>
                  Registrarse
                </v-btn>
              </v-card-actions>
            </v-sheet>
          </v-layout>
        </v-flex>
      </v-layout>
    </v-container>

    <v-dialog
      v-model="dialog_errors"
      persistent
      max-width="640"
    >
      <v-card>
        <v-card-title class="text-h6">
          Advertencia
        </v-card-title>
        <v-card-text>

          <v-list-item v-for="error in errors" :key="error">
            - {{ error }}
          </v-list-item>
          
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_errors = false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_invalid_url"
      persistent
      max-width="640"
    >
      <v-card>
        <v-card-title class="text-h6">
          Advertencia
        </v-card-title>
        <v-card-text>

          <v-list-item>
            <v-list-item-content>
              <v-list-item>
                - La invitación es invalidad, puede deberse a que ya expiro o que este 
                mal la URL. Pongase en contacto con el administrador
              </v-list-item>
            </v-list-item-content>
          </v-list-item>
          
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            :to="{ name: 'UNLPotencia' }"
          >
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="add_hito"
      persistent
      max-width="700px"
      >
      <v-card>
        <v-card-title>
          <span class="text-h5">Curriculum de la StartUp</span>
        </v-card-title>
        <v-card-text>

            <v-row>
              <v-col
                cols="12"
                class="pt-9"
              >
                <v-select
                  v-model="milestone_type"
                  :items="['Hitos', 'Participación en eventos', 'Convocatorias', 'Participación en otros espacios UNL [Expresiva, Idear, PTLC, Emprendedores, Otros]', 'Financiamiento']"
                  label="Tipo"
                  required
                  outlined
                ></v-select>
              </v-col>

              <v-col
                cols="12"
              >
                <v-textarea
                  v-model="milestone_description"
                  label="Decripción"
                  outlined
                  required
                  :counter="300"
                  :maxlength="300"
                ></v-textarea>
              </v-col>
 
            </v-row>

        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="add_hito = false"
          >
            Cerrar
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="addMilestone"
          >
            Agregar
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
  </v-main>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
   name: 'InvitationVip',
   data: () => ({
      loading:false,
      darkTheme: true,
      platformName:'UNLPotencia',

      add_hito:false,
      aux:null, 
      show: false,
      id: null,
      title:'',
      executive_summary:'',
      problem_detected:'',
      proposed_solution:'',
      products_services_you_offer:'',
      market:'',
      entrepreneurial_team:'',
      action_plan:'',
      
      entrepreneurship_stadia_id: 1,
      entrepreneurship_stadium:[],

      vertical_works_id: 1,
      vertical_works:[],

      entrepreneurship_needs_2:[],
      entrepreneurship_needs:[],
      needs:[],

      video:null,

      development_degrees_id: 1,
      development_degree:[],

      milestone_id:1000,
      milestone_type:'Hitos',
      milestone_description: '',

      headers: [
        { text: 'Tipo', value: 'type', width: '20%'},
        { text: 'Descripción', value: 'description', width: '50%' },
        { text: 'acciones', value: 'action' },
      ],
      curriculum_idea: [],

      provincia_id:1,
      provincias:[],

      localidad_id:null,
      localidades:[],

      edition_id:null,
      name:'',
      lastname:'',
      username:'',
      email:'',
      password:'',
      confirm_password:'',

      data:[],
      error:'',
      errors:[],
      dialog_errors: false,
      dialog_invalid_url: false
    }),
    computed: {
    ...mapGetters([
      'isLogged', 'user'
      ])
    },
    methods: {
      async getEntrepreneurshipStadium(){
        try {
          await axios.get('entrepreneurship-stadium').then(response =>{
            if(response.data.length!==0){
              this.entrepreneurship_stadium = response.data.entrepreneurship_stadium
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },	

      async getDevelopmentDegree(){
        try {
          await axios.get('development-degree').then(response =>{
            if(response.data.length!==0){
              this.development_degree = response.data.development_degree
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },	

      async getVerticalWorks(){
        try {
          await axios.get('vertical-works').then(response =>{
            if(response.data.length!==0){
              this.vertical_works = response.data.vertical_works
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },	

      async getEntrepreneurshipNeeds(){
        try {
          await axios.get('entrepreneurship-needs').then(response =>{
            if(response.data.length!==0){
              this.needs = response.data.entrepreneurship_needs
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },	

      async getProvincias(){
        try {
          await axios.get('provincias').then(response =>{
            if(response.data.length!==0){
              this.provincias = response.data.provincias
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },

      async getLocalidades(){
        try {
          await axios.get('provincias-localidades/'+this.provincia_id).then(response =>{
            if(response.data.length!==0){
              this.localidades = response.data.provincia.localidads
              this.localidad_id = response.data.provincia.localidads[0].id
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
          
        } catch (error) {
          console.log(error)
        }
      },

      async getLocalidadesCreated(){
        try {
          await axios.get('provincias-localidades/'+this.provincia_id).then(response =>{
            if(response.data.length!==0){
              this.localidades = response.data.provincia.localidads
              this.localidad_id = response.data.provincia.localidads[0].id
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
          
        } catch (error) {
          console.log(error)
        }
      },

      addMilestone(){
        let data = {  
                      'id': this.milestone_id,
                      'type':this.milestone_type, 
                      'description': this.milestone_description, 
                      'action':null 
                    };
        
        this.curriculum_idea.push(data)
        this.milestone_id++
        this.milestone_type = 'Hitos'
        this.milestone_description = ''
        this.add_hito = false
      },

      deleteMileston(index){
        this.curriculum_idea.splice(index, 1)
      },

      async getInvitation(){
        await axios.get('invitation-entrepreneurship/'+this.url).then(response =>{
          this.data = response.data.invitation
          
          this.edition_id = response.data.invitation.edition_id 
          this.name = response.data.invitation.name
          this.lastname = response.data.invitation.lastname
          this.username = this.lastname.toUpperCase()+', '+this.name
          this.email = response.data.invitation.email
          this.title = response.data.invitation.title

          this.loading=false

        }).catch(error => {
          console.log(error)
          if(error.response.status===404){
            this.dialog_invalid_url = true
            // this.$router.push({ name: 'UNLPotencia' })  
          }
        })
      },

      async register() {
        this.loading=true
        this.errors = []
        try {
          await axios.put('invitation-entrepreneurship/'+this.url, {
            edition_id:                   this.edition_id,
            title:                        this.title,
            executive_summary:            this.executive_summary,
            problem_detected:             this.problem_detected,
            proposed_solution:            this.proposed_solution,
            products_services_you_offer:  this.products_services_you_offer,
            market:                       this.market,
            entrepreneurial_team:         this.entrepreneurial_team,
            action_plan:                  this.action_plan,
            
            vertical_works_id:            this.vertical_works_id,
            entrepreneurship_stadia_id:   this.entrepreneurship_stadia_id,
            development_degrees_id:       this.development_degrees_id,

            entrepreneurship_needs:       this.entrepreneurship_needs,

            video:                        this.video,

            curriculum_idea:              this.curriculum_idea,

            provincia_id:                 this.provincia_id,
            localidad_id:                 this.localidad_id,

            name:                         this.name,
            lastname:                     this.lastname,
            email:                        this.email,
            password:                     this.password,
            confirm_password:             this.confirm_password,
          })
          .then(() => {
            this.$router.push({ name: 'login' })
          })
        }catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")

          if( error.response.data.errors.length != 0){
            Object.values(error.response.data.errors).forEach(error => {
              this.errors.push(error[0])
            })
          }
          this.loading=false
          this.password = ''
          this.confirm_password = ''
          this.dialog_errors = true
        }
      },

      cheakIsLogin(){
        if(this.isLogged){
          this.$router.push({ name: 'home' })
        }
      }
   },
   created(){
    this.url = this.$route.params.url

    this.cheakIsLogin()
    this.getVerticalWorks()
    this.getInvitation()

    this.getEntrepreneurshipNeeds()
    this.getEntrepreneurshipStadium()
    this.getDevelopmentDegree()
    this.getProvincias()
    this.getLocalidadesCreated()
   }
};
</script>
<style scoped>
   .v-btn,
   .v-card {
      border-radius: 4px;
   }
</style>