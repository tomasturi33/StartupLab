<template>
  <v-row>

    <v-col 
      cols="12" 
      xl="4" 
      md="4" 
      sm="12"
      v-for="profile in entrepreneurial_profiles"
      :key="profile.id">

      <v-card
        color="#00a1b8"
        dark
      >
        <v-card-text class="text-h7 font-weight-regular white--text">
          <v-row>
            <v-col cols="4">
              <v-img
                class="mx-auto"
                :aspect-ratio="4/4"
                max-height="72"
                max-width="72"
                :src="require('@/assets/icons/users_white.png')"
              ></v-img>
            </v-col>
            <v-col cols="8" class="pt-4">
              {{ profile.name+' '+profile.lastname }}
              <br>
              {{ profile.email }}
              <br>
              <b>{{ (profile.status===0)?'Perfíl incompleto':'Perfíl completo' }}</b>
            </v-col>

            <v-col 
              v-if="user.user_id===profile.user_id"
              cols="6" 
              align="center">
              <v-btn
                block
                small
                primary
                outlined
                @click="showProfile(profile.id)">
                Ver
              </v-btn>
            </v-col>
            
            <v-col
              v-if="user.user_id===profile.user_id"
              cols="6" 
              align="center">
              <v-btn
                block
                small
                primary
                outlined
                :to="{name:'editProfile'}">
                Editar
              </v-btn>
            </v-col>

            <v-col 
              v-if="user.user_id!==profile.user_id"
              cols="12" 
              align="center">
              <v-btn
                block
                small
                primary
                outlined
                @click="showProfile(profile.id)">
                Ver
              </v-btn>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-col>

    <!--Dialog Show Loading para antes de morar el dialog-->
    <v-dialog
      v-model="loading_dialog"
      overlay
      persistent
      width="300"
    >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          {{ message }}
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <!--Dialog para mostrar el perfil del emprendedor-->
    <v-dialog
      v-model="dialog_show"
      max-width="750px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">Emprendedor</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>            
              <template v-if="entrepreneurial_profile.status===0">
                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="4" sm="4" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Apellido:</b></p>
                    </v-col>
                    <v-col cols="12" md="8" sm="8" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.lastname }}
                    </v-col>
                  </v-row>
                </v-col>
                  
                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="4" sm="4" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Nombre:</b></p>
                    </v-col>
                    <v-col cols="12" md="8" sm="8" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="4" sm="4" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Correo electrónico:</b></p>
                    </v-col>
                    <v-col cols="12" md="8" sm="8" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.email }}
                    </v-col>
                  </v-row>
                </v-col>
              </template>

              <template v-if="entrepreneurial_profile.status===1">
                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Apellido:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.lastname }}
                    </v-col>
                  </v-row>
                </v-col>
                  
                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Nombre:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>DNI:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.dni }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Género:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.gender.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Correo electrónico:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.email }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Numero de teléfono:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.phone_number }}
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
                      {{ entrepreneurial_profile.country }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Provincia:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.provincia.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Localidad:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.localidad.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Dirección legal:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.legal_address }}
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
                      {{ entrepreneurial_profile.completed_studie.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <template v-if="entrepreneurial_profile.completed_studie_id===1||entrepreneurial_profile.completed_studie_id===2">

                  <v-col cols="12" xl="6" md="6" sm="12">
                    <v-row  class="pb-1 pt-1">
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        <p class="text-lg-right text-sm-left"><b>Institución:</b></p>
                      </v-col>
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        {{ entrepreneurial_profile.secundary_tertiary_institute }}
                      </v-col>
                    </v-row>
                  </v-col>

                  <v-col cols="12" xl="6" md="6" sm="12">
                    <v-row  class="pb-1 pt-1">
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        <p class="text-lg-right text-sm-left"><b>Carrera:</b></p>
                      </v-col>
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        {{ entrepreneurial_profile.secundary_tertiary_career }}
                      </v-col>
                    </v-row>
                  </v-col>

                </template>

                <template v-if="entrepreneurial_profile.completed_studie_id===3">

                  <template v-if="entrepreneurial_profile.university==='unl'">
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
                          {{ entrepreneurial_profile.academic_unit.name }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Carrera:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneurial_profile.career.name }}
                        </v-col>
                      </v-row>
                    </v-col>
                  </template>

                  <template v-if="entrepreneurial_profile.university==='otro'">
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Universidad:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneurial_profile.other_university }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Carrera:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneurial_profile.other_career }}
                        </v-col>
                      </v-row>
                    </v-col>
                  </template>

                </template>

                <template v-if="entrepreneurial_profile.completed_studie_id===4">

                  <template v-if="entrepreneurial_profile.university==='unl'">
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
                          {{ entrepreneurial_profile.academic_unit.name }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Carrera:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneurial_profile.career.name }}
                        </v-col>
                      </v-row>
                    </v-col>
                  </template>

                  <template v-if="entrepreneurial_profile.university==='otro'">
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Universidad:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneurial_profile.other_university }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Carrera:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneurial_profile.other_career }}
                        </v-col>
                      </v-row>
                    </v-col>
                  </template>

                  <template v-if="entrepreneurial_profile.posgrade">

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
                          {{ entrepreneurial_profile.posgrade_institute }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Posgrado:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneurial_profile.posgrade_career }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12">
                      <v-divider></v-divider>
                    </v-col>
                  </template>

                  <v-col cols="12">
                    <v-row  class="pb-1 pt-1">
                      <v-col cols="12" md="3" sm="12" class="pb-0 pt-0">
                        <p class="text-lg-right text-sm-left"><b>Ocupación:</b></p>
                      </v-col>
                      <v-col cols="12" md="9" sm="12" class="pb-0 pt-0">
                        {{ entrepreneurial_profile.occupation }}
                      </v-col>
                    </v-row>
                  </v-col>

                  <template v-if="entrepreneurial_profile.occupation==='Investigador'">
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Donde:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneurial_profile.researcher_workplace }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Pertenece a Conicet:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneurial_profile.conicet }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Tipo de pertenencia:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneurial_profile.conicet_membership }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12">
                      <h4>La tecnología sobre la que está basada la startup:</h4>
                    </v-col>

                    <v-col cols="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" class="pb-0 pt-0" v-if="entrepreneurial_profile.is_protectable">
                          - Cuenta con resultados de investigación protegidos.
                        </v-col>

                        <v-col cols="12" class="pb-0 pt-0" v-if="!entrepreneurial_profile.is_protectable">
                          - No cuenta con resultados de investigación protegidos.
                        </v-col>



                        <v-col cols="12" class="pb-0 pt-0" v-if="entrepreneurial_profile.is_susceptible_protected">
                          - Cuenta con resultados de investigación susceptibles a ser protegidos.
                        </v-col>

                        <v-col cols="12" class="pb-0 pt-0" v-if="!entrepreneurial_profile.is_susceptible_protected">
                          - No cuenta con resultados de investigación susceptibles a ser protegidos.
                        </v-col>



                        <v-col cols="12" class="pb-0 pt-0" v-if="entrepreneurial_profile.have_statement_results">
                          - Cuenta con declaración de resultados.
                        </v-col>

                        <v-col cols="12" class="pb-0 pt-0" v-if="!entrepreneurial_profile.have_statement_results">
                          - No cuenta con declaración de resultados.
                        </v-col>
                      </v-row>
                    </v-col>

                  </template>
                </template>

                <v-col cols="12">
                  <v-divider></v-divider>
                </v-col>

                <v-col cols="12" v-if="entrepreneurial_profile.previous_experience">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="3" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Experiencia previa:</b></p>
                    </v-col>
                    <v-col cols="12" md="9" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.previous_experience }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" v-if="entrepreneurial_profile.linkedin">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="3" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Linkedin:</b></p>
                    </v-col>
                    <v-col cols="12" md="9" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.linkedin }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" v-if="entrepreneurial_profile.cv">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="3" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>CV:</b></p>
                    </v-col>
                    <v-col cols="12" md="9" sm="12" class="pb-0 pt-0">
                      {{ entrepreneurial_profile.cv }}
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

  </v-row>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'

  export default {
    name: 'responsibleProfile',
    data: () => ({
      loading_dialog:false,
      dialog_show:false,

      id: null,

      entrepreneurial_profile:[],

      entrepreneurial_profiles:[],

      user_id:null,
      convocation_form_id:null,

      error:'',
      errors:[],
    }),
    computed: {
      ...mapGetters([
        'user', 'convocation_form'
      ])
    },
    methods:{
      async getEntrepreneurialProfiles(){
        this.message = 'Cargando perfiles...'
        this.loading_dialog = true
        await axios.get('entrepreneurial-profiles/'+this.convocation_form.convocation_form.id).then(response =>{
          if(response.data.length!==0){
            this.entrepreneurial_profiles = response.data.entrepreneurial_profiles
            this.show=true
            this.loading_dialog = false
          }
          this.show = true
        }).catch(error => {
          console.log(error);
        })
      },

      async showProfile(id){
        this.message = 'Cargando perfíl...'
        this.loading_dialog = true
        await axios.get('entrepreneurial-profiles/'+this.convocation_form.convocation_form.id+'/show/'+id)
          .then(response =>{
            if(response.data.length!==0){
              this.entrepreneurial_profile = response.data.entrepreneurial_profile
              this.dialog_show = true
              this.loading_dialog = false
            }
            this.loading = false
            this.loading_dialog = false
        }).catch(error => {
          console.log(error);
        })
      }
    },

    created(){
      this.getEntrepreneurialProfiles()
    },
  }
</script>