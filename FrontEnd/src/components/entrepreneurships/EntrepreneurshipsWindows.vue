<template>
  <v-row class="pa-4">
    <v-col 
      xl="3" 
      md="4" 
      xs="12"  
      v-for="entrepreneurship in entrepreneurships" :key="entrepreneurship.id">
      <v-card 
        class="mx-auto"
        hover
        height="100%">
          <v-img
            v-if="entrepreneurship.logo"
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
              >
                <v-progress-circular
                  indeterminate
                  color="grey lighten-5"
                ></v-progress-circular>
              </v-row>
            </template>
          </v-img>

          <v-img
            v-if="!entrepreneurship.logo"
            :src="require('@/assets/img/image_available.png')"
            class="white--text align-end text-truncate"
            gradient="to bottom, rgba(0,0,0,.01), rgba(0,0,0,.5)"
            height="200px"
            contain
          >
            <v-card-title>{{ entrepreneurship.title }}</v-card-title>
            <template v-slot:placeholder>
              <v-row
                class="fill-height ma-0"
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

            <v-btn 
              :color="(entrepreneurship.published)?'info':'error'" 
              :to="{ name: 'showEntrepreneurshipsWindowWall', params: { id: entrepreneurship.id } }"
              small>
              Vidriera
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
      name: 'EntrepreneurshipsWindows',
      props:['edition_id'],
      data: () => ({
        loading:true,
        show:false,
        
        dialog:false,
        name:'',
        
        entrepreneurships:[]
      }),

      watch:{
        edition_id: {
          handler: function() {
              this.getEntrepreneurships(); // call it in the context of your component object
          },
          deep: true
        }
      },
  
      methods:{
        async getEntrepreneurships(){
          if(this.edition_id){
            this.loading=true
            await axios.get('admin/entrepreneurships/'+this.edition_id+'/entrepreneurship-windows').then(response =>{
              this.entrepreneurships = response.data.data.windows

              this.entrepreneurships.forEach(element => {
                if(element.logo){
                  element.url_logo = APP_URL + element.logo
                }else{
                  element.url_logo = APP_URL+'/img/image_available.png'
                }
              });
              this.loading = false
            }).catch(error => {
              console.log(error);
            })
          }
        }
      },
  
      created(){
        this.getEntrepreneurships()
      },
    }
  </script>