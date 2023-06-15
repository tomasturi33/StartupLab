<template>
  <div>
    <v-app  v-if="this.show_navigation" >

      <UNLPotencia />

      <Footer />
    </v-app>
    
    <v-app v-if="!this.show_navigation" >

      <AppBarNotLogin v-if="!isLogged"/>
      <AppBar v-if="isLogged"/>

      <v-main>
        <v-container>
          <BreadCrumb />
          <router-view />
        </v-container>
      </v-main>
      <Footer />
    </v-app>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import BreadCrumb from "@/components/BreadCrumb.vue";
import AppBar from "@/components/template/AppBar.vue";
import AppBarNotLogin from "@/components/template/AppBarNotLogin.vue";
import Footer from "@/components/template/Footer.vue";

import UNLPotencia from "@/pages/UNLPotencia/UNLPotencia.vue";

export default {
  name: 'App',
  components: {
    BreadCrumb,
    AppBar,
    AppBarNotLogin,
    Footer,
    UNLPotencia
  },
  data: () => ({
    currenRoute:null,
    show_appbar:false,
    show_navigation:false,
  }),
  computed: {
    ...mapGetters([
      'isLogged'
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
            this.show_appbar=true
            this.show_navigation=true
            break;
          
          default:
            this.show_appbar=false
            this.show_navigation=false
            break;
        }
      });
    }
  },
  created(){
    this.currentRoute()
  }
};
</script>
<style>
.v-main {   
  padding-bottom: 4em!important;
  /* background-color: lightcyan;*/
  background-color: rgb(255, 255, 255); 
}

.text{
    white-space: pre-wrap;
    white-space: -moz-pre-wrap;
    white-space: -o-pre-wrap;
}
</style>
