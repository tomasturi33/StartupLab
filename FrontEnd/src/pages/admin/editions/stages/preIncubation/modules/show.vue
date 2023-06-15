<template>
  <v-row>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
        v-show="order"
      >
        <v-row class="pa-8">
          <v-col 
            cols="12" 
            xl="2" 
            md="2" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left"
            v-show="order">
              <label class="font-weight-regular text-uppercase">
                Orden:
              </label>
          </v-col>
          <v-col 
            cols="12" 
            xl="10" 
            md="10" 
            sm="12"
            v-show="order">
              <label class="font-weight-light">
                {{ order }}
              </label>
          </v-col>

          <v-col 
            cols="12" 
            xl="2" 
            md="2" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left"
            v-show="name">
              <label class="font-weight-regular text-uppercase">
                Modulo:
              </label>
          </v-col>
          <v-col 
            cols="12" 
            xl="10" 
            md="10" 
            sm="12"
            v-show="name">
              <label class="font-weight-light">
                {{ name }}
              </label>
          </v-col>

          <v-col 
            cols="12" 
            xl="2" 
            md="2" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left"
            v-show="description">
              <label class="font-weight-regular text-uppercase">
                Descripción:
              </label>
          </v-col>

          <v-col 
            cols="12" 
            xl="10" 
            md="10" 
            sm="12"
            v-show="description">
              <label class="font-weight-light">
                {{ description }}
              </label>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2" v-if="require_activity">
      <v-sheet
        width="100%"
        outlined 
        v-show="order"
      >
        <v-row class="pa-8">
          
          <v-col 
            cols="12" 
            xl="2" 
            md="2" 
            sm="12" 
            class="text-lg-right text-md-right text-sm-left"
            v-show="activity_statement">
              <label class="font-weight-regular text-uppercase">
                Avitividad:
              </label>
          </v-col>

          <v-col 
            cols="12" 
            xl="10" 
            md="10" 
            sm="12"
            v-show="activity_statement">
              <label class="font-weight-light">
                {{ activity_statement }}
              </label>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        @click="previousPage"
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
    name: 'show',

    data: () => ({
      loading:true,
      id_edition:null,
      module:null,
      order:null,
      name:null,
      description:null,
      require_activity:null,
      activity_statement:null
    }),

    methods:{
      async getModule(){
        await axios.get('admin/modules/'+this.id_module).then(response =>{
          this.module = response.data.module
          this.order = response.data.module.order
          this.name = response.data.module.name
          this.description = response.data.module.description
          this.require_activity = response.data.module.require_activity
          this.activity_statement = response.data.module.activity_statement

          this.loading=false
        }).catch(error => {
          console.log(error);
        })
      },

      previousPage(){
        this.$router.push({ name: 'modules', params: { id_edition: this.id_edition } })
      }
    },

    created(){
      this.id_edition = this.$route.params.id_edition;
      this.id_module = this.$route.params.id_module;
      this.getModule()
      },
  }
</script>
