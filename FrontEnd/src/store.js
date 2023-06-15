import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    isLogged: false,
    user: null,
    convocation_form:null,
    drawer:true,
    currentRouteName:null,

    current_edition_id:null,
    current_tab:null,

    state_convocation_form:null,

    currentEdition:null,
    currentTab:'tab-list'
  },
  mutations: {
    setUserData (state, userData) {
      //state.isLogged = true
      state.drawer = true
      state.user = userData
      localStorage.setItem('user', JSON.stringify(userData))
      axios.defaults.headers.common.Authorization = `Bearer ${userData.access_token}`
    },

    setIsLogged(state, isLoggedData) {
      state.isLogged = isLoggedData
    },

    setConvocationForm (state, convocation_form_Data) {
      state.convocation_form = convocation_form_Data
      localStorage.setItem('convocation_form', JSON.stringify(convocation_form_Data))
    },

    getUserData () { 
      const userData = localStorage.getItem('user')
      if (userData) {
        return JSON.parse(userData)
      }
      return null
    },

    getConvocationFormData () { 
      const convocation_form_Data = localStorage.getItem('convocation_form')
      if (convocation_form_Data) {
        return JSON.parse(convocation_form_Data)
      }
      return null
    },

    clearUserData () {
      localStorage.removeItem('user')
      localStorage.removeItem('convocation_form')

      localStorage.clear();
      
      this.state.isLogged= false
    },

    setDrawer (state, drawer) {
      state.drawer = !drawer
    },

    setCurrentRouteName  (state, currentRouteName) {
      state.currentRouteName = currentRouteName
    },

    setCurrentEditionId  (state, current_edition_id) {
      state.current_edition_id = current_edition_id
    },

    setCurrentTab  (state, current_tab) {
      state.current_tab = current_tab
    },

  },
  actions: {
    async register ({ commit }, credentials) {
      return axios
        .post('/register', credentials)
        .then(({ data }) => {
          commit('setUserData', data)
          this.drawer=true
        })
    },

    async login ({ commit }, credentials) {
      return axios
        .post('/login', credentials)
        .then(({ data }) => {
          commit('setUserData', data)
          this.drawer=true
        })
    },

    Logged ({ commit }, is_logged) {
      commit('setIsLogged',is_logged)
    },

    convocationForm ({ commit }, convocation_form) {
      commit('setConvocationForm',convocation_form)
    },

    logout ({ commit }) {
      commit('clearUserData')
      this.drawer=false
    },

    drawer ({ commit }, drawer) {
      commit('setDrawer',drawer)
    }
  },
  getters: {
    isLogged: state => state.isLogged,
    drawer: state => state.drawer,
    user: state => state.user,
    convocation_form: state => state.convocation_form,

    currentEdition: state => state.currentEdition,
    currentTab: state => state.currentTab
  }
})