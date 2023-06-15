<template>
  <v-row class="space-around text-center">
    <v-col 
      xl="3" 
      md="4" 
      xs="12" 
      class="pa-4" 
      v-for="entrepreneurship in entrepreneurships" :key="entrepreneurship.id">
      <v-card 
        class="mx-auto"
        hover
        height="100%">
          <v-img

            v-bind:src="entrepreneurship.url_logo"
            class="white--text align-end text-truncate"
            gradient="to bottom, rgba(0,0,0,.01), rgba(0,0,0,.5)"
            height="200px"
            contain
          >
            <v-card-title>{{ entrepreneurship.title }}</v-card-title>
            <template v-slot:placeholder>
              <v-row
                class="fill-height ma-0"
                align="center"

              >
                <v-progress-circular
                  indeterminate
                  color="grey lighten-5"
                ></v-progress-circular>
              </v-row>
            </template>
          </v-img>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn color="info" @click="showEntrepreneurships(entrepreneurship.slug)" small>
              Ver StartUp
            </v-btn>

          </v-card-actions>
        </v-card>
      </v-col>

    <v-dialog
      v-model="loading"
      overlay
      persistent
      width="300"
    >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          <label>Cargando...</label>
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
  const APP_URL = process.env.VUE_APP_URL

  import axios from 'axios'

  export default {
    name: 'OtherEntrepreneurships',

    data: () => ({
      show: false,
      title:'Top western road trips Top western Top western road trips Top western',
      entrepreneurships:null,
      loading:true
    }),

    methods:{
      async getEntrepreneurship(){
        await axios.get('entrepreneurship-windows').then(response =>{
          this.entrepreneurships = response.data.windows

          this.entrepreneurships.forEach(element => {
            if(element.logo){
              element.url_logo = APP_URL + element.logo
            }else{
              element.url_logo = APP_URL+'/img/neutral.jpg'
            }
          });
          this.loading = false
        }).catch(error => {
          console.log(error);
        })
      },

      getImgUrl(emp) {
        console.log(emp)
        var images = require.context('@/assets/img/emprendimientos/', false, /\.jpg$/)
        return images("./5.jpg")
        //return images('./' + emp + ".jpg")
      },

      showEntrepreneurships(slug){
        this.$router.push({ name: 'showotherentrepreneurships', params: { slug: slug } })
      }
    },

    created(){
      this.getEntrepreneurship()
    },
  }
</script>
