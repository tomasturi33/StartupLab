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
              <p>Nueva contraseña:</p>
              <v-form class="pb-8">
                <v-row>
                  <v-col cols="12" xl="6" md="6" sm="6" xs="12">
                    <v-text-field
                      outline
                      hide-details
                      label="Contraseña"
                      type="password"
                      v-model="password">
                    </v-text-field>
                  </v-col>

                  <v-col cols="12" xl="6" md="6" sm="6" xs="12">
                    <v-text-field
                      outline
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
            <v-card-actions :class="{ 'pa-3': $vuetify.breakpoint.smAndUp }">
            <v-row>
              <v-spacer></v-spacer>
              <v-col cols="12" xl="6" md="6" sm="6" xs="12" class="d-flex justify-end">
                 <v-btn 
                  color="info" 
                  :block="$vuetify.breakpoint.xs" 
                  :large="$vuetify.breakpoint.smAndUp" 
                  :loading="loading" 
                  @click="validate">
                  <v-icon left>lock</v-icon>
                  Guardar
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
import axios from 'axios';
import { mapGetters } from 'vuex'

export default {
  name: 'setPasswordRecovery',
  props: {
    source: String,
  },
  data: () => ({
    loading:false,
    platformName:'UNL Potencia',
    darkTheme: true,
    url:'',
    password:'',
    confirm_password:'',

    multiLine: true,
    snackbar: false,
    text: `Se ha enviado un correo electrónico con las indicaciones.`,
  }),
  computed: {
  ...mapGetters([
    'isLogged', 'user'
    ])
  },
  methods: {

    validate(){
      if(this.password.length<8){
        this.text = 'La contraseña debe tener al menos 8 caracteres.'
        this.snackbar = true
      }else{
        if(this.password!=this.confirm_password){
          this.text = 'Las contraseñas no coinciden.'
          this.snackbar = true
        }else{
          this.save()
        }
        
      }
    },

    async save(){
      this.loading=true
      await axios.put('/password-reset/'+this.url, { 
        password: this.password,
        confirm_password: this.confirm_password
      }).then( response => {
        console.log(response.data)
        this.text= response.data.message
        this.snackbar= true
        this.loading= false
        setTimeout(()=>{
          this.$router.push({ name: 'login' }) 
        }, 2000);
      }).catch(err => {
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
    this.cheakIsLogin();
  }
};
</script>
<style scoped>
  .v-btn,
  .v-card {
    border-radius: 4px;
  }

  .v-main {
    background-color: lightcyan;
  }
  .row-card {
    width: 100%;
  }
</style>