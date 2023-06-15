<template>
  <v-main :class="{ 'pa-2': $vuetify.breakpoint.smAndUp }" :dark="darkTheme" id="inspire">
    <v-container>
      <v-layout wrap>

        <v-flex sm12 md8 offset-md2>
          <v-layout align-center justify-space-between>
            <v-card class="pa-2" elevation="4" light tag="section" max-width="840" :loading="loading">
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
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-text-field
                        outlined
                        dense
                        label="Nombre completo"
                        type="text"
                        v-model="name">
                      </v-text-field>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-text-field
                        outlined
                        dense
                        label="Apellido"
                        type="text"
                        v-model="lastname">
                      </v-text-field>
                    </v-col>

                    <v-col cols="12">
                      <h4>Datos para inicio de sesion:</h4>
                    </v-col>

                    <v-col cols="12" xl="12" md="12" sm="12">
                      <p class="font-weight-ligh">{{ entrepreneurial_profile.email }}</p>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-text-field
                        outlined
                        dense
                        hide-details
                        label="Contraseña"
                        type="password"
                        v-model="password">
                      </v-text-field>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-text-field
                        outlined
                        dense
                        hide-details
                        label="Confirmar contraseña"
                        type="password"
                        v-model="confirm_password">
                      </v-text-field>
                    </v-col>

                  </v-row>
                </v-form>
              </v-card-text>
              
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
            </v-card>
          </v-layout>
        </v-flex>

        <v-dialog
          v-model="dialog_errors"
          persistent
          max-width="440"
        >
          <v-card>
            <v-card-title class="text-h6">
              Error
            </v-card-title>
            <v-card-text>

              <v-list-item v-for="error in errors_validate" :key="error">
                <v-list-item-content>
                  <v-list-item-title>- {{ error }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="green darken-1"
                text
                @click="dialog_errors = false"
              >
                Cerrar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>

    </v-container>
  </v-main>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
   name: 'Login',
   props: {
      source: String,
   },
   data: () => ({
      loading:false,
      darkTheme: true,
      platformName:'UNLPotencia',

      emailRules: [ 
        v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v),
        v => this.validate(v)
      ],
  
      url:null,
      convocation:[],
      entrepreneurial_profile:[],

      name:'',
      lastname:'',
      email:'',

      password: '',
      confirm_password: '',
      
      user_id:null,
      convocation_form_id:null,


      error:'',
      errors_validate:[],
      dialog_errors: false,
    }),
    computed: {
    ...mapGetters([
      'isLogged', 'user'
      ])
    },
    methods: {
      validate(a){
         if(a){
            return false
         }
         return true
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

      async getLocalidadesLoad(){
        try {
          await axios.get('provincias-localidades/'+this.provincia_id).then(response =>{
            if(response.data.length!==0){
              this.localidades = response.data.provincia.localidads
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
          
        } catch (error) {
          console.log(error)
        }
      },

      async getCompletedStudies(){
        try {
          await axios.get('completed-studies').then(response =>{
            if(response.data.length!==0){
              this.completed_studies = response.data.completed_studies
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },

      async getAcademicsUnits(){
        try {
          await axios.get('academic-units').then(response =>{
            if(response.data.length!==0){
              this.academic_units = response.data.academic_units
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },

      async getCareers(){
        try {
          await axios.get('academic-units/'+this.academic_unit_id).then(response =>{
            if(response.data.length!==0){
              this.careers = response.data.academic_unit.careers
              this.career_id = this.careers[0].id
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },
      
      async getCareersLoad(){
        try {
          await axios.get('academic-units/'+this.academic_unit_id).then(response =>{
            if(response.data.length!==0){
              this.careers = response.data.academic_unit.careers
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },

      async getInvitation(){
        await axios.get('invitation/'+this.url).then(response =>{
          this.convocation = response.data.invitation
          this.entrepreneurial_profile = response.data.invitation.entrepreneurial_profile

          this.name = response.data.invitation.entrepreneurial_profile.name
          this.lastname = response.data.invitation.entrepreneurial_profile.lastname
          this.email = response.data.invitation.entrepreneurial_profile.email
          this.user_id = response.data.invitation.entrepreneurial_profile.user_id
          this.convocation_form_id = response.data.invitation.entrepreneurial_profile.convocation_form_id

          this.loading=false
          this.getProvincias()
          this.getLocalidadesLoad()
          this.getCareersLoad()

        }).catch(error => {
          console.log(error)
          if(error.response.status===404){
            alert('No se encontro la edición, intente mas tarde.')
            this.$router.push({ name: 'UNLPotencia' })  
          }
        })
      },

      async register() {
        this.loading=true
        await axios.put('invitation/'+this.url, {
          name: this.name,
          lastname: this.lastname,
          email: this.email,
          password: this.password,
        })
        .then(() => {
          this.login()
        })
        .catch(function (error) {
          console.log(error);
        });
      },

      login() {
        this.loading=true
        this.$store
        .dispatch('login', {
          email: this.email,
          password: this.password
        })
        .then(() => {
          this.$router.push({ name: 'CheckConvocations' })   
          this.loading=false
        })
        .catch(err => {
          console.log(err)
          this.loading=false
        })
      },

      cheakIsLogin(){
        if(this.isLogged){
          this.$router.push({ name: 'home' })
        }
      }
   },
   created(){
    this.url = this.$route.params.url
    this.getCompletedStudies();
    this.getAcademicsUnits();
    this.getInvitation()
    this.cheakIsLogin()
   }
};
</script>
<style scoped>
   .v-btn,
   .v-card {
      border-radius: 4px;
   }
</style>