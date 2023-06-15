import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'

import { VueTypedJs } from 'vue-typed-js'
Vue.use(VueTypedJs)

// router setup
import VueRouter from 'vue-router'
import router from './routes/routes'

import store from './store'

import LazyTube from "vue-lazytube";
Vue.use(LazyTube);

import axios from 'axios'
axios.defaults.baseURL = process.env.VUE_APP_URL_API;

import 'viewerjs/dist/viewer.css'
import VueViewer from 'v-viewer'
Vue.use(VueViewer)

Vue.use(VueRouter)
Vue.use(vuetify)

import VueCoreVideoPlayer from 'vue-core-video-player'

Vue.use(VueCoreVideoPlayer)

Vue.config.productionTip = false

new Vue({
  vuetify,
  store,
  router,
  created () {
    const userInfo = localStorage.getItem('user')
    const convocationFormInfo = localStorage.getItem('convocation_form')
    
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.$store.commit('setUserData', userData)
      this.$store.dispatch('Logged', {is_logged: true})
    }
    if(convocationFormInfo) {
      const convocationFormData = JSON.parse(convocationFormInfo)
      this.$store.commit('setConvocationForm', convocationFormData)
    }

    axios.interceptors.response.use(
      response => response,
      error => {
        if (error.response.status === 401) {
          this.$store.dispatch('logout')
        }
        return Promise.reject(error)
      }
    )
  },
  render: h => h(App)
}).$mount('#app')
