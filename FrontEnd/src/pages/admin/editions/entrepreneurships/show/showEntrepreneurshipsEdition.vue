<template>
  <v-row>
    <template v-if="show">
      <v-col cols="12">
        <v-sheet
          width="100%"
          outlined 
        >
          <v-row class="pa-4">
            <v-col cols="12">
              <label class="font-weight-bold text-uppercase">
                StartUp:
              </label>
              <label class="font-weight-regular">
                {{ entrepreneurship.title }}
              </label>
            </v-col>

            <v-col cols="12" xl="6" md="6" sm="12">
              <v-btn
                large
                block
                color="primary"
                :to="{name: 'showConvocationFormAccepted', params: { convocation_form_id: entrepreneurship.convocation_form_id }}"
                >
                Formulario de convocatoria
              </v-btn>
            </v-col>

            <v-col cols="12" xl="6" md="6" sm="12">
              <v-btn
                large
                block
                color="primary"
                :to="{name: 'showEntrepreneurshipAccepted'}">
                StartUp
              </v-btn>
            </v-col>

            <v-col cols="12" xl="6" md="6" sm="12">
              <v-btn
                large
                block
                color="primary"
                :to="{name: 'showTeamAccepted', params: { convocation_form_id: entrepreneurship.convocation_form_id }}">
                Integrantes
              </v-btn>
            </v-col>

            <v-col cols="12" xl="6" md="6" sm="12">
              <v-btn
                large
                block
                color="primary"
                :to="{name: 'showWindowAccepted', params: { convocation_form_id: entrepreneurship.convocation_form_id }}">
                Vidriera
              </v-btn>
            </v-col>
            
          </v-row>
        </v-sheet>
      </v-col>

      <v-col cols="12">
        <v-sheet
          width="100%"
          outlined 
        >
          <v-row class="pa-4">
            <v-col cols="12">
              <label class="font-weight-regular text-uppercase">
                Estadios
              </label>
            </v-col>

            <v-col cols="12" xl="4" md="4" sm="12">
              <v-btn
                large
                block
                color="primary"
                :to="{name: 'showModulesPreIncubations' }">
                Pre Incubación
              </v-btn>
            </v-col>

            <v-col cols="12" xl="4" md="4" sm="12">
              <v-btn
                large
                block
                disabled
                color="primary">
                Incubación
              </v-btn>
            </v-col>

            <v-col cols="12" xl="4" md="4" sm="12">
              <v-btn
                large
                block
                disabled
                color="primary">
                Pre Aceleración
              </v-btn>
            </v-col>
            
          </v-row>
        </v-sheet>
      </v-col>

      <v-col cols="12">
        <v-sheet
          width="100%"
          outlined 
        >
          <v-row class="pa-4">
            <v-col cols="12">
              <label class="font-weight-regular text-uppercase">
                Notas
              </label>
            </v-col>

            <v-col cols="12">
              <v-row class="d-flex justify-center">
                <v-col cols="12" xl="4" md="4" sm="12" class="d-flex justify-center">
                  <notes 
                    :entrepreneurship_id="entrepreneurship.id" 
                    :btn_block="false" 
                  />
                </v-col>
              </v-row>
              
            </v-col>

          </v-row>
        </v-sheet>
      </v-col>
    </template>

    <v-col cols="12" class="d-sm-flex pt-8">
      <v-btn
        :block="$vuetify.breakpoint.xsOnly"
        class="mr-auto mt-2"
        depressed
        color="primary"
        :to="{ name: 'entrepreneurshipsEdition', params: { id: this.edition_id }}">
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
  </v-row>
</template>
<script>
  import axios from 'axios'
  import notes from '@/components/notes/notes.vue'

  export default {
    name: 'showEntrepreneurshipsEdition',
    components: {
      notes
    },
    data: () => ({
      show:false,

      loading:true,
      loading_notes:false,
      loading_delete:false,

      dialog_notes:false,
      dialog_add_note:false,
      dialog_confirm_delete: false,

      edition_id:null,
      entrepreneurship_id:null,

      entrepreneurship:[],
      notes:[],
      note:null,

      delete_id:null
    }),

    methods:{
      async getEntrepreneurship(){
        await axios.get('admin/edition/'+this.edition_id+'/entrepreneurships/'+this.entrepreneurship_id).then(response =>{
          this.entrepreneurship = response.data.entrepreneurship
          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error)
        })
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id
      this.entrepreneurship_id = this.$route.params.entrepreneurship_id
      this.getEntrepreneurship()
      },
  }
</script>