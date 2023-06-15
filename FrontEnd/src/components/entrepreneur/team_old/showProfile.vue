<template>
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

              </template>

              <v-col cols="12">
                {{ entrepreneurial_profile }}
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
</template>

<script>

  export default {
    name: 'showProfile',

    props:['entrepreneurial_profile', 'dialog_show'],
    
    data: () => ({

    }),

  }
</script>