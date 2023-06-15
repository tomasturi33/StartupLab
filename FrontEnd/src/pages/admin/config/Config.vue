<template>
  <v-sheet 
    width="100%"
    outlined
    >
    <v-row class="pa-6">
      <v-col cols="12" xl="6" md="6" sm="12">
        <v-btn
          class="pa-8"
          block 
          xl
          :to="{name:'academicUnits'}"
          color="primary">
          Unidades académicas UNL
        </v-btn>
      </v-col>

      <v-col cols="12" xl="6" md="6" sm="12">
        <v-btn
          class="pa-8"
          block 
          xl
          :to="{name:'careers'}"
          color="primary">
          Carreras UNL
        </v-btn>
      </v-col>

      <v-col cols="12" xl="6" md="6" sm="12">
        <v-btn
          class="pa-8"
          block 
          xl
          :to="{name:'verticalWorks'}"
          color="primary">
          Verticales de trabajo
        </v-btn>
      </v-col>

      <v-col cols="12" xl="6" md="6" sm="12">
        <v-btn
          class="pa-8"
          block 
          xl
          :to="{name:'entrepreneurshipNeed'}"
          color="primary">
          Necesidades emprendimientos
        </v-btn>
      </v-col>

      <v-col cols="12" xl="6" md="6" sm="12">
        <v-btn
          class="pa-8"
          block 
          xl
          :to="{name:'provincias'}"
          color="primary">
          Provincias
        </v-btn>
      </v-col>

      <v-col cols="12" xl="6" md="6" sm="12">
        <v-btn
          class="pa-8"
          block 
          xl
          :to="{name:'localidades'}"
          color="primary">
          Localidades
        </v-btn>
      </v-col>
    </v-row>
  </v-sheet>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'Users',

    data: () => ({
      loading:true,
      show:false,
      
      dialog:false,
      name:'',

      Edition:false,

      users:null,

      search: '',
      headers: [
        {
          text: 'Edición',
          align: 'start',
          filterable: false,
          value: 'name',
        },
        { text: 'Estado', value: 'published' },
        { text: 'Acciones', value: 'actions' },
      ],
    }),

    methods:{
      async getUsers()
      {
        await axios.get('admin/users').then(response =>{
          this.users = response.data
          this.loading=false
          this.show=true
        }).catch(error => {
          console.log(error);
        })
      },

      newUser()
      {
        this.name = ''

        this.dialog = true
      },

      async createEdition()
      {
        try {
          await axios.post('users',{name: this.name, pre_incubation: false, incubation: false, pre_aceleration: false})
            .then(response =>{
                console.log(response.data.edition.slug)
                this.$router.push({ name: 'editEdition', params: { slug: response.data.edition.slug } })  
              })
            } catch (error) {
              console.error(error.response.data);     // NOTE - use "error.response.data` (not "error")
            }
      },

      showEdition(slug)
      {
        this.$router.push({ name: 'showEdition', params: { slug: slug } })
      },

      editEdition(slug)
      {
        this.$router.push({ name: 'editEdition', params: { slug: slug } })
      },

      async deleteEdition(id)
      {
        if (confirm('¿Seguro que deseas eliminar esta edición?')) {
          try {
            await axios.delete('users/'+id).then(() =>{
              this.getUsers()
            })
          } catch (error) {
            console.error(error.response.data);
          }
        }
      }

    },
    created(){
    },
  }
</script>