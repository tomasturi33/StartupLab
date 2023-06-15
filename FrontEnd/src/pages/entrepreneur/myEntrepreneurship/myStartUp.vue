<template>
  <v-row>
    <v-col cols="12">
      <v-sheet
          width="100%"
          outlined 
        >
        <v-row class="ma-1">
          <v-col cols="12">
            <h2 class="font-weight-light">Datos de la StartUp:</h2>
          </v-col>

          <v-col cols="12">
            <v-text-field
              :maxlength="200"
              :counter="200"
              :rules="[v => (v || '' ).length <= 180 || 'El nombre de la idea no debe tener mas de 200 caracteres']"
              ref="title"
              outlined
              v-model="title"
              label="Mi idea"
              required
            ></v-text-field>
            
            <v-textarea
              :maxlength="300"
              :counter="300"
              :rules="[v => (v || '' ).length <= 280 || 'El resumen ejecutivo no debe tener mas de 200 caracteres']"
              outlined
              ref="executive_summary"
              name="executive_summary"
              v-model="executive_summary"
              label="Resumen ejecutivo"
            ></v-textarea>

            <v-textarea
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1480 || 'El problema detectado no debe tener mas de 1500 caracteres']"
              outlined
              ref="problem_detected"
              name="problem_detected"
              v-model="problem_detected"
              label="Problema detectado"
            ></v-textarea>

            <v-textarea
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1480 || 'La solición propuesta no debe tener mas de 1500 caracteres']"
              outlined
              ref="proposed_solution"
              name="proposed_solution"
              v-model="proposed_solution"
              label="Solución propuesta"
            ></v-textarea>

            <v-textarea
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1480 || 'El servicio o producto que ofrece no debe tener mas de 1500 caracteres']"
              outlined
              ref="products_services_you_offer"
              name="products_services_you_offer"
              v-model="products_services_you_offer"
              label="Producto o servicio que ofrecen"
            ></v-textarea>

            <v-textarea
              :maxlength="2000"
              :counter="2000"
              :rules="[v => (v || '' ).length <= 1980 || 'El mercado no debe tener mas de 2000 caracteres']"
              outlined
              ref="market"
              name="market"
              v-model="market"
              label="Mercado"
            ></v-textarea>

            <v-textarea
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1480 || 'El mercado no debe tener mas de 1500 caracteres']"
              outlined
              ref="entrepreneurial_team"
              name="entrepreneurial_team"
              v-model="entrepreneurial_team"
              label="Equipo emprendedor (integrantes, roles, aportes)"
            ></v-textarea>

            <v-textarea
              outlined
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1480 || 'El plan de acción no debe tener mas de 1500 caracteres']"
              ref="action_plan"
              name="action_plan"
              v-model="action_plan"
              label="Plan de acción"
            ></v-textarea>
          </v-col>

          <v-col cols="12" xl="4" md="4" sm="12">
            <v-select
              :items="vertical_works"
              v-model="vertical_works_id"
              item-text="name"
              item-value="id"
              label="Vertical de trabajo"
              outlined
            ></v-select>
          </v-col>

          <v-col cols="12" xl="4" md="4" sm="12">
            <v-select
              :items="entrepreneurship_stadium"
              v-model="entrepreneurship_stadia_id"
              item-text="name"
              item-value="id"
              label="Estadio de la StartUp"
              outlined
            ></v-select>
          </v-col>

          <v-col cols="12" xl="4" md="4" sm="12">
            <v-select
              :items="development_degree"
              v-model="development_degrees_id"
              :disabled="entrepreneurship_stadia_id==1||entrepreneurship_stadia_id==null"
              item-text="name"
              item-value="id"
              label="Grado de desarrollo actual"
              outlined
            ></v-select>
          </v-col>

          <v-col
            cols="12"
          >
            <v-select
              v-model="entrepreneurship_needs"
              :items="needs"
              :menu-props="{ maxHeight: '400' }"
              label="¿Qué busca de la convocatoria?"
              item-text="name"
              item-value="id"
              multiple
              outlined
            ></v-select>
          </v-col>

          <v-col
            cols="12">
            <v-text-field
              :maxlength="200"
              :counter="200"
              :rules="[v => (v || '' ).length <= 199 || 'El nombre de la idea no debe tener mas de 200 caracteres']"
              ref="title"
              outlined
              v-model="video"
              label="Si tienes un video en alguna plataforma tipo YouTube, pega el link aquí"
              required
            ></v-text-field>          
          </v-col>

          <v-col cols="12">
            <h2 class="font-weight-light">Currículum de la StartUp </h2>
            <label class="text--secondary"> Contanos los avances y logros de la startup agregándolos aquí</label>
          </v-col>

          <v-col cols="12">
            <v-simple-table>
              <thead>
                <tr>
                  <th class="text-left" width="20%">
                    Tipo
                  </th>
                  <th class="text-left" width="60%">
                    Name
                  </th>
                  <th class="text-center">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(item, index) in curriculum"
                  :key="index"
                >
                  <td>{{ item.type }}</td>
                  <td>{{ item.description }}</td>
                  <td class="text-center">
                    <v-btn
                      fab
                      dark
                      x-small
                      color="red"
                      @click="deleteMileston(index)"
                    >
                      <v-icon dark>
                        mdi-trash-can-outline
                      </v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </v-simple-table>
          </v-col>

          <v-col cols="12" class="text-center">
            <v-btn 
              outlined
              @click="add_hito=true"
              color="primary">
              <v-icon dark>
                mdi-plus
              </v-icon>
              Agregar
            </v-btn>
          </v-col>

          <v-col cols="12">
            <h2 class="font-weight-light">Datos de radicación:</h2>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <v-select
              :items="provincias"
              v-model="provincia_id"
              v-on:change="getLocalidades"
              item-text="name"
              item-value="id"
              label="Provincia"
              outlined
            ></v-select>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <v-select
              :items="localidades"
              v-model="localidad_id"
              item-text="name"
              item-value="id"
              label="Localidad"
              outlined
            ></v-select>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'myEntrepreneurship'}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>

      <v-spacer />

      <v-btn
        depressed
        color="primary"
        @click="updateMyIdea"
        :loading="loading"
        >
        Actualizar
      </v-btn>
    </v-col>

    <v-dialog
        v-model="dialog_error"
        max-width="290"
      >
        <v-card>
          <v-card-title class="text-h5">
            
          </v-card-title>

          <v-card-text>
            No pueden quedar campos vacios. Por favor, complete todos los campos.
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
              color="green darken-1"
              text
              @click="dialog_error = false"
            >
              Cerrar
            </v-btn>
          </v-card-actions>
        </v-card>
    </v-dialog>

    <v-dialog
      v-model="add_hito"
      persistent
      max-width="700px"
     >
      <v-card>
        <v-card-title>
          <span class="text-h5">Curriculum de la StartUp</span>
        </v-card-title>
        <v-card-text>

            <v-row>
              <v-col
                cols="12"
                class="pt-9"
              >
                <v-select
                  v-model="milestone_type"
                  :items="['Hitos', 'Participación en eventos', 'Convocatorias', 'Participación en otros espacios UNL [Expresiva, Idear, PTLC, Emprendedores, Otros]', 'Financiamiento']"
                  label="Tipo"
                  required
                  outlined
                ></v-select>
              </v-col>

              <v-col
                cols="12"
              >
                <v-textarea
                  v-model="milestone_description"
                  label="Decripción"
                  outlined
                  required
                  :counter="300"
                  :maxlength="300"
                ></v-textarea>
              </v-col>
 
            </v-row>

        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="add_hito = false"
          >
            Cerrar
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="addMilestone"
          >
            Agregar
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
  import { mapGetters } from 'vuex'

  export default {
    name: 'myStartUp',

    data: () => ({
      add_hito:false,
      aux:null,
      entrepreneurship:[], 
      show: false,
      dialog_error: false,
      id: null,
      title:'',
      executive_summary:'',
      problem_detected:'',
      proposed_solution:'',
      products_services_you_offer:'',
      market:'',
      action_plan:'',

      entrepreneurial_team:'',
      
      entrepreneurship_stadia_id: 1,
      entrepreneurship_stadium:[],

      vertical_works_id: 1,
      vertical_works:[],

      development_degrees_id: 1,
      development_degree:[],

      entrepreneurship_needs_2:[],
      entrepreneurship_needs:[],
      needs:[],

      video:null,

      milestone_id:100,
      milestone_type:'Hitos',
      milestone_description: '',

      headers: [
        { text: 'Tipo', value: 'type', width: '20%'},
        { text: 'Descripción', value: 'description', width: '50%' },
        { text: 'acciones', value: 'action' },
      ],
      curriculum: [],

      provincia_id:1,
      provincias:[],

      localidad_id:null,
      localidades:[],

      editions:null,
      loading:true,
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form'
      ])
    },
    methods:{
      async getEntrepreneurshipStadium(){
        try {
          await axios.get('entrepreneurship-stadium').then(response =>{
            if(response.data.length!==0){
              this.entrepreneurship_stadium = response.data.entrepreneurship_stadium
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },	

      async getDevelopmentDegree(){
        try {
          await axios.get('development-degree').then(response =>{
            if(response.data.length!==0){
              this.development_degree = response.data.development_degree
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },	

      async getVerticalWorks(){
        try {
          await axios.get('vertical-works').then(response =>{
            if(response.data.length!==0){
              this.vertical_works = response.data.vertical_works
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },	

      async getEntrepreneurshipNeeds(){
        try {
          await axios.get('entrepreneurship-needs').then(response =>{
            if(response.data.length!==0){
              this.needs = response.data.entrepreneurship_needs
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },	

      async getProvincias(){
        try {
          await axios.get('provincias').then(response =>{
            if(response.data.length!==0){
              this.provincias = response.data.provincias
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },

      async getLocalidades(){
        try {
          await axios.get('provincias-localidades/'+this.provincia_id).then(response =>{
            if(response.data.length!==0){
              this.localidades = response.data.provincia.localidads
              this.localidad_id = response.data.provincia.localidads[0].id
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
          
        } catch (error) {
          console.log(error)
        }
      },

      async getLocalidadesCreated(){
        try {
          await axios.get('provincias-localidades/'+this.provincia_id).then(response =>{
            if(response.data.length!==0){
              this.localidades = response.data.provincia.localidads
            }
            this.loading = false
          }).catch(error => {
            console.log(error);
          })
          
        } catch (error) {
          console.log(error)
        }
      },

      addMilestone(){
        let data = {  
                      'id': this.milestone_id,
                      'type':this.milestone_type, 
                      'description': this.milestone_description, 
                      'action':null 
                    };
        
        this.curriculum.push(data)
        this.milestone_type = 'Hitos'
        this.milestone_description = ''
        this.add_hito = false
      },

      deleteMileston(index){
        this.curriculum.splice(index, 1)
      },

      async getMyStartUp(){
        await axios.get('entrepreneurship/'+this.convocation_form.convocation_form.id).then(response =>{
          if(response.data.length!==0){

            this.aux = response.data
            this.entrepreneurship = response.data.entrepreneurship
            this.id = response.data.entrepreneurship.id
            this.title = response.data.entrepreneurship.title
            this.executive_summary = response.data.entrepreneurship.executive_summary
            this.problem_detected = response.data.entrepreneurship.problem_detected
            this.proposed_solution = response.data.entrepreneurship.proposed_solution
            this.products_services_you_offer = response.data.entrepreneurship.products_services_you_offer
            this.market = response.data.entrepreneurship.market
            this.entrepreneurial_team = response.data.entrepreneurship.entrepreneurial_team
            this.action_plan = response.data.entrepreneurship.action_plan

            this.vertical_works_id = response.data.entrepreneurship.vertical_works_id

            this.entrepreneurship_stadia_id = response.data.entrepreneurship.entrepreneurship_stadia_id
            this.development_degrees_id = response.data.entrepreneurship.development_degrees_id

            this.entrepreneurship_needs_2 = response.data.entrepreneurship.need_startup

            this.entrepreneurship_needs_2.forEach(element=>{
              this.entrepreneurship_needs.push(element.entrepreneurship_need_id)
            })
            
            this.video = response.data.entrepreneurship.video

            this.curriculum = response.data.entrepreneurship.curriculum

            this.provincia_id = response.data.entrepreneurship.provincia_id
            this.localidad_id = response.data.entrepreneurship.localidad_id

            this.getProvincias()
            this.getLocalidadesCreated()
            this.getEntrepreneurshipStadium()
            this.getDevelopmentDegree()
            this.getVerticalWorks()
            this.getEntrepreneurshipNeeds()
          }
          this.loading = false
        }).catch(error => {
          console.log(error);
          this.loading = false
        })
      },

      async updateMyIdea(){
        try {
          this.loading = true
          await axios.put('entrepreneurship/'+this.id,{
              title: this.title,
              executive_summary: this.executive_summary,
              problem_detected: this.problem_detected,
              proposed_solution: this.proposed_solution,
              products_services_you_offer: this.products_services_you_offer,
              market: this.market,
              entrepreneurial_team: this.entrepreneurial_team,
              action_plan: this.action_plan,

              vertical_works_id: this.vertical_works_id,
              entrepreneurship_needs: this.entrepreneurship_needs,
              entrepreneurship_stadia_id: this.entrepreneurship_stadia_id,
              development_degrees_id: this.development_degrees_id,

              video: this.video,

              curriculum: this.curriculum,

              provincia_id: this.provincia_id,
              localidad_id: this.localidad_id
            }).then(() =>{
              this.$router.push({ name: 'myEntrepreneurship'})
              this.loading = false
            })
        } catch (error) {
            this.loading = false
            this.dialog_error=true
            console.error(error.response.data.message);     // NOTE - use "error.response.data` (not "error")
        }
      }
    },

    created(){
      this.getMyStartUp()
    },
  }
</script>