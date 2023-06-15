<template>
  <v-row>
    <v-col>
      <v-sheet 
        width="100%"
        outlined
      >
        <v-row>
          <v-col cols="12">

            <v-data-table
              :headers="headers"
              :items="provincias"
              :search="search"
              :footer-props="{
                'items-per-page-options': [10, 20, 30, 40, 50],
                'items-per-page-text':'Filas por página'
              }"
              :items-per-page="30"
            >
              <template v-slot:item.actions="{ item }">
                <v-btn
                  class="mx-2"
                  fab
                  dark
                  x-small
                  color="primary"
                  @click="showProvincia(item.id)"
                >
                  <v-icon dark small>
                    mdi-eye
                  </v-icon>
                </v-btn>
              </template>
            </v-data-table>

          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-dialog
      v-model="dialog_loading"
      hide-overlay
      persistent
      width="300"
    >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          Cargando...
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_show"
      max-width="700"
    >
      <v-card>
        <v-card-title class="text-h6">
          Ver Provincia
        </v-card-title>

        <v-card-text class="pa-8">
          <label class="subtitle-2 black--text">Provincia:</label>

          <p class="subtitle-1">{{provincia.name }}</p>

          <label class="subtitle-2 black--text">Localidades:</label>
            
            <v-row >
              <v-container cols="12">
                  <p class="subtitle-1" v-for="item of provincia.localidads" :key="item.id">- {{ item.name }}</p>
              </v-container>
            </v-row>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_show=false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

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
    name: 'Provincias',

    data: () => ({
      loading:true,
      dialog_loading:false,
      dialog_new:false,
      dialog_edit:false,
      dialog_show:false,
      
      id:null,
      name:'',

      provincias:[],
      provincia:[],

      search: '',
      headers: [
        {
          text: 'ID',
          align: 'center',
          filterable: false,
          value: 'id',
          width: '10%'
        },
        {
          text: 'Provincia',
          align: 'start',
          filterable: true,
          value: 'name',
          width: '70%'
        },
        {
          text: 'Acciones',
          align: 'center',
          filterable: false,
          value: 'actions',
          width: '20%'
        },
      ]
    }),

    methods:{
      async getProvincias(){
        await axios.get('admin/provincias').then(response =>{
          this.provincias = response.data.provincias
          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      async showProvincia(id)
      {
        this.dialog_loading=true
        try {
          await axios.get('admin/provincias/'+id).then(response =>{
            this.provincia = response.data.provincia
            this.dialog_loading=false
            this.dialog_show=true
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      }
    },

    created(){
      this.getProvincias()
    },
  }
</script>