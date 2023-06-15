<template>
  <v-row>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Información de la edición:</h3>
          </v-col>

          <v-col
            cols="12"
          >
            <v-text-field
              ref="name"
              v-model="name"
              outlined
              :rules="[() => !!name || 'Este campo es requerido']"
              :error-messages="errorMessages"
              label="Nombre de la ediciòn"
              required
            ></v-text-field>
            
            <v-textarea
              outlined
              ref="description"
              v-model="description"
              name="description"
              label="Descripción"
            ></v-textarea>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Estadios:</h3>
          </v-col>

          <v-col
            cols="12"
            xl="4"
            md="4"
            sm="12"
            xs="12"
          >
            <v-btn 
              block 
              color="primary"
              :to="{ name: 'modules', params: { id: this.edition_id }}">
              Pre Incubación
            </v-btn>
          </v-col>

          <v-col
            cols="12"
            xl="4"
            md="4"
            sm="12"
            xs="12"
          >
            <v-btn block color="primary" disabled>
              Incubación
            </v-btn>
          </v-col>

          <v-col
            cols="12"
            xl="4"
            md="4"
            sm="12"
            xs="12"
          >
            <v-btn block color="primary" disabled>
              Pre Aceleración
            </v-btn>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Convocatoria:</h3>
          </v-col>

          <v-col class="pl-4" cols="12">
            <v-switch 
              v-model="published"
              :label="(published)?'Publicada':'No publicada'">
            </v-switch>
          </v-col>

          <v-col cols="6" md="6">
            <v-text-field
              type="date"
              :disabled="!published"
              v-model="start_date"
              outlined
              append-icon="mdi-calendar"
              label="Fecha de inicio"
              required
            ></v-text-field>
          </v-col>

          <v-col cols="6" md="6">
            <v-text-field
              type="time"
              :disabled="!published"
              v-model="start_time"
              outlined
              append-icon="mdi-clock"
              label="Hora de inicio"
              required
            ></v-text-field>
          </v-col>

          <v-col cols="6" md="6">
            <v-text-field
              type="date"
              :disabled="!published"
              v-model="finish_date"
              outlined
              append-icon="mdi-calendar"
              label="Fecha de finalización"
              required
            ></v-text-field>
          </v-col>

          <v-col cols="6" md="6">
            <v-text-field
              :disabled="!published"
              type="time"
              v-model="finish_time"
              append-icon="mdi-clock"
              outlined
              label="Hora de finalización"
              required
            ></v-text-field>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-4">

          <v-col class="pl-4" cols="12">
            <h3 class="font-weight-regular">Términos y condiciones:</h3>
          </v-col>

          <v-col
            cols="12"
          >            
            <v-textarea
              height="400"
              outlined
              ref="terms_and_conditions"
              v-model="terms_and_conditions"
              name="terms_and_conditions"
              label="Terminos y condiciones"
            ></v-textarea>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'editions'}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>

      <v-btn
        depressed
        :loading="loading_update"
        color="primary"
        @click="updateEdition()"
        >
        Guardar
      </v-btn>
    </v-col>

    <v-dialog
      v-model="error"
      persistent
      max-width="490"
    >
      <v-card>
        <v-card-title class="text-h5">
          Advertencia
        </v-card-title>
        <v-card-text>
    
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title 
                v-for="error in errors" 
                v-bind:key="error"
                class="pa-2">
                - {{ error }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>

        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary darken-1"
            text
            @click="error = false"
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
    name: 'showEdition',

    data: (vm) => ({
      loading:true,
      loading_update:false,
      show:false,
      edition_id:null,
      errorMessages: '',
      edition:null,

      name:'',
      description:'',

      published:false,

      start_date:null,
      start_time:null,

      finish_date:null,
      finish_time:null,

      terms_and_conditions:null,

      error:false,
      errors:[],

      date: null,
      dateFormatted: vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
    }),

    computed: {
      computedDateFormatted () {
        return this.formatDate(this.date)
      },
    },

    watch: {
      date (val) {
        console.log(val)
        this.dateFormatted = this.formatDate(this.date)
      },
    },

    methods:{
      formatDate (date) {
        if (!date) return null

        const [year, month, day] = date.split('-')
        return `${month}/${day}/${year}`
      },

      parseDate (date) {
        if (!date) return null

        const [month, day, year] = date.split('/')
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
      },

      async getEdition(){
        await axios.get('admin/editions/'+this.edition_id).then(response =>{
          this.edition = response.data.edition

          this.name = this.edition.name
          this.description = this.edition.description
          this.published = (this.edition.published=='1')?true:false

          this.start_date = this.edition.start_date
          this.start_time= this.edition.start_time
          
          this.finish_date = this.edition.finish_date
          this.finish_time= this.edition.finish_time

          this.terms_and_conditions= this.edition.terms_and_conditions

          this.loading=false
          this.show=true

        }).catch(error => {
          console.log(error);
        })
      },

      dateConvert(date){
        const parts = date.split(/[- :]/);
        return `${parts[2]}/${parts[1]}/${parts[0]}`;
      },

      async updateEdition(){
        
        this.loading_update=true
        this.error = false
        this.errors = []
        this.validate()

        try {
          await axios.put('admin/editions/'+this.edition_id,{
            name: this.name, 
            description:this.description,
            pre_incubation: false, 
            incubation: false, 
            pre_aceleration: false,
            published: this.published,
            start_date: this.start_date,
            start_time: this.start_time,
            finish_date: this.finish_date,
            finish_time: this.finish_time,
            terms_and_conditions: this.terms_and_conditions
            }).then(() =>{
              if(this.errors.length===0){
                this.$router.push({ name: 'editions' })  
              }
              })
          } 
        catch (error) {
          //console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
          Object.values(error.response.data.errors).forEach(error => {
            this.errors.push(error[0])
          })
        }

        if(this.errors.length!=0){
          this.loading_update=false
          this.error=true
        }
      },

      validate(){
        if(this.published){
          if(!this.name){
            this.errors.push('Por favor ingrese el nombre de la edición.')
          }
            
          if(!this.start_date){
            this.errors.push('Por favor ingrese la fecha de inicio.')
          }

          if(!this.start_time){
            this.errors.push('Por favor ingrese la hora de inicio.')
          }

          if(!this.finish_date){
            this.errors.push('Por favor ingrese la fecha de finalización.')
          }

          if(!this.finish_time){
            this.errors.push('Por favor ingrese la hora de finalización.')
          }

          if(this.finish_date<this.start_date){
            this.errors.push('Por favor revise las fechas de inicio y fin.')
          }

          if(this.finish_date==this.start_date){
            if(this.finish_time<=this.start_time){
              this.errors.push('Por favor revise la hora de inicio y fin.')
            }
          }
        }
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.getEdition()
    },
  }
</script>
