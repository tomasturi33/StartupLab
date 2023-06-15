<template>
  <v-container class="no-gutters">
    <v-row class="text-center">

      <v-col class="pa-4">
        <v-hover>
          <template v-slot:default="{ hover }">
            <v-card
              class="mx-auto rounded-xl"
              max-width="280"
            >
              <v-img :src="require('@/assets/icons/upload_idea.png')"></v-img>

              <v-fade-transition>
                <v-overlay
                  v-if="hover"
                  absolute
                  color="#036358"
                >
                  <v-btn
                    :to="{name: 'my-idea'}">
                    Ver más
                  </v-btn>
                </v-overlay>
              </v-fade-transition>
            </v-card>
          </template>
        </v-hover>
      </v-col>

      <v-col class="pa-4">
        <v-hover>
          <template v-slot:default="{ hover }">
            <v-card
              class="mx-auto rounded-xl"
              max-width="280"
            >
              <v-img :src="require('@/assets/icons/upload_team.png')"></v-img>

              <v-fade-transition>
                <v-overlay
                  v-if="hover"
                  absolute
                  color="#036358"
                >
                  <v-btn
                    :to="{name: 'myTeam'}">
                    Ver más
                  </v-btn>
                </v-overlay>
              </v-fade-transition>
            </v-card>
          </template>
        </v-hover>
      </v-col>

      <v-col class="pa-4">
        <v-hover>
          <template v-slot:default="{ hover }">
            <v-card
              class="mx-auto rounded-xl"
              max-width="280"
            >
              <v-img :src="require('@/assets/icons/send.png')"></v-img>

              <v-fade-transition>
                <v-overlay
                  v-if="hover"
                  absolute
                  color="#036358"
                >
                  <v-btn
                    @click="send">
                    Enviar
                  </v-btn>
                </v-overlay>
              </v-fade-transition>
            </v-card>
          </template>
        </v-hover>
      </v-col>
    </v-row>

    <v-dialog
      v-model="dialog"
      overlay
      persistent
      width="300"
    >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          <label>Validando información...</label>
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_error"
      width="500"
    >
      <v-card>
        <v-card-title class="text-h5 lighten-2">
          Formulario convocatoria
        </v-card-title>

        <v-card-text class="pt-4 pb-6">
          Se encontraron campos vacios. Por favor complete todo el formulario antes de enviarlo.
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_error = false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_confirm"
      width="500"
    >
      <v-card>
        <v-card-title class="text-h5 lighten-2">
          Atención 
        </v-card-title>

        <v-card-text class="pt-4 pb-6">
          Estás a punto de enviar de forma definitiva la postulación. 
          Una vez que lo envíes no se podrá modificar el formulario ni 
          ningún dato de los integrantes del equipo.
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_confirm = false"
          >
            Cancelar
          </v-btn>
          <v-btn
            color="primary"
            text
            @click="sendIdea"
          >
            Enviar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_convocation_close"
      width="500"
    >
      <v-card>
        <v-card-title class="text-h5 lighten-2">
          Atención 
        </v-card-title>

        <v-card-text class="pt-4 pb-6">
          La convocatoria ya se encuentra cerrada. Para consultas comunicarse a potencia@unl.edu.ar 
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog_convocation_close = false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-container>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'

  export default {
    name: 'convocationInProgress',
    data: () => ({
      show: false,
      dialog: false,
      dialog_confirm:false,
      dialog_convocation_close:false,
      dialog_error: false,
      loading:true,

      edition_in_progress:true,

      time_left:null,
      end: null,
      
      id: null,
      title:'',
      executive_summary:'',
      problem_detected:'',
      proposed_solution:'',
      products_services_you_offer:'',
      entrepreneurial_team:'',
      market:'',
      action_plan:'',
      entrepreneurship_stadia_id:null,
      development_degrees_id:null,
      provincia_id:null,
      localidad_id:null,
      editions:null
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form'
      ])
    },
    methods:{
      async getStatus(){
        await axios.get('convocation/status/'+this.convocation_form.id).then((response) =>{
          this.state_convocation_form=response.data.status;
          this.loading=false;
        }).catch(error => {
          console.log(error);
        })
      },

      send(){
        this.dialog=true
        this.getMyIdea().then(() =>{
          this.dialog=false
          if(this.validateForm()){
            this.dialog_confirm = true
          }else{
            this.dialog = false;
            this.dialog_error = true;
          }
        })
      },

      async sendIdea(){
        try {
          this.dialog_confirm = false
          await axios.put('convocation/send-idea/'+this.id,{
              title: this.title,
              executive_summary: this.executive_summary,
              problem_detected: this.problem_detected,
              proposed_solution: this.proposed_solution,
              products_services_you_offer: this.products_services_you_offer,
              market: this.market,
              action_plan: this.action_plan,
            }).then(() =>{
              this.$router.push({ name: 'home'})
            })
          } catch (error) {
            console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
          }
      },

      async getInfoEdition(){
        let edition = this.convocation_form.convocation_form.edition_id

        await axios.get('edition/'+edition).then(response =>{
          this.edition = response.data.edition

          let aux = this.edition.finish_date+'T'+this.edition.finish_time
          this.end = new Date(aux)

          const date = new Date();

          let day = date.getDate();
          let month = date.getMonth() + 1;
          let year = date.getFullYear();

          // This arrangement can be altered based on how we want the date's format to appear.
          let currentDate = `${year}-${month}-${day}`;

          let date1Updated = new Date(currentDate.replace(/-/g,'/'));  
          let date2Updated = new Date(this.edition.finish_date.replace(/-/g,'/'));
          
          if(date1Updated > date2Updated){
            this.edition_in_progress=false
          }

          this.show=true

        }).catch(error => {
          console.log(error);
        })
      },

      validateForm(){
        if( this.title!=null && 
            this.executive_summary!=null && 
            this.problem_detected!=null && 
            this.proposed_solution!=null && 
            this.products_services_you_offer!=null && 
            this.entrepreneurial_team!=null &&
            this.market!=null && 
            this.action_plan!=null &&
            
            this.entrepreneurship_stadia_id!=null &&
            this.development_degrees_id!=null &&

            this.provincia_id!=null &&
            this.localidad_id!=null){
          return true
        }
        return false
      },

      async getMyIdea(){
        await axios.get('convocation/'+this.convocation_form.convocation_form.id).then(response =>{
          this.id = response.data.convocation.id
          this.title = response.data.convocation.title
          this.executive_summary = response.data.convocation.executive_summary
          this.problem_detected = response.data.convocation.problem_detected
          this.proposed_solution = response.data.convocation.proposed_solution
          this.products_services_you_offer = response.data.convocation.products_services_you_offer
          this.entrepreneurial_team = response.data.convocation.entrepreneurial_team
          this.market = response.data.convocation.market
          this.action_plan = response.data.convocation.action_plan
          this.entrepreneurship_stadia_id = response.data.convocation.entrepreneurship_stadia_id
          this.development_degrees_id = response.data.convocation.development_degrees_id
          this.provincia_id = response.data.convocation.provincia_id
          this.localidad_id = response.data.convocation.localidad_id
        }).catch(error => {
          console.log(error);
        })
      },
    },

    created(){
      this.getInfoEdition();
    },
  }
</script>