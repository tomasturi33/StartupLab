<template>
  <v-footer>
    <v-row class="pa-8 mt-8">
      <v-col cols="12" xl="6" md="6" sm="6" xs="12" v-if="!$vuetify.breakpoint.xs">
        <v-img 
          alt="UNL" 
          class="ml-8" 
          contain 
          height="78px" 
          position="center left" 
          :src="require('@/assets/icons/unl_identidad.svg')">
        </v-img>
      </v-col>

      <v-col cols="12" xl="6" md="6" sm="6" xs="12" class="lista1">
        <v-row class="d-flex justify-end">
          <v-col class="d-flex justify-end">
            <a class="ma-2" href="https://www.facebook.com/VinculacionUNL/" target="_blank">
              <v-img 
                alt="UNL" 
                contain
                width="18px" 
                height="18px"
                :src="require('@/assets/icons/facebook.svg')">
              </v-img>
            </a>
              
            <a class="ma-2" href="https://twitter.com/vinculacionunl/" target="_blank">
              <v-img 
                alt="UNL" 
                contain
                width="18px" 
                height="18px" 
                :src="require('@/assets/icons/twitter.svg')">
              </v-img>
            </a>
              
            <a class="ma-2" href="https://www.instagram.com/vinculacionunl/" target="_blank">
              <v-img 
                alt="UNL" 
                contain
                width="18px" 
                height="18px" 
                :src="require('@/assets/icons/instagram.svg')">
              </v-img>
            </a>
              
            <a class="ma-2" href="https://www.linkedin.com/in/vinculaciontecnologicaunl/" target="_blank">
              <v-img 
                alt="UNL" 
                contain
                width="18px" 
                height="18px" 
                :src="require('@/assets/icons/linkedin.svg')">
              </v-img>
            </a>
          </v-col>
        </v-row>

        <v-row>
          <v-col>
            <v-divider dark></v-divider>
          </v-col>
        </v-row>

        <v-row>
          <v-col>
            <p class="white--text text-right">
              © 2022 UNIVERSIDAD NACIONAL DEL LITORAL<br>
              potencia@unl.edu.ar · Psj. Martinez 2626 - (3000) Santa Fe · Tel: 54 342 4551211 / 4571234 int. 130
            </p>
          </v-col>
        </v-row>

      </v-col>
    </v-row>
  </v-footer>
</template>
<script>

export default {

  data: () => ({
    loading:false,

  })
};
</script>
<style scoped>
.v-footer{
  background: linear-gradient(to right,#00a1b8 0%,#23495c 100%) !important;
}

.lista1 {
  display: inline-block;
}

.lista1 v-img {
  display: inline-block;
}

</style>