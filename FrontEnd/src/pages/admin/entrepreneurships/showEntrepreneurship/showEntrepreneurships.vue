<template>
  <v-row>

    <template v-if="!loading">
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
                :to="{name: 'showEntrepreneurshipsConvocationForm', params: { id: entrepreneurship.id }}"
                >
                Formulario de convocatoria
              </v-btn>
            </v-col>

            <v-col cols="12" xl="6" md="6" sm="12">
              <v-btn
                large
                block
                color="primary"
                :to="{name: 'showEntrepreneurshipsStartup', params: { id: entrepreneurship.id }}">
                StartUp
              </v-btn>
            </v-col>

            <v-col cols="12" xl="6" md="6" sm="12">
              <v-btn
                large
                block
                color="primary"
                :to="{name: 'showEntrepreneurshipsTeam', params: { id: entrepreneurship.id }}">
                Integrantes
              </v-btn>
            </v-col>

            <v-col cols="12" xl="6" md="6" sm="12">
              <v-btn
                large
                block
                color="primary"
                :to="{ name: 'showEntrepreneurshipsWindow', params: { id: entrepreneurship.id } }">
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
                disabled
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
        :to="{ name: 'entrepreneurships' }">
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
  import download from 'downloadjs'
  import notes from '@/components/notes/notes.vue'
  const VUE_URL_API = process.env.VUE_APP_URL_API


  export default {
    name: 'showEntrepreneurships',
    components: {
      notes
    },
    data: () => ({
      loading:true,
      loading_download: false,
      edition_id:null,
      entrepreneurship_id:null,

      entrepreneurship:null,

      attrs: {
        boilerplate: false,
      },
    }),

    methods:{
      async getEntrepreneurship(){
        await axios.get('admin/entrepreneurships/'+this.entrepreneurship_id).then(response =>{
          this.entrepreneurship = response.data.entrepreneurship
          this.loading=false
        }).catch(error => {
          console.log(error)
        })
      },

      async downloadPDF(){
        this.loading_download=true

        this.url = VUE_URL_API + '/admin/edition/'+this.edition_id+'/entrepreneurships/'+this.entrepreneurship_id+'/generate-pdf'
        await axios.get(
          this.url, 
          {responseType: 'blob'}
        ).then((response) => {
          //window.open(URL.createObjectURL(response.data));
          const content = response.headers['content-type'];
          download(response.data, this.entrepreneurship.title , content)
          this.loading_download=false
        })
      },
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.entrepreneurship_id = this.$route.params.id;
      this.getEntrepreneurship()
      },
  }
</script>