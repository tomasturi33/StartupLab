<template>
  <v-main id="inspire" style="padding-top: 0px;">
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
              <p>Inicie sesión con su correo electrónico y contraseña:</p>
              <v-form>
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
                  v-model="password">
                </v-text-field>
              </v-form>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions :class="{ 'pa-3': $vuetify.breakpoint.smAndUp }">
            <v-row>
              <v-col cols="12" xl="6" md="6" sm="6" xs="12">
                <v-btn small :to="{ name:'PasswordRecovery'}" :block="$vuetify.breakpoint.xs" outlined color="info">
                  ¿Olvidaste tu contraseña?
                </v-btn>
              </v-col>
              <v-col cols="12" xl="6" md="6" sm="6" xs="12" class="d-flex justify-end">
                 <v-btn 
                  color="info" 
                  :block="$vuetify.breakpoint.xs" 
                  :large="$vuetify.breakpoint.smAndUp" 
                  :loading="loading" 
                  @click="login">
                  <v-icon left>lock</v-icon>
                  Iniciar sesión
                </v-btn>
              </v-col>
            </v-row>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>

    <v-snackbar
      max-width="440"
      v-model="snackbar"
      :vertical="true"
    >
      {{ text }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="indigo"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Cerrar
        </v-btn>
      </template>
    </v-snackbar>
    
  </v-main>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Login',
  props: {
    source: String,
  },
  data: () => ({
    loading:false,
    snackbar:false,
    text:'',
    darkTheme: true,
    platformName:'UNL Potencia',
    email:'',
    password: '',
    emailRules: [ 
      v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v)
    ]
  }),
  computed: {
  ...mapGetters([
    'isLogged', 'user'
    ])
  },
  methods: {
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
      .catch((err) => {
        console.log(err)
        this.loading=false
        this.snackbar = true
        this.text = 'Correo eletrónico y/ó contraseña no valido.'
      })
    },

    cheakIsLogin(){
      if(this.isLogged){
        this.$router.push({ name: 'CheckConvocations' })
      }
    }
  },
  created(){
    this.cheakIsLogin();
  }
};
</script>
<style scoped>
  .v-btn,
  .v-card {
    border-radius: 4px;
  }

  .v-main2 {
    background-color: lightcyan;
  }
  .row-card {
    width: 100%;
  }
</style>