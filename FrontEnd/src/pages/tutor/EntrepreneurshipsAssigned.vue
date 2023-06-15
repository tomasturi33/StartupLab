<template>
  <v-row>
    <v-col cols="12">
      <v-sheet 
        width="100%"
        outlined
        min-height="300px">
        <v-row class="pa-4">
          <v-col 
            cols="12"
            xl="4"
            md="6"
            sm="12"
            v-for="entrepreneurship in entrepreneurships"
            :key="entrepreneurship.id">
            <v-card
              class="d-flex flex-column mx-auto"
              outlined
              height="164"
              color="indigo lighten-5"
              >
              <v-progress-linear
                  :value="entrepreneurship.progress"
                  color="blue"
                  height="8"
                  class="mr-2"
                  rounded
                ></v-progress-linear>

              <v-list-item three-line>
                <v-list-item-content>
                  <v-list-item-subtitle>
                    {{ entrepreneurship.edition.name }}
                  </v-list-item-subtitle>

                  <v-list-item-title>
                    <h4>{{ entrepreneurship.entrepreneurship.title }}</h4>
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-spacer></v-spacer>
              <v-card-actions>
                
                <v-spacer></v-spacer>
                <v-btn
                  small
                  class="white--text"
                  color="primary"
                  @click="showTasks(entrepreneurship.entrepreneurship.slug)"
                >
                  Tareas
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>

        </v-row>
      </v-sheet>
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
          Cargando...
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
    name: 'EntrepreneurshipsAssigned',

    data: () => ({
      loading:true,
      state_convocation_form:'',
      modules_assigned:[],
      module_pre_incubation:[],
      entrepreneurships:[]
    }),
    methods:{
      async getEntrepreneurships(){
        await axios.get('tutor/tutors').then((response) =>{
          this.entrepreneurships = response.data.evaluator.entrepreneurships
          this.loading=false;
        }).catch(error => {
          console.log(error);
        })
      },

      showTasks(slug){
        this.$router.push({ name: 'EntrepreneurshipTasksTutor', params: { slug: slug } })
      }
    },

    created(){
      this.getEntrepreneurships()
    }
  }
</script>
<style>
.zoom {
  cursor:pointer;
  padding: 50px;
  transition: transform .15s; /* Animation */
}

.zoom:hover {
  transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>