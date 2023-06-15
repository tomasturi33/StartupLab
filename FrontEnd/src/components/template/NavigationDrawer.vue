<template>
  <v-navigation-drawer app v-if="drawer">
    <v-list-item>
      <v-list-item-icon>
          <v-icon>mdi-rocket-launch</v-icon>
        </v-list-item-icon>
      <v-list-item-content>
        <h4>UNL Potencia</h4>
      </v-list-item-content>
    </v-list-item>

    <v-divider></v-divider>

    <v-list dense nav>
      <div v-if="this.user.roles.find(element => element =='entrepreneur')">  
      
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
            <v-icon>mdi-hexagon-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Mi Emprendimiento</v-list-item-title>
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
            <v-list-item-title>Otros Emprendimientos</v-list-item-title>
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
        <v-divider></v-divider>
      </div>

      <div v-if="user.roles.find(element => element =='admin')">        

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

        <v-list-item router to="/admin/evaluators">
          <v-list-item-icon>
            <v-icon>mdi-school-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Evaluadores</v-list-item-title>
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
        <v-divider></v-divider>
      </div>

      <div v-if="user.roles.find(element => element=='evaluator')">     
        <v-list-item-title class="pl-8 pa-2">Evaluador</v-list-item-title>
        
        <v-divider></v-divider>
      </div>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  name: 'NavigationDrawer',
  data: () => ({
    entrepreneur_role:false,
    admin_role:false,
    evaluator_role:false,
    state_convocation_form:[]
  }),
  computed: {
    ...mapGetters([
      'drawer', 'user', 'convocation_form'
    ])
  },
  methods:{
    checkRoles(){
      const found = this.user.find(element => element == 'entrepreneur');
      return found;
    },

    async getStatus(){
      await axios.get('convocation/status/'+this.convocation_form.convocation_form.id).then((response) =>{
        this.state_convocation_form=response.data.status;
        this.loading=false;
      }).catch(error => {
        console.log(error);
      })
    }
  },
  created () {
    this.getStatus();
  }
}
</script>