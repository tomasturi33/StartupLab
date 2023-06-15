<template>
  <v-row>
    <v-col cols="12">
      <v-data-table
        class="pt-8"
        :headers="headers"
        :header-props="headerProps"
        :items="team"
        :footer-props="{
          'items-per-page-options': [10, 20],
          'items-per-page-text':'Emprendedores por página',
        }"
        mobile="true"
      >
        <template v-slot:item.user="{ item }">
          {{ item.lastname.toUpperCase()+', '+item.name }}
        </template>
        <template v-slot:item.user_id="{ item }">
          {{ (item.status==1)?'Registrado':'No registrado' }}
        </template>
        <template v-slot:item.actions="{ item }">
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
        </template>
      </v-data-table>

    </v-col>


    <v-dialog
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
                      <p class="text-lg-right text-sm-left"><b>DNI:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.dni }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Género:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.gender.name }}
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

                <v-col cols="12" xl="6" md="6" sm="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Dirección legal:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.legal_address }}
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
                        {{ entrepreneur.occupation }}
                      </v-col>
                    </v-row>
                  </v-col>

                  <template v-if="entrepreneur.occupation==='Investigador'">
                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Donde:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.researcher_workplace }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Pertenece a Conicet:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.conicet }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12" xl="6" md="6" sm="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          <p class="text-lg-right text-sm-left"><b>Tipo de pertenencia:</b></p>
                        </v-col>
                        <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                          {{ entrepreneur.conicet_membership }}
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col cols="12">
                      <h4>La tecnología sobre la que está basada la startup:</h4>
                    </v-col>

                    <v-col cols="12">
                      <v-row  class="pb-1 pt-1">
                        <v-col cols="12" class="pb-0 pt-0" v-if="entrepreneur.is_protectable">
                          - Cuenta con resultados de investigación protegidos.
                        </v-col>

                        <v-col cols="12" class="pb-0 pt-0" v-if="!entrepreneur.is_protectable">
                          - No cuenta con resultados de investigación protegidos.
                        </v-col>



                        <v-col cols="12" class="pb-0 pt-0" v-if="entrepreneur.is_susceptible_protected">
                          - Cuenta con resultados de investigación susceptibles a ser protegidos.
                        </v-col>

                        <v-col cols="12" class="pb-0 pt-0" v-if="!entrepreneur.is_susceptible_protected">
                          - No cuenta con resultados de investigación susceptibles a ser protegidos.
                        </v-col>



                        <v-col cols="12" class="pb-0 pt-0" v-if="entrepreneur.have_statement_results">
                          - Cuenta con declaración de resultados.
                        </v-col>

                        <v-col cols="12" class="pb-0 pt-0" v-if="!entrepreneur.have_statement_results">
                          - No cuenta con declaración de resultados.
                        </v-col>
                      </v-row>
                    </v-col>

                  </template>
                </template>

                <v-col cols="12">
                  <v-divider></v-divider>
                </v-col>

                <v-col cols="12" v-if="entrepreneur.previous_experience">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="3" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Experiencia previa:</b></p>
                    </v-col>
                    <v-col cols="12" md="9" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.previous_experience }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="entrepreneur.linkedin">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Linkedin:</b></p>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                      {{ entrepreneur.linkedin }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12" xl="6" md="6" sm="12" v-if="entrepreneur.cv">
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
      convocation_form_id:null,

      team:[],
      entrepreneur:[],
      headerProps: {
        sortByText: "Ordenar por"
      },
      headers: [
        {
          text: 'ID',
          align: 'center',
          filterable: true,
          value: 'id',
          width: '25'
        },
        {
          text: 'Emprendedor',
          align: 'start',
          filterable: true,
          value: 'user',
        },
        { 
          text: 'Correo Electrónico', 
          value: 'email' 
        },
        { 
          text: 'Estado', 
          value: 'user_id',
          align: 'center',
        },
        { 
          text: 'Acciones',
          align: 'center',
          filterable: false,
          value: 'actions',
        },
      ],
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
      this.convocation_form_id = this.$route.params.convocation_form_id
      this.getTeam()
    }
  }
</script>