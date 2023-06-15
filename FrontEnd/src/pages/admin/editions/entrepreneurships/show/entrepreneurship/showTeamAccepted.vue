<template>
  <v-row>
    <template v-if="!loading">
      <v-col cols="12">
        <v-sheet
          outlined 
        >
          <v-row>
            <v-col cols="12">
              <v-simple-table>
                <thead>
                  <tr>
                    <th class="text-center" width="10%">
                      <b>ID</b>
                    </th>
                    <th width="35%">
                      <b>Correo Electrónico</b>
                    </th>
                    <th width="35%">
                      <b>Emprendedor</b>
                    </th>
                    <th class="text-center" width="10%">
                      <b>Estado</b>
                    </th>
                    <th class="text-center" width="10%">
                      <b>Acciones</b>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="item in team"
                    :key="item.id"
                  >
                    <td class="text-center">{{ item.id }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.name + ' ' + item.lastname }}</td>
                    <td class="text-center">{{ item.status==1?'Completo':'Incompleto' }}</td>
                    <td class="text-center">

                      <v-btn
                        class="mx-2"
                        fab
                        dark
                        x-small
                        color="primary"
                        @click="showMember(item.id)"
                      >
                        <v-icon dark small>
                          mdi-eye
                        </v-icon>
                      </v-btn>
                    </td>
                  </tr>
                </tbody>
              </v-simple-table>

            </v-col>
          </v-row>
        </v-sheet>
      </v-col>
    </template>

    <v-col cols="12" class="pt-8 d-flex justify-space-between">
      <v-btn
        depressed
        :block="$vuetify.breakpoint.xsOnly"
        color="primary"
        :to="{ name: 'showEntrepreneurshipsEdition', params: { edition_id : this.edition_id }}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>
    </v-col>
    
    <v-dialog
      v-model="dialog_show"
      max-width="750px">
      <v-card>
        <v-card-title>
          <span class="text-h5">Emprendedor</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>   
              <template v-if="entrepreneur.status===0">
                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="4" sm="4" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Apellido:</b></p>
                    </v-col>
                    <v-col cols="12" md="8" sm="8" class="pb-0 pt-0">
                      {{ entrepreneur.lastname }}
                    </v-col>
                  </v-row>
                </v-col>
                  
                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="4" sm="4" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Nombre:</b></p>
                    </v-col>
                    <v-col cols="12" md="8" sm="8" class="pb-0 pt-0">
                      {{ entrepreneur.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="4" sm="4" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Correo electrónico:</b></p>
                    </v-col>
                    <v-col cols="12" md="8" sm="8" class="pb-0 pt-0">
                      {{ entrepreneur.email }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="4" sm="4" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Estado:</b></p>
                    </v-col>
                    <v-col cols="12" md="8" sm="8" class="pb-0 pt-0">
                      el perfíl se encuentra incompleto
                    </v-col>
                  </v-row>
                </v-col>
              </template>

              <template v-if="entrepreneur.status===1">
                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Apellido:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.lastname }}
                    </v-col>
                  </v-row>
                </v-col>
                  
                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Nombre:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Correo electrónico:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.email }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Numero de teléfono:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.phone_number }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-divider></v-divider>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Pais:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.country }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Provincia:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.provincia.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Localidad:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.localidad.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-divider></v-divider>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Estudios:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.completed_studie.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <template v-if="entrepreneur.completed_studie_id===1||entrepreneur.completed_studie_id===2">

                  <v-col cols="12" xl="6" md="6" sm="12">
                    <v-row  class="pb-1 pt-1">
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        <p class="text-lg-right text-sm-left"><b>Institución:</b></p>
                      </v-col>
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        {{ entrepreneur.secundary_tertiary_institute }}
                      </v-col>
                    </v-row>
                  </v-col>

                  <v-col cols="12" xl="6" md="6" sm="12">
                    <v-row  class="pb-1 pt-1">
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        <p class="text-lg-right text-sm-left"><b>Carrera:</b></p>
                      </v-col>
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        {{ entrepreneur.secundary_tertiary_career }}
                      </v-col>
                    </v-row>
                  </v-col>

                </template>

                <template v-if="entrepreneur.completed_studie_id===3">

                  <template v-if="entrepreneur.university==='unl'">
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Universidad:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          Universidad Nacional del Litoral
                        </v-col>
                      </v-row>
                    </v-col>
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Unidad Academica:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.academic_unit.name }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Carrera:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.career.name }}
                        </v-col>
                      </v-row>
                    </v-col>
                  </template>

                  <template v-if="entrepreneur.university==='otro'">
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Universidad:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.other_university }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Carrera:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.other_career }}
                        </v-col>
                      </v-row>
                    </v-col>
                  </template>

                </template>

                <template v-if="entrepreneur.completed_studie_id===4">

                  <template v-if="entrepreneur.university==='unl'">
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Universidad:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          Universidad Nacional del Litoral
                        </v-col>
                      </v-row>
                    </v-col>
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Unidad Academica:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.academic_unit.name }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Carrera:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.career.name }}
                        </v-col>
                      </v-row>
                    </v-col>
                  </template>

                  <template v-if="entrepreneur.university==='otro'">
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Universidad:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.other_university }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Carrera:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.other_career }}
                        </v-col>
                      </v-row>
                    </v-col>
                  </template>

                </template>

                <template v-if="entrepreneur.posgrade">
                  <v-col cols="12">
                    <v-divider></v-divider>
                  </v-col>

                  <v-col cols="12" xl="6" md="6" sm="12">
                    <v-row  class="pb-1 pt-1">
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        <p class="text-lg-right text-sm-left"><b>Estudios de posgrado:</b></p>
                      </v-col>
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        Si
                      </v-col>
                    </v-row>
                  </v-col>

                  <v-col cols="12" xl="6" md="6" sm="12">
                    <v-row  class="pb-1 pt-1">
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        <p class="text-lg-right text-sm-left"><b>Institución:</b></p>
                      </v-col>
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        {{ entrepreneur.posgrade_institute }}
                      </v-col>
                    </v-row>
                  </v-col>

                  <v-col cols="12" xl="6" md="6" sm="12">
                    <v-row  class="pb-1 pt-1">
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        <p class="text-lg-right text-sm-left"><b>Posgrado:</b></p>
                      </v-col>
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        {{ entrepreneur.posgrade_career }}
                      </v-col>
                    </v-row>
                  </v-col>

                </template>

                <v-col cols="12">
                  <v-divider></v-divider>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="3" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Ocupación:</b></p>
                    </v-col>
                    <v-col cols="12" md="9" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.occupation }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="3" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Experiencia previa:</b></p>
                    </v-col>
                    <v-col cols="12" md="9" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.previous_experience }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Linkedin:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.linkedin }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>CV:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.cv }}
                    </v-col>
                  </v-row>
                </v-col>
              </template>
              
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog_show = false"
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

  </v-row>
</template>
<script>
  import axios from 'axios'

  export default {
    name: 'showTeamAccepted',

    data: () => ({
      loading:true,
      dialog_show:false,
      edition_id:null,
      entrepreneurship_id:null,
      convocation_form_id:null,

      team:[],
      entrepreneur:[],
    }),

    methods:{
      async getTeam(){
        await axios.get('admin/edition/'+this.edition_id+'/team/'+this.convocation_form_id).then(response =>{
          this.team = response.data.team
          this.loading=false
        }).catch(error => {
          console.log(error)
        })
      },

      showMember(id){
        this.entrepreneur = this.team.find(function(element) {
          return element.id==id
        });

        this.dialog_show = true
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id
      this.entrepreneurship_id = this.$route.params.entrepreneurship_id
      this.convocation_form_id = this.$route.params.convocation_form_id

      this.getTeam()
    }
  }
</script>