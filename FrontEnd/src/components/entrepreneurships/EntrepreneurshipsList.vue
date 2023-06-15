<template>
  <v-row class="mt-8">
    <v-col cols="12">

      <v-col cols="12">
        <v-data-table
          class="pt-8"
          :headers="headers"
          :items="entrepreneurships"
          :search="search"
          :items-per-page="30"
              :footer-props="{
                'items-per-page-options': [10, 20, 30, 40, 50, 100],
                'items-per-page-text':'Evaluadores por página',
              }"
          mobile="true"
        >

          <template v-slot:item.actions="{ item }">
            <v-btn
              class="mx-2"
              fab
              dark
              x-small
              color="primary"
              :to="{ name: 'showEntrepreneurships', params: { id: item.id } }"
            >
              <v-icon dark small>
                mdi-eye
              </v-icon>
            </v-btn>
          </template>
        </v-data-table>
      </v-col>
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
  import axios from 'axios'

  export default {
    name: 'EntrepreneurshipsList',
    props:['edition_id'],
    data: () => ({
      loading:false,
      show:false,
      
      dialog:false,
      name:'',
      
      entrepreneurships:[],
      search: '',
      headers: [
        {
          text: 'Emprendimiento',
          align: 'start',
          filterable: true,
          value: 'title',
          width:'60%'
        },
        { 
          text: 'Acciones',
          align: 'center',
          filterable: false,
          value: 'actions',
          width:'10%'
        },
      ]
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
      async getEntrepreneurships()
      {
        if(this.edition_id){
          this.loading=true
          await axios.get('admin/edition/'+this.edition_id+'/entrepreneurships').then(response =>{
            this.entrepreneurships = response.data.data.entrepreneurships
            this.loading=false
            this.show=true
          }).catch(error => {
            console.log(error);
            this.loading=false
          })
        }
      }
    },

    created(){
      this.getEntrepreneurships()
    },
  }
  </script>