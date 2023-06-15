<template>
  <v-row>
      <v-col cols="12">
        <h2 class="font-weight-light">Datos personales:</h2>
      </v-col>


      <v-col
        cols="12" xl="6" md="6" sm="12" xs="12"
      >
        <v-text-field
          v-model="name"
          label="Nombre completo"
          required
          outlined
        ></v-text-field>
      </v-col>
      <v-col
        cols="12" xl="6" md="6" sm="12" xs="12"
      >
        <v-text-field
          v-model="lastname"
          label="Apellido"
          required
          outlined
        ></v-text-field>
      </v-col>
      <v-col
        cols="12" xl="6" md="6" sm="12" xs="12"
      >
        <v-text-field
          v-model="dni"
          label="DNI"
          required
          outlined
          type="number"
        ></v-text-field>
      </v-col>
      <v-col 
        cols="12" xl="6" md="6" sm="12" xs="12">
        <v-select
          :items="genders"
          v-model="gender_id"
          item-text="name"
          item-value="id"
          label="Genero"
          outlined
        ></v-select>
      </v-col>

      <v-col 
        cols="12" xl="6" md="6" sm="12" xs="12"
        >
        <v-text-field
          v-model="email"
          label="Correo Electrónico"
          required
          outlined
        ></v-text-field>
      </v-col>

      <v-col 
        cols="12" xl="6" md="6" sm="12" xs="12"
        >
        <v-text-field
          v-model="phone_number"
          label="Celular"
          required
          outlined
        ></v-text-field>
      </v-col>
      
      <!--
      //-----------------------------------------------------
      //---------------Zona de radicacíon--------------------
      //-----------------------------------------------------
      -->

      <v-col 
        cols="12" xl="4" md="4" sm="12" xs="12"
        >
        <v-select
          v-model="country"
          :items="countries"
          label="Pais"
          outlined
        ></v-select>
      </v-col>

      <v-col 
        cols="12" xl="8" md="8" sm="12" xs="12"
        v-if="country!='argentina'"
        >
        <v-text-field
          v-model="other_country"
          label="Pais"
          required
          outlined
        ></v-text-field>
      </v-col>

      <v-col 
        cols="12" xl="4" md="4" sm="12" xs="12"
        v-if="country=='argentina'"
        >
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

      <v-col 
        cols="12" xl="4" md="4" sm="12" xs="12"
        v-if="country=='argentina'"
        >
        <v-select
          :items="localidades"
          v-model="localidad_id"
          item-text="name"
          item-value="id"
          label="Localidad"
          outlined
        ></v-select>
      </v-col>

      <v-col 
        cols="12" xl="12" md="12" sm="12" xs="12">
        <v-text-field
          v-model="legal_address"
          label="Domicilio legal"
          required
          outlined
        ></v-text-field>
      </v-col>
      
      <v-col cols="12">
        <h4>Estudios:</h4>
      </v-col>

      <v-col 
        cols="12" xl="4" md="4" sm="12" xs="12">
        <v-select
          :items="completed_studies"
          v-model="completed_studie_id"
          item-text="name"
          item-value="id"
          label="Estudios alcanzados"
          outlined
        ></v-select>
      </v-col>

      <v-col 
        cols="12" xl="4" md="4" sm="12" xs="12"
        v-if="completed_studie_id==1||completed_studie_id==2"
        >
        <v-text-field
          v-model="secundary_tertiary_institute"
          label="Institución"
          required
          outlined
        ></v-text-field>
      </v-col>

      <v-col 
        cols="12" xl="4" md="4" sm="12" xs="12"
        v-if="completed_studie_id==1||completed_studie_id==2"
        >
        <v-text-field
          v-model="secundary_tertiary_career"
          label="Título o carrera"
          required
          outlined
        ></v-text-field>
      </v-col>

      <template v-if="completed_studie_id==3||completed_studie_id==4">
        <v-col 
          cols="12" xl="8" md="8" sm="12" xs="12"
          >
          <v-select
            :items="universities"
            v-model="university"
            label="Universidad"
            outlined
          ></v-select>
        </v-col>

        <v-col 
          cols="12" xl="6" md="6" sm="12" xs="12"
          v-if="university=='unl'">
          <v-select
            :items="academic_units"
            v-model="academic_unit_id"
            v-on:change="getCareers"
            item-text="name"
            item-value="id"
            label="Unidad Academica"
            outlined
          ></v-select>
        </v-col>

        <v-col 
          cols="12" xl="6" md="6" sm="12" xs="12"
          v-if="university=='unl'">
          <v-select
            :items="careers"
            v-model="career_id"
            item-text="name"
            item-value="id"
            label="Carreras"
            outlined
          ></v-select>
        </v-col>

        <v-col
          cols="12" xl="6" md="6" sm="12" xs="12"
          v-if="university=='otro'"
        >
          <v-text-field
            v-model="other_university"
            label="Universidad"
            required
            outlined
          ></v-text-field>
        </v-col>

        <v-col
          cols="12" xl="6" md="6" sm="12" xs="12"
          v-if="university=='otro'"
        >
          <v-text-field
            v-model="other_career"
            label="Carrera"
            required
            outlined
          ></v-text-field>
        </v-col>

        <v-col 
          cols="12"
          v-if="completed_studie_id==4"
        >
          <v-switch 
            v-model="posgrade"
            label="Estudios de posgrado:">
            
          </v-switch>
        </v-col>

        <v-col
          cols="12" xl="6" md="6" sm="12" xs="12"
          v-if="completed_studie_id==4"
        >
          <v-text-field
            v-model="posgrade_institute"
            label="Intitución"
            :disabled="!posgrade"
            required
            outlined
          ></v-text-field>
        </v-col>

        <v-col
          cols="12" xl="6" md="6" sm="12" xs="12"
          v-if="completed_studie_id==4"
        >
          <v-text-field
            v-model="posgrade_career"
            label="Nombre del posgrado"
            :disabled="!posgrade"
            required
            outlined
          ></v-text-field>
        </v-col>

      </template>

        <!-----------------------OCUPACION----------------------------->

      <v-col
          cols="12" xl="12" md="12" sm="12" xs="12"
        >
          <v-select
            v-model="occupation"
            :items="occupations"
            label="Ocupación"
            outlined
          ></v-select>
      </v-col>

      <!-----------------------INVESTIGADOR----------------------------->

      <template v-if="occupation=='Investigador'">
        <v-col
          cols="12" xl="12" md="12" sm="12" xs="12"
          v-if="completed_studie_id==4"
        >
          <v-text-field
            v-model="researcher_workplace"
            label="¿Donde?"
            :disabled="occupation!='Investigador'"
            required
            outlined
          ></v-text-field>
        </v-col>

        <v-col
            cols="12" xl="6" md="6" sm="12" xs="12"
          >
            <v-select
              v-model="conicet"
              :items="conicet_options"
              label="¿Perteneces a Conicet?"
              outlined
            ></v-select>
        </v-col>

        <v-col
            cols="12" xl="6" md="6" sm="12" xs="12"
          >
            <v-select
              :disabled="conicet=='No'"
              v-model="conicet_membership"
              :items="conicet_membership_options"
              label="Tipo de pertenencia"
              outlined
            ></v-select>
        </v-col>

        <v-col cols="12">
          <h4>La tecnología sobre la que está basada la startup:</h4>
        </v-col>

        <v-col cols="12">
          <v-checkbox
            v-model="is_protectable"
            label="Cuenta con resultados de investigación protegidos"
          ></v-checkbox>

          <v-checkbox
            v-model="is_susceptible_protected"
            label="Cuenta con resultados de investigación susceptibles de ser protegidos"
          ></v-checkbox>

          <v-checkbox
            v-model="have_statement_results"
            label="Cuenta con declaración de resultados"
          ></v-checkbox>
        </v-col>
        
      </template>

      <v-col cols="12">
        <h4>Otros datos:</h4>
      </v-col>

      <v-col
        cols="12" xl="12" md="12" sm="12" xs="12"
      >
        <v-textarea
          v-model="previous_experience"
          :maxlength="1000"
          :counter="1000"
          :rules="[v => (v || '' ).length <= 999 || 'El mercado no debe tener mas de 1500 caracteres']"
          label="¿Has participado en algún otro proyecto o startup? Contanos tu experiencia"
          required
          outlined
        ></v-textarea>
      </v-col>

      <v-col
        cols="12" xl="12" md="12" sm="12" xs="12"
      >
        <v-text-field
          v-model="linkedin"
          label="Linkedin"
          required
          outlined
        ></v-text-field>
      </v-col>
