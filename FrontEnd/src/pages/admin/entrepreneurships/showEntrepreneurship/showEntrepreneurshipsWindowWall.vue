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
        :to="{ name: 'entrepreneurships' }"
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
    name: 'showEntrepreneurshipsWindow',
    components: {showWindow},
    data: () => ({
      loading: true,
      entrepreneurship_id:null,
      entrepreneurship:null,
    }),

    methods:{
      async getWindowEntrepreneurship(){
        await axios.get('admin/entrepreneurships/1/entrepreneurship-windows/'+this.entrepreneurship_id).then(response =>{
          this.entrepreneurship = response.data.window
          this.loading = false
        }).catch(error => {
          this.loading = false
          console.log(error);
        })
      }
    },

    created(){
       this.entrepreneurship_id = this.$route.params.id;
       this.getWindowEntrepreneurship()
    },
  }
</script>
<style>
.images {
  position: fixed;
}
</style>