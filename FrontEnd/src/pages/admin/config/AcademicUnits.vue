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
              @click="addAcademicUnit"
              color="primary">
              Nueva Unidad Académica
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
              :items="academic_units"
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
                      @click="showAcademiUnit(item.id)"
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
                      @click="editAcademiUnit(item.id)"
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
        <v-card-title class="text-h5">
          Nueva Unidad Académica
        </v-card-title>

        <v-card-text class="pa-8">
          <v-row>
            <v-col cols="12" xl="8" md="8 sm=12">
              <v-text-field
                v-model="name"
                outlined
                label="Unidad Académica">
              </v-text-field>
            </v-col>
            <v-col cols="12" xl="4" md="4 sm=12">
              <v-text-field
                v-model="initials"
                outlined
                label="Iniciales">
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
            :disabled="name==''||initials==''"
            text
            @click="createAcademicUnit()"
          >
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_edit"
      width="700"
    >
      <v-card>
        <v-card-title class="text-h5">
          Editar Unidad Académica
        </v-card-title>

        <v-card-text class="pa-8">
          <v-row>
            <v-col cols="12" xl="8" md="8 sm=12">
              <v-text-field
                v-model="name"
                outlined
                label="Unidad Académica">
              </v-text-field>
            </v-col>
            <v-col cols="12" xl="4" md="4 sm=12">
              <v-text-field
                v-model="initials"
                outlined
                label="Iniciales">
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
            :disabled="name==''||initials==''"
            text
            @click="updateAcademicUnit()"
          >
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_show"
      width="700"
    >
      <v-card>
        <v-card-title class="text-h5">
          Unidad Académica
        </v-card-title>

        <v-card-text class="pa-8">
          <label class="subtitle-2 black--text">Unidad Academica:</label>

          <p class="subtitle-1">{{academic_unit.name }}</p>
          
          <label class="subtitle-2 black--text">Carreras:</label>
          
          <v-row >
            <v-container cols="12">
                <p class="subtitle-1" v-for="item of academic_unit.careers" :key="item.id">- {{ item.name }}</p>
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

    <v-dialog
        v-model="dialog_delete"
        width="500"
      >
        <v-card>
          <v-card-title class="text-h5 lighten-2">
            Atención 
          </v-card-title>

          <v-card-text class="pt-4 pb-6">
            ¿Está seguro que desea borrar esta Unidad Académica?
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
              @click="deleteAcademiUnit"
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
    name: 'AcademicUnits',

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
      initials:'',
      academic_units:[],
      academic_unit:[],

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
          text: 'Unidad académica',
          align: 'start',
          filterable: true,
          value: 'name',
          width: '50%'
        },
        {
          text: 'Iniciales',
          align: 'start',
          filterable: true,
          value: 'initials',
          width: '20%'
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
      async getAcademicUnits()
      {
        await axios.get('admin/academic-units').then(response =>{
          this.academic_units = response.data.academic_units
          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      addAcademicUnit(){
        this.name=''
        this.initials=''
        this.dialog_new=true
      },

      async createAcademicUnit()
      {
        try {
          await axios.post('admin/academic-units',{ 
            name: this.name,
            initials: this.initials
            }).then(response =>{
                console.log(response.data)
                this.getAcademicUnits()
                this.dialog_new=false
              })
        } catch (error) {
          this.dialog_new=true
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      },

      async showAcademiUnit(id)
      {
        this.dialog_loading=true
        try {
          await axios.get('admin/academic-units/'+id).then(response =>{
            this.academic_unit = response.data.academic_unit
            this.dialog_loading=false
            this.dialog_show=true
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      },

      async editAcademiUnit(id){
        this.id=id
        this.dialog_loading= true
        try {
          await axios.get('admin/academic-units/'+id).then(response =>{
            this.name = response.data.academic_unit.name
            this.initials = response.data.academic_unit.initials
            this.dialog_loading=false
            this.dialog_edit=true
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      },

      async updateAcademicUnit(){
        try {
          await axios.put('admin/academic-units/'+this.id, {
            name: this.name,
            initials:this.initials
          }).then(() =>{
            this.getAcademicUnits()
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

      async deleteAcademiUnit(){
        try {
          await axios.delete('admin/academic-units/'+this.delete_id).then(() =>{
            this.dialog_delete = false
            this.delete_id = null
            this.loading=true
            this.getAcademicUnits()
          })
        } catch (error) {
          console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
        }
      }

    },

    created(){
      this.getAcademicUnits()
    },
  }
</script>