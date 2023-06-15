<template>
  <v-row>
    <v-col cols="12">
      <v-sheet 
        width="100%"
        outlined
        min-height="400"
        >
        <v-row>
          <v-col 
            cols="12"
            class="pa-8">
            <label>Evaluador: </label>
            <label v-if="evaluator"> {{ evaluator.lastname.toUpperCase() +', '+ evaluator.name }}</label>
          </v-col>
          <v-col
            class="d-flex pa-8"
            cols="12"
          >
            <v-select
              v-model="edition_selected"
              :items="editions"
              label="Edición"
              outlined
              item-text="name"
              item-value="id"
              v-on:change="getEntrepreneurshipsAssigned"
            >
            </v-select>
          </v-col>
          
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
              dense
              class="pt-8"
              :headers="headers"
              :items="entrepreneurships_assigned"
              :search="search"
              :custom-filter="customSearch"
              :items-per-page="30"
                  :footer-props="{
                    'items-per-page-options': [10, 20, 30, 40, 50, 100],
                    'items-per-page-text':'Emprendimientos por página'
                  }"
                  mobile="true"
            >
              <template v-slot:item.actions="{ item }">
                <v-col>
                  <v-switch
                    v-on:change="assignedModule(item.id, item.user_id ,item.is_assigned)"
                    v-model="item.is_assigned"
                  ></v-switch>
                </v-col>
                
              </template>
            </v-data-table>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="d-sm-flex pt-8">
      <v-btn
        depressed
        class="mr-auto mt-2"
        color="primary"
        :block="$vuetify.breakpoint.xsOnly"
        :to="{ name: 'evaluators' }"
        >
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

  export default {
    name: 'moduleAssigned',

    data: () => ({
      loading:true,

      evaluator_id: null,
      evaluator:null,

      edition_selected: null,
      editions:[],

      entrepreneurships_assigned:[],

      search: '',
      headers: [
        {
          text: 'Emprendimiento',
          align: 'start',
          filterable: true,
          value: 'name',
          width:'80%'
        },
        { 
          text: 'Asignado',
          align: 'start',
          filterable: false,
          value: 'actions',
          width:'20%'
        },
      ],

      ma:null
    }),

    methods:{
      customSearch (value, search, item) {
          return Object.values(item).some(v=>v&&v.toString().toLowerCase().includes(search))
      },

      async getEvaluator()
      {
        await axios.get('admin/evaluators/'+this.evaluator_id).then(response =>{
          this.evaluator = response.data.data.evaluator
          this.editions = response.data.data.editions

          if(this.editions!=null){
            this.edition_selected = this.editions[0].id
          }
          
          this.getEntrepreneurshipsAssigned()
          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      async getEntrepreneurshipsAssigned()
      {
        this.loading=true
        await axios.get('admin/evaluators/'+this.evaluator_id+'/edition/'+this.edition_selected+'/entrepreneurships').then(response =>{
          console.log(response.data)
          this.entrepreneurships_assigned = response.data.data.entrepreneurships_assigned
          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      assignedModule(id, user_id, is_assigned){
        if(is_assigned){
          this.addEntrepreneurship(id)
        }else{
          this.removeEntrepreneurship(id)
        }
      },

      async addEntrepreneurship(id){
        this.loading=true
        await axios.post('admin/evaluators',{
          'entrepreneurship_id': id,
          'edition_id': this.edition_selected,
          'user_id': this.evaluator_id
        }).then( () =>{
          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      async removeEntrepreneurship(id){
        this.loading=true
        await axios.delete('admin/evaluators/'+id+'/'+this.evaluator_id).then(() =>{
          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      }
    },

    created(){
      this.evaluator_id = this.$route.params.evaluator_id;
      this.getEvaluator()
    },
  }
</script>
