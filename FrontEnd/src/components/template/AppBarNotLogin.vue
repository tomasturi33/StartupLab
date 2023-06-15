<template>
<div>
  <v-app-bar class="color-app-bar" app dark>
    <v-toolbar-title> 
      <router-link class="routerLink white--text" :to="{ name: 'UNLPotencia' }">
        <b><b>UNL</b></b>Potencia
      </router-link>
      
    </v-toolbar-title>
    
    <v-spacer></v-spacer>

    <v-btn
      class="ma-2"
      outlined
      color="white"
      small
      v-show="!isLogged && show_register"
      @click="login"
    >
      Iniciar sesión
    </v-btn>

    <v-btn
      class="ma-2"
      outlined
      color="white"
      small
      v-show="!isLogged && show_login"
      @click="register"
    >
      Registrarse
    </v-btn>

    <v-btn
      class="ma-2"
      outlined
      color="white"
      small
      v-show="show_access"
      @click="login"
    >
      Acceder
    </v-btn>
  </v-app-bar>
</div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'AppBarNotLogin',
  data: () => ({
    drawer: false,
    currenRoute:null,
    show_access:false,
    show_login: false,
    show_register: false
  }),

  computed: {
    ...mapGetters([
      'isLogged', 'user'
    ])
  },

  watch: {
    '$route': 'currentRoute'
  },

  methods: {
    currentRoute() {
      this.$nextTick(() => {
        this.currenRoute = this.$route.name

        switch (this.currenRoute) {
          case 'UNLPotencia':
            this.show_access = true;
            this.show_login = false;
            this.show_register = false;
            break;

          case 'login':
            this.show_access = false;
            this.show_login = true;
            this.show_register = false;
            break;
          
          case 'register':
            this.show_access = false;
            this.show_login = false;
            this.show_register = true;
            break;
        
          default:
            this.show_access = false;
            this.show_login = false;
            this.show_register = false;
            break;
        }
      });
    },

    login(){
      if(this.$route.name=='register'){
        this.currenRoute = 'login'
      }
      this.$router.push({ name: "login"})
    },

    register(){
      if(this.$route.name=='login'){
        this.currenRoute = 'register'
      }
      this.$router.push({ name: "register"})
    },

    access(){
      if(this.$route.name=='UNLPotencia'){
        this.currenRoute = 'UNLPotencia'
      }
    }
  },

  created(){
    this.currentRoute()
    this.drawer = false
  }
  
}
</script>
<style>
.theme--dark.v-app-bar.v-toolbar.v-sheet {
  background: linear-gradient(to right,#00a1b8 0%,#23495c 100%) !important;
}

.routerLink{
  text-decoration: none;
}
</style>