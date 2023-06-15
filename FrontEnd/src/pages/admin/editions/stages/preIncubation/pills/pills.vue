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
              :to="{ name: 'newPill', params:{ edition_id: this.edition_id, module_id: this.module_id} }"
              color="primary">
              Nueva Pildora
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
                      Pildora
                    </th>
                    <th class="text-center" width="40%">
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="item in pills"
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
                        @click="showPill(item.id)"
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
                        @click="editPill(item.id)"
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
                        @click="confirmDeletePill(item.id)"
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
    <v-col cols="12" class="pt-2 d-flex justify-space-between">
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
            ¿Está seguro que desea borrar esta pildora? Toda la información
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
              @click="deletePill"
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
    name: 'pills',

    data: () => ({
      loading:true,
      show:false,
      edition_id:null,
      module_id:null,

      dialog_delete:false,
      delete_id:null,

      pills:[],
    }),

    methods:{
      async moveUp(id){
        this.loading = true
        try{
          await axios.put('admin/pills/move-up/'+id, {
            edition_id: this.edition_id
          }).then(()=>{
            this.getPillsModule()
          })
        }catch(error) {
          this.loading = false
          console.log(error)
        }
      },

      async moveDown(id){
        this.loading = true
        try{
          await axios.put('admin/pills/move-down/'+id, {
            edition_id: this.edition_id
          }).then(()=>{
            this.getPillsModule()
          })
        }catch(error) {
          this.loading = false
          console.log(error)
        }
      },

      async getPillsModule(){
        await axios.get('admin/pills/'+this.module_id+'/module').then(response =>{
          this.pills = response.data.pills
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

      showPill(id){
        this.$router.push({ name: 'showPill', params: { pill_id: id } })
      },

      editPill(id){
        this.$router.push({ name: 'editPill', params: { pill_id: id } })
      },

      confirmDeletePill(id){
        this.dialog_delete = true
        this.delete_id = id
      },

      async deletePill(){
        this.dialog_delete = false
        try {
          this.loading=true
          await axios.delete('admin/pills/'+this.delete_id).then(() =>{
            this.getPillsModule()
            this.delete_id = null
          })
        } catch (error) {
          console.error(error.response.data);
        }
      },

      previousPage(){
        this.$router.push({ name: 'modules', params: { edition_id: this.edition_id } })
      },
    },

    created(){
      this.edition_id = this.$route.params.edition_id
      this.module_id = this.$route.params.module_id

      this.getPillsModule()
    },
  }
</script>
<style scoped>
  
</style>
