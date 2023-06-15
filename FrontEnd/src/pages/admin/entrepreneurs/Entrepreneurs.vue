<template>
  <v-row>
    <v-col cols="12">
      <v-sheet
        outlined
        min-height="400">
        <v-row>        
          <v-col cols="12">
            <v-row>
              <v-col cols="12" class="pa-8"> 
                <v-text-field
                  v-model="search"
                  append-icon="mdi-magnify"
                  label="Buscar"
                  single-line
                  hide-details
                ></v-text-field> 
              </v-col> 
                
              <v-col cols="12"> 
                <v-data-table
                  class="pt-8"
                  :header-props="headerProps"
                  :headers="headers"
                  :items="entrepreneurs"
                  :sort-by.sync="sortBy"
                  :sort-desc.sync="sortDesc"
                  :search="search"
                  :custom-filter="customSearch"
                  :items-per-page="30"
                  :footer-props="{
                    'items-per-page-options': [10, 20, 30, 40, 50, 100],
                    'items-per-page-text':'Emprendedores por página'
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
                      @click="showUser(item.id)"
                    >
                      <v-icon dark small>
                        mdi-eye
                      </v-icon>
                    </v-btn>
                  </template>
                </v-data-table>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <!--Dialog show entrepreneurs-->
    <v-dialog
      v-model="dialog_user"
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

                <v-col cols="12">
                  <v-divider></v-divider>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="4" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Edición:</b></p>
                    </v-col>
                    <v-col cols="12" md="8" sm="12" class="pb-0 pt-0">
                      {{ convocation_form.edition.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="4" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>ID Idea Proyecto:</b></p>
                    </v-col>
                    <v-col cols="12" md="8" sm="12" class="pb-0 pt-0">
                      {{ proyect_idea_id }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="4" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Idea Proyecto:</b></p>
                    </v-col>
                    <v-col cols="12" md="8" sm="12" class="pb-0 pt-0">
                      {{ proyect_idea }}
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

                <template v-if="entrepreneur.country==='argentina'">
                  <v-col cols="12" xl="6" md="6" sm="12">
                    <v-row  class="pb-1 pt-1">
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        <p class="text-lg-right text-sm-left"><b>Pais:</b></p>
                      </v-col>
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        Argentina
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
                </template>

                <template v-if="entrepreneur.country==='otro'">
                  <v-col cols="12" xl="6" md="6" sm="12">
                    <v-row  class="pb-1 pt-1">
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        <p class="text-lg-right text-sm-left"><b>Pais:</b></p>
                      </v-col>
                      <v-col cols="12" md="6" sm="12" class="pb-0 pt-0">
                        {{ entrepreneur.other_country }}
                      </v-col>
                    </v-row>
                  </v-col>
                </template>
                  

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
                
                <template v-if="entrepreneur.previous_experience!==null">
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
                </template>
                
                <template v-if="entrepreneur.linkedin!==null">
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
                </template>

                <template v-if="entrepreneur.cv!==null">
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

                <v-col cols="12">
                  <v-divider></v-divider>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="3" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Edición:</b></p>
                    </v-col>
                    <v-col cols="12" md="9" sm="12" class="pb-0 pt-0">
                      {{ convocation_form.edition.name }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="3" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>ID Idea Proyecto:</b></p>
                    </v-col>
                    <v-col cols="12" md="9" sm="12" class="pb-0 pt-0">
                      {{ proyect_idea_id }}
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-row  class="pb-1 pt-1">
                    <v-col cols="12" md="3" sm="12" class="pb-0 pt-0">
                      <p class="text-lg-right text-sm-left"><b>Idea Proyecto:</b></p>
                    </v-col>
                    <v-col cols="12" md="9" sm="12" class="pb-0 pt-0">
                      {{ proyect_idea }}
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
            @click="dialog_user = false"
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
    name: 'Entrepreneurs',

    data: () => ({
      loading:true,
      show:false,
      active_tab: 0,

      dialog_user:false,
      dialog_new_user:false,
      dialog_edit_user:false,

      id: null,
      name:'',
      lastname:'',
      email:'',
      emailRules: [
        v => !!v || 'E-mail es requerido',
        v => /.+@.+\..+/.test(v) || 'E-mail debe ser valido',
      ],
      convocation_form:null,
      proyect_idea_id:null,
      proyect_idea:null,

      admin_role: false,
      evaluator_role: false,

      roles:[],
      entrepreneurs:[],

      entrepreneur:[],

      search: '',
      sortBy: 'id',
      sortDesc: true,
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
          text: 'Usuario',
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
      customSearch (value, search, item) {
          return Object.values(item).some(v=>v&&v.toString().toLowerCase().includes(search))
      },

      async getEntrepreneurs()
      {
        await axios.get('admin/entrepreneurs').then(response =>{
          this.entrepreneurs = response.data.entrepreneurs
          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error);
        })
      },

      async showUser(id)
      {
        this.loading = true 
        try {
          await axios.get('admin/entrepreneurs/'+id).then((response) =>{
            this.entrepreneur = response.data.entrepreneur
            this.id = response.data.entrepreneur.id
            this.name = response.data.entrepreneur.name
            this.lastname = response.data.entrepreneur.lastname
            this.email = response.data.entrepreneur.email
            this.admin_role = response.data.entrepreneur.admin_role
            this.evaluator_role = response.data.entrepreneur.evaluator_role   
            this.convocation_form = response.data.entrepreneur.convocation_form   
            this.proyect_idea_id = response.data.entrepreneur.convocation_form.id   
            this.proyect_idea = response.data.entrepreneur.convocation_form.title   

            console.log(this.convocation_form.edition.name)
  
            this.loading = false
            this.dialog_user = true
            })
        } catch (error) {
          console.log(error.response.data);
          this.message = ''
          this.loading = false
        }
      }
    },

    created(){
      this.getEntrepreneurs()
    },
  }
</script>
