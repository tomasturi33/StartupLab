<template>
  <v-row>
    <v-col cols="12" class="d-flex justify-center">
      <v-btn
        large
        :block="btn_block"
        color="primary"
        @click="showNotes()">
        Notas
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
      v-model="dialog_notes"
      scrollable
      max-width="540px"
      >
      <v-card>
        <v-card-title>
          Notas
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            small
            :disabled="dialog_add_note"
            @click="dialog_add_note = true"
          >
            <v-icon small>mdi-plus</v-icon>
            Nota
          </v-btn>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text style="height: 70vh;">

          <v-sheet 
            outlined 
            v-if="dialog_add_note"
            color="yellow lighten-3"
            class="mt-4">
            <v-row class="pa-4">
              <v-col cols="12">
                <v-textarea
                  outlined
                  name="input-7-4"
                  label="Nueva nota"
                  v-model="note"
                  :maxlength="1000"
                  :counter="1000"
                ></v-textarea>

                <v-row>
                  <v-btn
                    color="blue darken-1"
                    text
                    small
                    :loading="loading_notes"
                    :disabled="!note"
                    @click="addNote()"
                  >
                    Guardar
                  </v-btn>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="blue darken-1"
                    text
                    small
                    @click="dialog_add_note = false"
                  >
                    Cerrar
                  </v-btn>
                </v-row>
              </v-col>
            </v-row>
          </v-sheet>

          <v-sheet 
            outlined
            color="yellow lighten-3"
            class="mt-4"
            v-for="note in notes" v-bind:key="note.id">
            <v-row class="pa-4">
              <v-col cols="12">
                <v-row class="pa-3">
                  <b>{{ note.user.name+ ' ' + note.user.lastname }}:</b>
                  <v-spacer></v-spacer>
                  {{ note.hour }} - {{ note.date }} 
                  &nbsp;
                  <v-icon @click="showDialogDelete(note.id)">
                    mdi-close
                  </v-icon>

                </v-row>
                
                <p class="text pt-3">
                  {{ note.note }}
                </p>

              </v-col>
            </v-row>
          </v-sheet>

        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog_notes = false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_confirm_delete"
      max-width="340"
    >
      <v-card>
        <v-card-title class="text-h5">
          Advertencia
        </v-card-title>

        <v-card-text>
          ¿Está seguro que desea eliminar esta nota? Una vez eliminada, no podrá recuperarse. 
        </v-card-text>

        <v-card-actions>
          <v-btn
            color="error darken-1"
            text
            :loading="loading_delete"
            @click="deleteNote()"
          >
            Eliminar
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            color="primary darken-1"
            text
            @click="dialog_confirm_delete = false"
          >
            cancerlar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-row>
</template>
<script>
  import axios from 'axios'

  export default {
    name: 'showTeamAccepted',
    props:['entrepreneurship_id', 'btn_block'],
    data: () => ({
      loading:false,
      loading_notes:false,
      loading_delete:false,
      dialog_notes:false,
      dialog_add_note:false,

      delete_id:null,
      dialog_confirm_delete:false,

      notes:[],
      note:''
    }),

    methods:{
      async getNotes(){
        await axios.get('other/notes/'+this.entrepreneurship_id).then(response =>{
          this.notes = response.data.data.notes
          this.dialog_add_note=false
          this.loading_notes = false
          this.note=null
        }).catch(error => {
          console.log(error)
        })
      },

      async showNotes(){
        this.loading = true
        this.dialog_add_note = false
        await axios.get('other/notes/'+this.entrepreneurship_id).then(response =>{
          this.notes = response.data.data.notes
          this.loading = false
          this.dialog_notes = true
        }).catch(error => {
          console.log(error)
          this.loading = false
          alert(error)
        })
      },

      async addNote(){
        try {
          this.loading_notes = true
          await axios.post('other/notes/'+this.entrepreneurship_id,{
            note: this.note,
            entrepreneurship_id: this.entrepreneurship_id
            }).then(() =>{
              this.getNotes()
            })
          } catch (error) {
            console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
          }
      },

      async showDialogDelete(id){
        this.delete_id = id
        this.dialog_confirm_delete = true
      },

      async deleteNote(){
        try {
          this.loading_delete = true
          await axios.delete('other/notes/'+this.delete_id).then(() =>{
            this.getNotes()
            this.dialog_confirm_delete=false
            this.loading_delete = false
            this.delete_id = null
          })
        } catch (error) {
          console.error(error.response.data);
        }
      }

    }
  }
</script>