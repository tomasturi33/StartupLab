<template>
  <v-row>
    <v-col>
      <v-sheet 
        width="100%"
        outlined
      >
        <v-row>

          <v-col 
            cols="12" 
            xl="6" 
            md="6" 
            sm="12" 
            class="pa-8">
            <v-btn 
              @click="addLocalidad"
              color="primary">
              Nueva Localidad
            </v-btn>
          </v-col>

          <v-col 
            cols="12" 
            xl="6" 
            md="6" 
            sm="12" 
            class="pa-8">
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Buscar"
              single-line
              hide-details
            ></v-text-field>
          </v-col>
            
          <v-col cols="12">

            <v-data-table
              :headers="headers"
              :items="localidades"
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
                  @click="showLocalidad(item.id)"
                >
                  <v-icon dark small>
                    mdi-eye
                  </v-icon>
                </v-btn>

                <v-btn
                  class="mx-2"
                  fab
                  dark
                  x-small
                  color="warning"
                  @click="editLocalidad(item.id)"
                >
                  <v-icon small>
                    mdi-pencil
                  </v-icon>
                </v-btn>

                <v-btn
                  class="mx-2"
                  fab
                  dark
                  x-small
                  color="red"
                  @click="confirmDelete(item.id)"
                >
                  <v-icon dark small>
                    mdi-close
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
      v-model="dialog_new"
      max-width="700"
    >
      <v-card>
        <v-card-title class="text-h6">
          Nueva Localidad
        </v-card-title>

        <v-card-text class="pa-8">
          <v-row>
            <v-col cols="12">
              <v-select
                :items="provincias"
                v-model="provincia_id"
                item-text="name"
                item-value="id"
                label="Provincia"
                outlined
              ></v-select>
              <v-text-field
                v-model="name"
                outlined
                label="Localidad">
              </v-text-field>
            </v-col>
          </v-row>
          
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_new=false"
          >
            Cerrar
          </v-btn>
          <v-btn
            color="primary"
            :disabled="name===''"
            text
            @click="createLocalidad()"
          >
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_edit"
      max-width="700"
    >
      <v-card>
        <v-card-title class="text-h6">
          Editar Localidad
        </v-card-title>

        <v-card-text class="pa-8">
          <v-row>
            <v-col cols="12">
              <v-select
                :items="provincias"
                v-model="provincia_id"
                item-text="name"
                item-value="id"
                label="Provincia"
                outlined
              ></v-select>
              <v-text-field
                v-model="name"
                outlined
                label="Localidad">
              </v-text-field>
            </v-col>
          </v-row>
          
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_edit=false"
          >
            Cerrar
          </v-btn>
          <v-btn
            color="primary"
            :disabled="name==''"
            text
            @click="updateLocalidad()"
          >
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_show"
      max-width="700"
    >
      <v-card>
        <v-card-title class="text-h6">
          Ver Localidad
        </v-card-title>

        <v-card-text class="pa-8">
          <label class="subtitle-2 black--text">Localidad:</label>

          <p class="subtitle-1">{{localidad.name }}</p>
          
          <label class="subtitle-2 black--text">Provincia:</label>
          
          <p class="subtitle-1">{{ provincia.name }}</p>
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

    <v-dialog
      v-model="dialog_delete"
      width="500"
    >
      <v-card>
        <v-card-title class="text-h5 lighten-2">
          Atención 
        </v-card-title>

        <v-card-text class="pt-4 pb-6">
          ¿Está seguro que desea borrar esta necesidad de emprendimiento?
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_delete = false"
          >
            Cancelar
          </v-btn>
          <v-btn
            color="primary"
            text
            @click="deleteLocalidad"
          >
            Borrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-row>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'Localidades',

    data: () => ({
      loading:true,
      dialog_loading:false,
      dialog_new:false,
      dialog_edit:false,
      dialog_show:false,
      dialog_delete:false,
      delete_id:null,

      id:null,

      name:'',
      provincia_id:1,

      provincias:[],
      localidades:[],
      localidad:[],
      provincia:[],

      search: '',
      headers: [
        {
          text: 'ID',
          align: 'start',
          filterable: false,
          value: 'id',
          width: '5%'
        },
        {
          text: 'Carrera',
          align: 'start',
          filterable: true,
          value: 'name',
          width: '70%'
        },
        {
          text: 'Acciones',
          align: 'start',
          filterable: false,
          value: 'actions',
          width: '25%'
        },
      ]
    }),

    methods:{
      async getLocalidades(){
        await axios.get('admin/localidades').then(response =>{
          this.localidades = response.data.localidades
          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      async getProvincias()
      {
        await axios.get('admin/provincias').then(response =>{
          this.provincias = response.data.provincias
        }).catch(error => {
          console.log(error);
        })
      },

      addLocalidad(){
        this.name= ''
        this.provincia_id= 1
        this.dialog_new= true
      },

      async createLocalidad()
      {
        try {
          await axios.post('admin/localidades',{ 
            name: this.name,
            provincia_id: this.provincia_id
            }).then(response =>{
                console.log(response.data)
                this.getLocalidades()
                this.dialog_new=false
              })
        } catch (error) {
          this.dialog_new=true
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      },

      async showLocalidad(id)
      {
        this.dialog_loading=true
        try {
          await axios.get('admin/localidades/'+id).then(response =>{
            this.localidad = response.data.localidad
            this.provincia = response.data.localidad.provincia
            this.dialog_loading=false
            this.dialog_show=true
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      },

      async editLocalidad(id){
        this.id=id
        this.dialog_loading= true
        try {
          await axios.get('admin/localidades/'+id).then(response =>{
            this.name = response.data.localidad.name
            this.provincia_id= response.data.localidad.provincia_id
            this.dialog_loading=false
            this.dialog_edit=true
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      },

      async updateLocalidad(){
        try {
          await axios.put('admin/localidades/'+this.id, {
            name: this.name,
            provincia_id: this.provincia_id
          }).then(() =>{
            this.getLocalidades()
            this.dialog_edit=false
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      },

      confirmDelete(id){
        this.dialog_delete = true
        this.delete_id = id
      },

      async deleteLocalidad(){
        try {
          await axios.delete('admin/localidades/'+this.delete_id).then(() =>{
            this.dialog_delete = false
            this.delete_id = null
            this.loading = true
            this.getLocalidades()
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
        
      }

    },

    created(){
      this.getLocalidades()
      this.getProvincias()
    },
  }
</script>