<template>
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
          xl="3" 
          md="3" 
          sm="12" 
          class="text-lg-right text-md-right text-sm-left">
            <label class="font-weight-regular text-uppercase">
              Edición:
            </label>
        </v-col>
        <v-col 
          cols="12" 
          xl="9" 
          md="9" 
          sm="12">
            <label class="font-weight-light">
              {{ name }}
            </label>
        </v-col>

        <v-col 
          cols="12" 
          xl="3" 
          md="3" 
          sm="12" 
          class="text-lg-right text-md-right text-sm-left"
          v-show="description">
            <label class="font-weight-regular text-uppercase">
              Descripción:
            </label>
        </v-col>

        <v-col 
          cols="12" 
          xl="9" 
          md="9" 
          sm="12"
          v-show="description">
            <label class="font-weight-light">
              {{ description }}
            </label>
        </v-col>
      </v-row>  
    </v-sheet>
  </v-col>
</template>
<script>
  export default {
    props:['name', 'description'],
  }
</script>