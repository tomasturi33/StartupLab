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
              @click="addVerticalWork"
              color="primary">
              Nueva Vertical de Trabajo
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
              :items="vertical_works"
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
                      @click="showVerticalWork(item.id)"
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
                      @click="editVerticalWork(item.id)"
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
      width="700"
    >
      <v-card>
        <v-card-title class="text-h6">
          Nueva Vertical de Trabajo
        </v-card-title>

        <v-card-text class="pa-8">
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="name"
                outlined
                label="Vertical de trabajo">
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
            :disabled="name==''"
            text
            @click="createVerticalWork()"
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
          Editar Vertical de Trabajo
        </v-card-title>

        <v-card-text class="pa-8">
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="name"
                outlined
                label="Vertical de Trabajo">
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
            @click="updateVerticalWork()"
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
          Vertical de Trabajo
        </v-card-title>

        <v-card-text class="pa-8">
          <label class="subtitle-2 black--text">Vertical de trabajo:</label>

          <p class="subtitle-1">{{vertical_work.name }}</p>
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
            ¿Está seguro que desea borrar esta vertical de trabajo?
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
              @click="deleteVerticalWork"
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
    name: 'VerticalWorks',

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

      vertical_works:[],
      vertical_work:[],

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
          text: 'Vertical de trabajo',
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
      async getVerticalWorks(){
        await axios.get('admin/vertical-works').then(response =>{
          this.vertical_works = response.data.vertical_works
          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      addVerticalWork(){
        this.name=''
        this.dialog_new=true
      },

      async createVerticalWork()
      {
        try {
          await axios.post('admin/vertical-works',{ 
            name: this.name
            }).then(response =>{
                console.log(response.data)
                this.getVerticalWorks()
                this.dialog_new=false
              })
        } catch (error) {
          this.dialog_new=true
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      },

      async showVerticalWork(id)
      {
        this.dialog_loading=true
        try {
          await axios.get('admin/vertical-works/'+id).then(response =>{
            this.vertical_work = response.data.vertical_work
            this.dialog_loading=false
            this.dialog_show=true
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      },

      async editVerticalWork(id){
        this.id=id
        this.dialog_loading= true
        try {
          await axios.get('admin/vertical-works/'+id).then(response =>{
            this.name = response.data.vertical_work.name
            this.dialog_loading=false
            this.dialog_edit=true
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      },

      async updateVerticalWork(){
        try {
          await axios.put('admin/vertical-works/'+this.id, {
            name: this.name,
            academic_unit_id: this.academic_unit_id
          }).then(() =>{
            this.getVerticalWorks()
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

      async deleteVerticalWork()
      {
        try {
          await axios.delete('admin/vertical-works/'+this.delete_id).then(() =>{
            this.dialog_delete = false
            this.delete_id = null
            this.loading = true
            this.getVerticalWorks()
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      }

    },

    created(){
      this.getVerticalWorks()
    },
  }
</script>