<template>
  <v-row class="scrollable">
    <v-col class="scrollable-cards" hide-scroll-bar>
      <v-col
        v-for="(module, id) in entrepreneurships_by_module" :key="id"
        width="380px">
        
        <v-col cols="12">
          <v-card
            class="pa-2"
            color="info"
            dark
            width="400px"
            min-height="72px"
            outlined>
            <h4>{{ module.module_name }}</h4>
          </v-card>
        </v-col>

        <v-col cols="12" 
          v-for="(entrepreneurship, id) in module.entrepreneurships" :key="id">

          <notesCard :entrepreneurship_id="entrepreneurship.entrepreneurship_id" :entrepreneurship_title="entrepreneurship.entrepreneurship.title"/>

        </v-col>

      </v-col>
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
    import notesCard from '@/components/notes/notesCard'
  
    export default {
      name: 'EntrepreneurshipsTrello',
      components:{notesCard},
      props:['edition_id'],
      data: () => ({
        loading:true,
        show:false,
        
        dialog:false,
        name:'',
  
        entrepreneurships:[],
        modules_pre_incubation: [],
        entrepreneurships_by_module: []
      }),

      watch:{
        edition_id: {
          handler: function() {
              this.getEntrepreneurships(); // call it in the context of your component object
          },
          deep: true
        }
      },
  
      methods:{
        async getEntrepreneurships(){
          if(this.edition_id){
            this.loading=true
            await axios.get('admin/entrepreneurships/'+this.edition_id+'/entrepreneurship-trello').then(response =>{
              this.entrepreneurships = response.data.data.entrepreneurships
              this.modules_pre_incubation = response.data.data.modules_pre_incubation
              this.entrepreneurships_by_module = response.data.data.entrepreneurships_by_module
              this.loading = false
            }).catch(error => {
              console.log(error);
            })
          }
        },

        showCard(id){
          alert(id)
        }
      },
  
      created(){
        this.getEntrepreneurships()
      },
    }
  </script>
  <style>
  .scrollable {
    overflow: auto;
  }
  
  .cards-row {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .scrollable-cards {
    display: flex;
    flex-wrap: nowrap;
  }
  </style>