<!-- 
      <v-col cols="12">
        <h4>Curriculum Vitae:</h4>
      </v-col>

      <v-col
        v-if="cv"
        cols="12" xl="12" md="12" sm="12" xs="12"
        class="text-center"
      >
        <v-chip
          class="ma-2 pa-6"
          close
          color="info"
          x-large
          text-color="white"
          @click:close="cv = null"
        >
        <v-icon
          dark
          left
        >
          mdi-file-pdf-box
        </v-icon>
          MI CV
        </v-chip>
        
      </v-col>

      <v-col
        v-if="!cv"
        cols="12" xl="12" md="12" sm="12" xs="12"
      >
        <v-file-input
          label="Curriculum Vitae"
          outlined
          dense
          v-model="cv"
          accept="application/pdf"
        ></v-file-input>
      </v-col> 
-->
    <!-- <v-col cols="12" class="pt-8 d-flex justify-space-between">
      <v-btn
          depressed
          color="primary"
          :to="{ name: 'myTeam'}"
          >
          Volver
        </v-btn>
        <v-spacer />

      <v-btn
        depressed
        :loading="loading"
        color="primary"
        @click="validateProfile"
        >
        Guardar
      </v-btn>
    </v-col> -->

    <v-dialog
      v-model="dialog_errors"
      persistent
      max-width="490"
    >
      <v-card>
        <v-card-title class="text-h5">
          Atención
        </v-card-title>
        <v-card-text>
          <p v-for="error in errors" :key="error">{{ error }}<br></p>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="info darken-1"
            text
            @click="dialog_errors = false"
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
    name: 'editPrifile',

    data: () => ({
      loading:true,

      id: null,
      name:'',
      lastname:'',
      dni:'',
      email:'',

      gender_id:1,
      genders:[],
      
      user_id:null,
      convocation_form_id:null,
      phone_number:'',

      country: 'argentina',
      other_country:'',
      countries: [
        { text: 'Argentina', value: 'argentina' },
        { text: 'Otro', value: 'otro' }
      ],

      provincia_id:1,
      provincias:[],

      localidad_id:null,
      localidades:[],
      legal_address:'',

      completed_studie_id:1,
      completed_studies: [],

      secundary_tertiary_institute:'',
      secundary_tertiary_career:'',

      university: 'unl',
      universities:[
        { text: 'Universidad Nacional del Litorial', value: 'unl' },
        { text: 'Otro', value: 'otro' }
      ],

      academic_unit_id:1,
      academic_units:[],

      career_id: 1,
      careers: [],

      other_university:'',
      other_career: '',

      posgrade:false,
      posgrade_institute: '',
      posgrade_career: '',

      occupation:'Empleado',
      occupations:['Empleado', 'Autónomo', 'Investigador', 'Otro'],

      researcher_workplace: '',

      conicet:'No',
      conicet_options:['Si', 'No'],

      conicet_membership: 'Becario',
      conicet_membership_options:['Investigador de Carrera', 'Becario'],

      is_protectable: false,
      is_susceptible_protected: false,
      have_statement_results: false,

      previous_experience:null,
      linkedin:null,
      cv:null,

      dialog_errors:false,

      error:'',
      errors:[],

      status:false
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form', 'user'
      ])
    },
    methods:{
      async getProvincias(){
        try {
          await axios.get('provincias').then(response =>{
            if(response.data.length!==0){
              this.provincias = response.data.provincias
            }
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
          }).catch(error => {
            console.log(error);
          })
          
        } catch (error) {
          console.log(error)
        }
      },

      async getLocalidadesLoad(){
        try {
          await axios.get('provincias-localidades/'+this.provincia_id).then(response =>{
            if(response.data.length!==0){
              this.localidades = response.data.provincia.localidads
            }
          }).catch(error => {
            console.log(error);
          })
          
        } catch (error) {
          console.log(error)
        }
      },

      async getCompletedStudies(){
        try {
          await axios.get('completed-studies').then(response =>{
            if(response.data.length!==0){
              this.completed_studies = response.data.completed_studies

            }
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },

      async getAcademicsUnits(){
        try {
          await axios.get('academic-units').then(response =>{
            if(response.data.length!==0){
              this.academic_units = response.data.academic_units
            }
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },

      async getCareers(){
        try {
          await axios.get('academic-units/'+this.academic_unit_id).then(response =>{
            if(response.data.length!==0){
              this.careers = response.data.academic_unit.careers
              this.career_id = this.careers[0].id
            }
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },
      
      async getCareersLoad(){
        try {
          await axios.get('academic-units/'+this.academic_unit_id).then(response =>{
            if(response.data.length!==0){
              this.careers = response.data.academic_unit.careers
            }
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },

      async getGenders(){
        try {
          await axios.get('genders').then(response =>{
            if(response.data.length!==0){
              this.genders = response.data.genders
            }
          }).catch(error => {
            console.log(error);
          })
        } catch (error) {
          console.log(error)
        }
      },

      async getProfile(){
        this.message = 'Cargando perfíl...'
        await axios.get('entrepreneurial-profiles/'+this.convocation_form.convocation_form.id+'/show/'+ -1)
          .then(response =>{
          if(response.data.length!==0){
            this.id = response.data.entrepreneurial_profile.id
            this.user_id = response.data.entrepreneurial_profile.user_id
            this.name = response.data.entrepreneurial_profile.name
            this.lastname = response.data.entrepreneurial_profile.lastname
            this.dni = response.data.entrepreneurial_profile.dni
            this.gender_id = response.data.entrepreneurial_profile.gender_id
            this.email = response.data.entrepreneurial_profile.email
            this.phone_number = response.data.entrepreneurial_profile.phone_number
            this.country = response.data.entrepreneurial_profile.country
            this.provincia_id = response.data.entrepreneurial_profile.provincia_id
            this.localidad_id = response.data.entrepreneurial_profile.localidad_id
            this.legal_address = response.data.entrepreneurial_profile.legal_address
            this.completed_studie_id = response.data.entrepreneurial_profile.completed_studie_id
            this.secundary_tertiary_institute = response.data.entrepreneurial_profile.secundary_tertiary_institute
            this.secundary_tertiary_career = response.data.entrepreneurial_profile.secundary_tertiary_career
            this.university = response.data.entrepreneurial_profile.university
            this.academic_unit_id = response.data.entrepreneurial_profile.academic_unit_id
            this.career_id = response.data.entrepreneurial_profile.career_id
            this.other_university = response.data.entrepreneurial_profile.other_university
            this.other_career = response.data.entrepreneurial_profile.other_career
            this.posgrade = response.data.entrepreneurial_profile.posgrade
            this.posgrade_institute = response.data.entrepreneurial_profile.posgrade_institute
            this.posgrade_career = response.data.entrepreneurial_profile.posgrade_career

            this.researcher_workplace = response.data.entrepreneurial_profile.researcher_workplace

            this.occupation = response.data.entrepreneurial_profile.occupation
            
            this.conicet = response.data.entrepreneurial_profile.conicet
            this.conicet_membership = response.data.entrepreneurial_profile.conicet_membership
            this.is_protectable = response.data.entrepreneurial_profile.is_protectable
            this.is_susceptible_protected = response.data.entrepreneurial_profile.is_susceptible_protected
            this.have_statement_results = response.data.entrepreneurial_profile.have_statement_results

            this.previous_experience = response.data.entrepreneurial_profile.previous_experience
            this.linkedin = response.data.entrepreneurial_profile.linkedin
            this.cv = response.data.entrepreneurial_profile.cv

            this.status = response.data.entrepreneurial_profile.status

            this.getLocalidadesLoad()
            this.getCareersLoad()
            this.getGenders()
          }
          this.loading = false
        }).catch(error => {
          console.log(error);
          this.loading = false
        })
      },

      validateProfile(){

        this.loading = true
        this.errors=[]

        if(this.name.length==0){
          this.errors.push('El nombre es obligatorio.')
        }

        if(this.lastname.length==0){
          this.errors.push('El apellido es obligatorio.')
        }

        if(this.dni==null || this.dni == ''){
          this.errors.push('El DNI es obligatorio.')
        }

        if(this.phone_number==null || this.phone_number == ''){
          this.errors.push('El número de celular es obligatorio.')
        }

        if(this.email==null || this.email == ''){
          this.errors.push('El correo electrónico es obligatorio.')
        }

        if(this.country=='otro'){
          if(this.other_country==null || this.other_country == ''){
            this.errors.push('El país de procedencia es obligatorio.')
          }
        }
        if(this.legal_address==null || this.legal_address == ''){
          this.errors.push('El domicilio legal es obligatorio.')
        }

        if(this.completed_studie_id==1 || this.completed_studie_id==2){
          if(this.secundary_tertiary_institute==null || this.secundary_tertiary_institute == ''){
            this.errors.push('El instituto es obligatorio.')
          }

          if(this.secundary_tertiary_career==null || this.secundary_tertiary_career == ''){
            this.errors.push('La carrera es obligatoria.')
          }
        }

        if(this.completed_studie_id==3 || this.completed_studie_id==4){
          if(this.university=='otro'){
            if(this.other_university==null || this.other_university == ''){
              this.errors.push('La Universidad es obligatoria.')
            }

            if(this.other_career==null || this.other_career == ''){
              this.errors.push('La carrera es obligatoria.')
            }
          }
        }

        if(this.posgrade){
          if(this.posgrade_institute==null || this.posgrade_institute == ''){
            this.errors.push('La Institución donde realizo el posgrado es obligatoria.')
          }

          if(this.posgrade_career==null || this.posgrade_career == ''){
            this.errors.push('El nombre del posgrado es obligatorio.')
          }
        }

        if(this.occupation=='Investigador'){
          if(this.researcher_workplace==null || this.researcher_workplace == ''){
            this.errors.push('El lugar donde investiga es obligatorio.')
          }
        }

        if(this.errors.length!=0){
          this.dialog_errors = true
          this.loading = false
        }else{
          this.save()
        }
        
      },

      async save(){
        await axios.put('entrepreneurial-profiles/update/'+this.id, {
          user_id: this.user_id, 
          name: this.name,
          lastname: this.lastname,
          dni:this.dni,
          gender_id:this.gender_id,
          email: this.email,
          phone_number: this.phone_number,
          country: this.country,
          other_country: this.other_country,
          provincia_id: this.provincia_id,
          localidad_id: this.localidad_id,
          legal_address: this.legal_address,
          completed_studie_id: this.completed_studie_id,
          secundary_tertiary_institute: this.secundary_tertiary_institute,
          secundary_tertiary_career: this.secundary_tertiary_career,
          university: this.university,
          academic_unit_id: this.academic_unit_id,
          career_id: this.career_id,
          other_university: this.other_university,
          other_career: this.other_career,
          posgrade: this.posgrade,
          posgrade_institute: this.posgrade_institute,
          posgrade_career: this.posgrade_career,

          researcher_workplace: this.researcher_workplace,

          occupation: this.occupation,

          conicet: this.conicet,
          conicet_membership: this.conicet_membership,
          is_protectable: this.is_protectable,
          is_susceptible_protected: this.is_susceptible_protected,
          have_statement_results: this.have_statement_results,

          previous_experience: this.previous_experience,
          linkedin: this.linkedin,
          cv: this.cv
        })
        .then(() => {
          this.loading = false
          this.$router.push({ name: 'myTeam'})
        })
        .catch(function (error) {
          console.log(error.response.data);
        });
      },

      async saveWithCV(){
        await axios.put('entrepreneurial-profiles/update/'+this.id, {
          name: this.name,
          lastname: this.lastname,
          dni:this.dni,
          gender_id:this.gender_id,
          email: this.email,
          phone_number: this.phone_number,
          country: this.country,
          other_country: this.other_country,
          provincia_id: this.provincia_id,
          localidad_id: this.localidad_id,
          legal_address: this.legal_address,
          completed_studie_id: this.completed_studie_id,
          secundary_tertiary_institute: this.secundary_tertiary_institute,
          secundary_tertiary_career: this.secundary_tertiary_career,
          university: this.university,
          academic_unit_id: this.academic_unit_id,
          career_id: this.career_id,
          other_university: this.other_university,
          other_career: this.other_career,
          posgrade: this.posgrade,
          posgrade_institute: this.posgrade_institute,
          posgrade_career: this.posgrade_career,

          researcher_workplace: this.researcher_workplace,

          occupation: this.occupation,

          conicet: this.conicet,
          conicet_membership: this.conicet_membership,
          is_protectable: this.is_protectable,
          is_susceptible_protected: this.is_susceptible_protected,
          have_statement_results: this.have_statement_results,

          previous_experience: this.previous_experience,
          linkedin: this.linkedin,
          cv: this.cv
        })
        .then(() => {
          this.$router.push({ name: 'myTeam'})
        })
        .catch(function (error) {
          console.log(error);
        });
      }
    },

    created(){
      this.getProvincias();
      this.getCompletedStudies();
      this.getAcademicsUnits();
      this.getGenders();
      this.getProfile()
    },
  }
</script>