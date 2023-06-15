<template>
  <v-row>
    <v-col cols="12"> 
    
      <v-text-field
        class="ma-4"
        v-model="search"
        append-icon="mdi-magnify"
        label="Buscar"
        single-line
        hide-details
      ></v-text-field>  

      <v-data-table
        class="pt-8"
        :loading="loading"
        :headers="headers"
        :items="entrepreneurships"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        :search="search"
        :custom-filter="customSearch"
        :items-per-page="30"
        :header-props="headerProps"
        :footer-props="{
          'items-per-page-options': [10, 20, 30, 40, 50, 100],
          'items-per-page-text':'Emprendedores por página',
        }"
        mobile="true"
      >
        <template v-slot:item.actions="{ item }">
          <v-btn
            class="mx-2"
            fab
            dark
            x-small
            color="primary"
            @click="showItem(item.id)"
          >
            <v-icon dark small>
              mdi-eye
            </v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </v-col>
  </v-row>
</template>
<script>
  import axios from 'axios'

  export default {
    name: 'inProgress',

    data: () => ({
      edition_id:null,
      loading:true,
      entrepreneurships:[],
      //filterOnlyCapsText:null,
      internalCurrentItems : null,
      search: '',
      sortBy: 'id',
      sortDesc: true,
      headerProps: {
        sortByText: "Ordenar por"
      },
      headers: [
        {
          text: '#',
          align: 'center',
          sortable: true,
          value: 'id',
          width: '5%'
        },
        {
          text: 'StartUp',
          align: 'start',
          sortable: true,
          value: 'title',
          width: '75%'
        },
        {
          text: 'Acciones',
          align: 'center',
          sortable: false,
          value: 'actions',
          width: '20%'
        }
      ]
    }),

    methods:{
      customSearch (value, search, item) {
          return Object.values(item).some(v=>v&&v.toString().toLowerCase().includes(search))
      },
      
      filterOnlyCapsText (value, search, item) {
        console.log(item)
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().toLocaleUpperCase().indexOf(search) !== -1
      },

      async getEntrepreneurshipsInProgress(){
        this.show=false
        await axios.get('admin/edition/'+this.edition_id+'/convocation-form/in-progress').then(response =>{
          this.entrepreneurships = response.data.entrepreneurships
          this.loading = false
        }).catch(error => {
          console.log(error)
        })
      },

      showItem(id){
        this.$router.push({ name: 'showConvocationFormEdition', params: { convocation_form_id: id } })
      }
    },

    created(){
      this.edition_id = this.$route.params.edition_id;
      this.getEntrepreneurshipsInProgress()
    },
  }
</script>