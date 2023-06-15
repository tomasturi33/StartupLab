<template>
  <v-main :class="{ 'pa-2': $vuetify.breakpoint.smAndUp }" :dark="darkTheme" id="inspire">
    <v-container>
      <v-layout class="justify-center" wrap>
        <v-flex sm12 md6>
          <v-card class="pa-2" elevation="4" light tag="section" max-width="640">

            <v-card-title>
              <v-row class="row-card" v-if="!$vuetify.breakpoint.xs">
                <v-col cols="12" xl="9" md="9" sm="6" xs="6">
                  <h3 class="headline">
                    {{ platformName }}
                  </h3>
                </v-col>
                <v-col cols="12" xl="3" md="3" sm="6" xs="6">
                  <v-img 
                    :alt="platformName" 
                    class="mr-3" 
                    contain 
                    height="48px" 
                    position="center right" 
                    :src="require('@/assets/icons/unl.png')">
                  </v-img>
                </v-col>
                
              </v-row>

              <v-row class="row-card"  v-if="$vuetify.breakpoint.xs">
                <v-col cols="12" xs="12" align="center">
                  <v-img 
                    :alt="platformName"  
                    contain 
                    height="96px" 
                    :src="require('@/assets/icons/unl.png')">
                  </v-img>

                  <h3 class="headline">
                    {{ platformName }}
                  </h3>
                </v-col>
              </v-row>
            </v-card-title>

            <v-divider></v-divider>
            <v-card-text>
              <label>Complete el siguiente formulario para registrarse en la plataforma:</label>
              <v-form>
                <v-text-field
                  outline
                  label="Nombre"
                  type="text"
                  v-model="name">
                </v-text-field>
                <v-text-field
                  outline
                  label="Apellido"
                  type="text"
                  v-model="lastname">
                </v-text-field>
                <v-text-field
                  outline
                  label="Correo electrónico"
                  type="text"
                  v-model="email">
                </v-text-field>
                <v-text-field
                  outline
                  hide-details
                  label="Contraseña"
                  type="password"
                  :rules="passwordRules"
                  v-model="password">
                </v-text-field>

                <v-checkbox v-model="terms_condition_accepted">
                  <template v-slot:label>
                    <div>
                      Aceptar 
                      <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                          <a
                            @click="dialog=true"
                            v-on="on"
                          >
                            términos y condiciones
                          </a>
                        </template>
                        Vér terminos y condiciones
                      </v-tooltip>
                    </div>
                  </template>
                </v-checkbox>
                
              </v-form>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions :class="{ 'pa-3': $vuetify.breakpoint.smAndUp }">
              <!-- <v-btn small outlined color="info">
                Solicitar acceso evaluador
              </v-btn>
              <v-btn small outlined color="info">
                Solicitar acceso inversor
              </v-btn> -->

              <v-spacer></v-spacer>
              <v-btn 
               color="info" 
               :large="$vuetify.breakpoint.smAndUp" 
               :loading="loading"
               :block="$vuetify.breakpoint.xs" 
               :disabled="!terms_condition_accepted"
               @click="fieldsValidate">
                <v-icon left>lock</v-icon>
                Registrarse
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>

      <v-dialog
      v-model="error_dialog"
      persistent
      max-width="490"
    >
      <v-card>
        <v-card-title class="text-h5 font-weight-regular">
          Atención
        </v-card-title>
        <v-card-text>
          <label v-for="error in errors" :key="error">{{ error }}<br></label>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="error_dialog = false"
          >
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

      <v-dialog
        v-model="dialog"
        width="700"
      >
        <v-card>
          <v-card-title class="text-h5 grey lighten-2 font-weight-light">
            Términos y condiciones
          </v-card-title>

          <v-card-text>
            <p class="text pt-8">
              {{ convocation.terms_and_conditions }}
            </p>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              text
              @click="dialog = false"
            >
              Cerrar
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

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
      dialog:false,
      error_dialog:false,
      loading:false,
      darkTheme: true,
      platformName:'UNL Potencia',
      name:'',
      lastname:'',
      email:'',
      password: '',
      terms_condition_accepted:false,
      emailRules: [ 
        v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v),
        v => this.validate(v)
      ],
      passwordRules: [ 
          v => !!v || "El campo es requerido",
          v => ( v && v >= 5 ) || "La contraseña debe tener al menos 5 caracteres",
          v => ( v && v <= 25 ) || "La contraseña no debe tener mas de 50 caracteres",
      ],
      error:'',
      errors:[],
      slug:null,
      convocation:[]
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

      fieldsValidate(){
        this.errors = []

        if(this.name.length==0){
          this.errors.push('- Por favor ingrese su nombre')
        }
        if(this.lastname.length==0){
          this.errors.push('- Por favor ingrese su apellido')
        }
        if(this.password.length<8){
          this.errors.push('- La contraseña debe tener al menos 8 caracteres')
        }
        if(!this.validateEmail(this.email)){
          this.errors.push('- El correo electrónico ingresado no es valido')
        }

        if(this.errors.length==0){
          this.register()
        }else{
          this.error_dialog = true
        }
      },

      validateEmail(email) {
        var re = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i 
        return re.test(email);
      },

      async getInfoEdition(){
        await axios.get('index/convocation/'+this.slug).then(response =>{
          if(!response.data.convocation){
            this.$router.push({ name: 'CheckConvocations' })   
            this.loading=false
          }else{
            this.convocation = response.data.convocation
            this.loading=false
          }
          
        }).catch(error => {
          console.log(error)
          if(error.response.status===404){
            this.$router.push({ name: 'UNLPotencia' })  
          }
        })
      },

      register () {
         this.loading=true
         this.$store
         .dispatch('register', {
            name:this.name,
            lastname: this.lastname,
            email: this.email,
            password: this.password,
            edition_id: this.convocation.id,
         })
         .then(() => {
            this.$router.push({ name: 'CheckConvocations' })   
            this.loading=false
         })
         .catch(() => {
            this.loading=false
            this.errors = []
            this.errors.push('Detectamos que en esta edición, tu correo electrónico ya se encuentra en uso')
            this.error_dialog = true
         })
      },

      cheakIsLogin(){
        if(this.isLogged){
          this.$router.push({ name: 'home' })
        }
      }, 

      validateSlugEmpty(){
        if(!this.slug){
          this.$router.push({ name: 'UNLPotencia' })  
        }
      }
   },
   created(){
    this.slug = this.$route.params.slug
    window.scrollTo(0,0);
    this.validateSlugEmpty()
    this.getInfoEdition()
    this.cheakIsLogin()
   }
};
</script>
<style scoped>
  .v-btn,
  .v-card {
    border-radius: 4px;
  }

  .row-card {
    width: 100%;
  }
  
@media (max-width: 900px) {
  .title-potencia {
    display: none;
  }
}

</style>