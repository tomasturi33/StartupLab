<template>
  <v-row>
    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row>

          <v-col cols="12" class="ma-4">
            <v-btn 
              :to="{ name: 'newModule' }"
              color="primary">
              Nuevo modulo
            </v-btn>
          </v-col>

          <v-col cols="12">
            <v-simple-table>
              <template v-slot:default>
                <thead>
                  <tr>
                    <th class="text-center" width="10%">
                      Orden
                    </th>
                    <th class="text-center" width="50%">
                      Modulo
                    </th>
                    <th class="text-center" width="40%">
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="item in module_pre_incubations"
                    :key="item.id"
                  >
                    <td class="text-center">{{ item.order }}</td>
                    <td>{{ item.name }}</td>
                    <td class="text-center">
                      <v-btn
                        class="mx-2"
                        fab
                        dark
                        x-small
                        outlined
                        color="black"
                        @click="moveUp(item.id)"
                      >
                        <v-icon dark small>
                          mdi-arrow-up
                        </v-icon>
                      </v-btn>
                      <v-btn
                        class="mx-2"
                        fab
                        dark
                        x-small
                        outlined
                        color="black"
                        @click="moveDown(item.id)"
                      >
                        <v-icon dark small>
                          mdi-arrow-down
                        </v-icon>
                      </v-btn>

                      <v-btn
                        class="mx-2"
                        fab
                        dark
                        x-small
                        color="primary"
                        @click="showModule(item.id)"
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
                        color="info"
                        @click="pills(item.id)"
                      >
                        <v-icon small>
                          mdi-pill
                        </v-icon>
                      </v-btn>

                      <v-btn
                        class="mx-2"
                        fab
                        dark
                        x-small
                        color="warning"
                        @click="editModule(item.id)"
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
                        @click="confirmDeleteModule(item.id)"
                      >
                        <v-icon dark small>
                          mdi-close
                        </v-icon>
                      </v-btn>
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>
    <v-col cols="12" class="pt-8 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        @click="previousPage"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>
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

    <v-dialog
        v-model="dialog_delete"
        width="500"
      >
        <v-card>
          <v-card-title class="text-h5 lighten-2">
            Atención 
          </v-card-title>

          <v-card-text class="pt-4 pb-6">
            ¿Está seguro que desea borrar esté modulo? Toda la información
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
              @click="deleteModule"
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
    name: 'preIncuvation',

    data: () => ({
      loading:true,
      show:false,
      edition_id:null,

      dialog_delete:null,
      delete_id:null,

      module_pre_incubations:null,
    }),

    methods:{
      async moveUp(id){
        this.loading = true
        try{
          await axios.put('admin/modules-pre-incubation/move-up/'+id, {
            edition_id: this.edition_id
          }).then(()=>{
            this.getPreIncuvationModules()
          })
        }catch(error) {
          this.loading = false
          console.log(error)
        }
      },

      async moveDown(id){
        this.loading = true
        try{
          await axios.put('admin/modules-pre-incubation/move-down/'+id, {
            edition_id: this.edition_id
          }).then(()=>{
            this.getPreIncuvationModules()
          })
        }catch(error) {
          this.loading = false
          console.log(error)
        }
      },

      async getPreIncuvationModules(){
        await axios.get('admin/editions/'+this.edition_id).then(response =>{
          this.module_pre_incubations = response.data.edition.module_pre_incubations
          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error);
        })
      },

      dateConvert(date){
        const parts = date.split(/[- :]/);
        return `${parts[2]}/${parts[1]}/${parts[0]} ${parts[3]}:${parts[4]}`;
      },

      pills(id){
        this.$router.push({ name: 'pills', params: { edition_id: this.edition_id, module_id:id } })
      },

      showModule(id){
        this.$router.push({ name: 'showModule', params: { id_module: id } })
      },

      editModule(id_moduele){
        this.$router.push({ name: 'editModule', params: { id_module: id_moduele } })
      },

      confirmDeleteModule(id){
        this.dialog_delete = true
        this.delete_id = id
      },

      async deleteModule(){
        this.dialog_delete = false
        try {
          this.loading=true
          await axios.delete('admin/modules/'+this.delete_id).then(() =>{
            this.getPreIncuvationModules()
            this.delete_id = null
          })
        } catch (error) {
          console.error(error.response.data);
        }
      },

      previousPage(){
        this.$router.push({ name: 'editEdition', params: { edition_id: this.edition_id } })
      },
    },

    created(){
      this.edition_id = this.$route.params.edition_id
      this.getPreIncuvationModules()
    },
  }
</script>