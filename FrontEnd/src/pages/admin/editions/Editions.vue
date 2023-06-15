<template>
  <v-row>
    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined
        min-height="180px"
      >
        <v-row>
          <v-col cols="12" class="pa-8">
            <v-btn 
              @click="newEdition"
              color="primary">
              Nueva edición
            </v-btn>
          </v-col>
          <v-col cols="12">

            <v-data-table
              class="pt-8"
              :headers="headers"
              :items="editions"
              :sort-by.sync="sortBy"
              :sort-desc.sync="sortDesc"
              :search="search"
              :custom-filter="customSearch"
              :items-per-page="30"
              :header-props="headerProps"
              :footer-props="{
                'items-per-page-options': [10, 20, 30, 40, 50, 100],
                'items-per-page-text':'Ediciones por página',
              }"
              mobile="true"
            >
              <template v-slot:item.published="{ item }">
                <td class="text-center">{{ item.published==1?'Publicado':'No Publicado' }}</td>
              </template>
              <template v-slot:item.actions="{ item }">
                <td class="text-center">
                  <v-btn
                    class="mx-2"
                    fab
                    dark
                    x-small
                    color="info"
                    @click="entrepreneurshipsEdition(item.id)"
                  >
                    <v-icon dark small>
                      mdi-format-list-bulleted
                    </v-icon>
                  </v-btn>

                  <v-btn
                    class="mx-2"
                    fab
                    dark
                    x-small
                    color="primary"
                    @click="showEdition(item.id)"
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
                    @click="editEdition(item.id)"
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
                    @click="confirmDeleteEdition(item.id)"
                  >
                    <v-icon dark small>
                      mdi-close
                    </v-icon>
                  </v-btn>
                </td>
              </template>
            </v-data-table>

          </v-col>
        </v-row>
      </v-sheet>

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
        v-model="dialog"
        width="500"
      >
        <v-card>
          <v-card-title class="text-h6">
            NUEVA EDICIÓN
          </v-card-title>

          <v-card-text class="pa-8">
            <v-text-field label="Nombre" v-model="name"></v-text-field>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              text
              @click="dialog=!dialog"
            >
              Cerrar
            </v-btn>
            <v-btn
              color="primary"
              text
              :disabled="!name"
              @click="createEdition"
            >
              Continuar
            </v-btn>
          </v-card-actions>
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
            ¿Está seguro que desea borrar esta edición? Toda la información
            vinculada a los emprendimientos y emprendedores se borrara tambíen.
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
              @click="deleteEdition"
            >
              Borrar
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

    </v-col>
  </v-row>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'Editions',

    data: () => ({
      loading:true,
      show:false,
      
      dialog:false,
      dialog_delete:false,
      delete_id:null,
      name:'',

      Edition:false,

      editions:[],

      search: '',
      sortBy: 'id',
      sortDesc: true,
      headerProps: {
        sortByText: "Ordenar por"
      },
      headers: [
        {
          text: 'Edición',
          align: 'start',
          sortable: true,
          value: 'name',
          width: '55%'
        },
        {
          text: 'Estado',
          align: 'center',
          sortable: true,
          value: 'published',
          width: '20%'
        },
        {
          text: 'Acciones',
          align: 'center',
          sortable: false,
          value: 'actions',
          width: '25%'
        }
      ],

      search2: '',
      headers2: [
        {
          text: 'Edición',
          align: 'start',
          filterable: false,
          value: 'name',
          width: '55%'
        },
        { text: 'Estado', value: 'published', width: '20%' },
        { text: 'Acciones', value: 'actions', width: '25%' },
      ],
      attrs: {
        boilerplate: false,
      },
    }),

    methods:{
      customSearch (value, search, item) {
          return Object.values(item).some(v=>v&&v.toString().toLowerCase().includes(search))
      },
      
      filterOnlyCapsText (value, search, item) {
        console.log(item)
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().toLocaleUpperCase().indexOf(search) !== -1
      },

      async getEditions()
      {
        await axios.get('admin/editions').then(response =>{
          this.editions = response.data
          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error);
        })
      },

      newEdition()
      {
        this.name = ''

        this.dialog = true
      },

      async createEdition()
      {
        try {
          await axios.post('admin/editions',{
            name: this.name, 
            pre_incubation: false, 
            incubation: false, 
            pre_aceleration: false
            }).then(response =>{
              this.$router.push({ name: 'editEdition', params: { edition_id: response.data.edition.id } })  
            })
          } catch (error) {
            console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
          }
      },

      showEdition(id)
      {
        this.$router.push({ name: 'showEdition', params: { edition_id: id } })
      },

      entrepreneurshipsEdition(id)
      {
        this.$router.push({ name: 'entrepreneurshipsEdition', params: { edition_id: id } })
      },

      editEdition(id)
      {
        this.$router.push({ name: 'editEdition', params: { edition_id: id } })
      },

      confirmDeleteEdition(id)
      {
        this.dialog_delete = true
        this.delete_id = id
      },

      async deleteEdition()
      {
        this.dialog_delete = false
        try {
          this.loading=true
          await axios.delete('admin/editions/'+this.delete_id).then(() =>{
            this.getEditions()
            this.delete_id = null
          })
        } catch (error) {
          console.error(error.response.data);
        }
      }

    },

    created(){
      this.getEditions()
    },
  }
</script>
