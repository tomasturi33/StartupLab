<template>
  <v-row>
    <v-col cols="12">
      <showWindow v-if="!loading" :entrepreneurship="entrepreneurship"/>
    </v-col>

    <v-col cols="12" class="pt-8 d-sm-flex">
      <v-btn
        depressed
        color="primary"
        :block="$vuetify.breakpoint.xsOnly"
        class="mr-auto mt-2"
        :to="{ name: 'showEntrepreneurshipsEdition'}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>
      <v-spacer />
      <v-btn
        depressed
        :block="$vuetify.breakpoint.xsOnly"
        class="mr-2 mt-2"
        color="primary"
        disabled
        >
        Descargar PDF
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
  import showWindow from '@/components/entrepreneurships/show/showWindow'

  export default {
    name: 'showOtherEntrepreneurships',
    components: {showWindow},
    data: () => ({
      loading:true,
      slug:'',
      edition_id:null,
      entrepreneurship_id:null,
      convocation_form_id:null,
      entrepreneurship:null,
    }),

    methods:{
      async getWindowEntrepreneurship(){
        await axios.get('admin/edition/'+this.edition_id+'/entrepreneurships/'+this.convocation_form_id+'/show-window').then(response =>{
          this.entrepreneurship = response.data.window
          this.loading = false
        }).catch(error => {
          this.loading = false
          console.log(error);
        })
      },
    },

    created(){
       this.edition_id = this.$route.params.edition_id;
       this.entrepreneurship_id = this.$route.params.entrepreneurship_id;
       this.convocation_form_id = this.$route.params.convocation_form_id;
       this.getWindowEntrepreneurship()
    },
  }
</script>
<style>
.images {
  position: fixed;
}
</style>