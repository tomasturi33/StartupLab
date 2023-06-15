<template>
<div>
  <v-app-bar class="color-app-bar" app dark>
    <v-app-bar-nav-icon 
      @click="menu" 
      v-if="isLogged">
    </v-app-bar-nav-icon>
    <v-toolbar-title> 
      <b><b>UNL</b></b>Potencia
    </v-toolbar-title>
    
    <v-spacer></v-spacer>

    <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          min-width="240px"
          outlined
          color="white"
          small
          v-show="isLogged"
          v-bind="attrs"
          v-on="on"
        >
          {{ (user!==null)?user.lastname+', '+user.name:'' }}
        </v-btn>
      </template>

      <v-list>
        <v-list-item>
          <v-btn
            block
            :to="{name: 'profile'}">
            Editar Perfíl
          </v-btn>
        </v-list-item>

        <v-list-item>
          <v-btn
            block
            @click="logout">
            Cerrar sesión
          </v-btn>
        </v-list-item>
      </v-list>
      
    </v-menu>
  </v-app-bar>

  <v-navigation-drawer color="#9ED5E1" app v-model="drawer" v-if="user">
    <v-list-item>
      <v-list-item-icon>
          <v-icon>mdi-speedometer</v-icon>
        </v-list-item-icon>
      <v-list-item-content>
        <h4>UNL Potencia</h4>
      </v-list-item-content>
    </v-list-item>

    <v-list dense nav>
      <div v-if="this.user.roles.find(element => element =='entrepreneur')">  
        
        <v-divider></v-divider>

        <v-list-item router to="/home">
          <v-list-item-icon>
            <v-icon>mdi-home-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/my-entrepreneurship"  v-if="state_convocation_form=='accepted'">
          <v-list-item-icon>
            <v-icon>mdi-airplane</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>StartUp</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/convocation" v-if="state_convocation_form=='empty' || state_convocation_form=='in_progress' || state_convocation_form=='pending' || state_convocation_form=='rejected'" >
          <v-list-item-icon>
            <v-icon>mdi-hexagon-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Convocatoria</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/other-entrepreneurships" v-if="state_convocation_form=='accepted'">
          <v-list-item-icon>
            <v-icon>mdi-hexagon-multiple-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Otras StartUps</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/about">
          <v-list-item-icon>
            <v-icon>mdi-information-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Acerca de UNLPotencia</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </div>
      <div v-if="user.roles.find(element => element =='admin')">
        <v-divider></v-divider>
          <v-list-item-title class="pl-8 pa-2"> Administrador </v-list-item-title>
        <v-divider></v-divider>
        
        <v-list-item router to="/admin/editions">
          <v-list-item-icon>
            <v-icon>mdi-trophy-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Ediciones</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/admin/entrepreneurships">
          <v-list-item-icon>
            <v-icon>mdi-hexagon-multiple-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Emprendimientos</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/admin/entrepreneurs">
          <v-list-item-icon>
            <v-icon>mdi-account-group-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Emprendedores</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/admin/evaluators">
          <v-list-item-icon>
            <v-icon>mdi-school-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Evaluadores</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/admin/tutors">
          <v-list-item-icon>
            <v-icon>mdi-human-male-board-poll</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Tutores</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/admin/users">
          <v-list-item-icon>
            <v-icon>mdi-account-group-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Usuarios</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/admin/config">
          <v-list-item-icon>
            <v-icon>mdi-cog-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Configuraciones</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </div>

      <div v-if="user.roles.find(element => element=='evaluator')">   
        <v-divider></v-divider>
          <v-list-item-title class="pl-8 pa-2">Evaluador</v-list-item-title>
        <v-divider></v-divider>

        <v-list-item router to="/evaluator/entrepreneurships-assigned">
          <v-list-item-icon>
            <v-icon>mdi-hexagon-multiple-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Tareas</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item router to="/evaluator/modules">
          <v-list-item-icon>
            <v-icon>mdi-view-module-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Modúlos</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </div>

      <div v-if="user.roles.find(element => element=='tutor')">   
        <v-divider></v-divider>
          <v-list-item-title class="pl-8 pa-2">Tutor</v-list-item-title>
        <v-divider></v-divider>

        <v-list-item router to="/tutor/entrepreneurships-assigned">
          <v-list-item-icon>
            <v-icon>mdi-hexagon-multiple-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Emprendimientos</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </div>
      
    </v-list>
  </v-navigation-drawer>

  <v-app-bar class="color-app-bar" app dark>
    <v-app-bar-nav-icon 
      @click="menu" 
      v-if="isLogged">
    </v-app-bar-nav-icon>
    <v-toolbar-title> 
      <b><b>UNL</b></b>Potencia
    </v-toolbar-title>
    
    <v-spacer></v-spacer>

    <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-if="!$vuetify.breakpoint.xsOnly"
          min-width="240px"
          outlined
          color="white"
          small
          v-show="isLogged"
          v-bind="attrs"
          v-on="on"
        >
          {{ (user!==null)?user.lastname+', '+user.name:'' }}
        </v-btn>

          <v-avatar 
            v-if="$vuetify.breakpoint.xsOnly"
            class="ma-2"
            v-show="isLogged"
            v-bind="attrs"
            v-on="on"
            size="42"
            color="white">
            <span class="black--text text-h7">
              {{ (user!==null)?user.name[0]+user.lastname[0]:'' }}
            </span>
          </v-avatar>
        
      </template>

      <v-list>
        <v-list-item>
          <v-btn
            block
            :to="{name: 'profile'}">
            Editar Cuenta
          </v-btn>
        </v-list-item>

        <v-list-item>
          <v-btn
            block
            @click="logout">
            Cerrar sesión
          </v-btn>
        </v-list-item>
      </v-list>
      
    </v-menu>
  </v-app-bar>

</div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  name: 'AppBar',
  data: () => ({
    drawer: true,
    currenRoute:null,
    show_access:false,
    show_login: false,
    show_register: false,

    entrepreneur_role:false,
    admin_role:false,
    evaluator_role:false,
    state_convocation_form:[]
  }),

  computed: {
    ...mapGetters([
      'isLogged', 'user', 'convocation_form'
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
            this.drawer = false
            //this.$store.dispatch('drawer', true);
            break;

          case 'login':
            this.show_access = false;
            this.show_login = true;
            this.show_register = false;
            this.drawer = false
            //this.$store.dispatch('drawer', true);
            break;
          
          case 'register':
            this.show_access = false;
            this.show_login = false;
            this.show_register = true;
            this.drawer = false
            //this.$store.dispatch('drawer', true);
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
    },

    async logout() {
      await axios.post('logout').then(() =>{ 
          this.drawer = false
          //this.$store.dispatch('drawer', true)   
          this.$router.push({ name: "login"})
          this.$store.dispatch('logout')
        }).catch(error => {
          console.log(error);
        })
    },

    menu(){
      this.drawer = !this.drawer
      //this.$store.dispatch('drawer', this.drawer)
    },

    checkRoles(){
      if(this.user!=null){
        const found = this.user.find(element => element == 'entrepreneur');
        return found;
      }
    },

    async getStatus(){
      if(this.convocation_form!=null){
        await axios.get('convocation/status/'+this.convocation_form.convocation_form.id).then((response) =>{
          this.state_convocation_form=response.data.status;
          this.loading=false;
        }).catch(error => {
          console.log(error);
        })
      }
    }
  },

  created(){
    this.currentRoute()
    this.drawer = true
    this.getStatus()
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