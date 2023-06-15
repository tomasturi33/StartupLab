<template>
  <v-col cols="12" class="pt-2">
    <v-sheet
        width="100%"
        outlined 
        v-if="!published"
      >
      <v-row class="pa-4">

        <v-col class="pl-4" cols="12">
          <h3 class="font-weight-regular">Convocatoria:</h3>
        </v-col>

        <v-col 
          cols="12" 
          xl="3" 
          md="3" 
          sm="12" 
          class="text-lg-right text-md-right text-sm-left">
            <label class="font-weight-regular text-uppercase">
              Estado:
            </label>
        </v-col>
        <v-col 
          cols="12" 
          xl="9" 
          md="9" 
          sm="12">
            <label class="font-weight-light">
              {{ published ? 'Publicada' : 'No publicada' }}
            </label>
        </v-col>
      </v-row>
    </v-sheet>

    <v-sheet
        width="100%"
        outlined 
        v-if="published"
      >
      <v-row class="pa-4">

        <v-col class="pl-4" cols="12">
          <h3 class="font-weight-regular">Convocatoria:</h3>
        </v-col>

        <v-col 
          cols="12" 
          xl="3" 
          md="3" 
          sm="12" 
          class="text-lg-right text-md-right text-sm-left">
            <label class="font-weight-regular text-uppercase">
              Estado:
            </label>
        </v-col>
        <v-col 
          cols="12" 
          xl="9" 
          md="9" 
          sm="12">
            <label class="font-weight-light">
              {{ published ? 'Publicada' : 'No publicada' }}
            </label>
        </v-col>

        <v-col 
          cols="12" 
          xl="3" 
          md="3" 
          sm="12" 
          class="text-lg-right text-md-right text-sm-left">
            <label class="font-weight-regular text-uppercase">
              Fecha de inicio:
            </label>
        </v-col>
        <v-col 
          cols="12" 
          xl="3" 
          md="3" 
          sm="12">
            <label class="font-weight-light">
              {{ start_date }}
            </label>
        </v-col>

        <v-col 
          cols="12" 
          xl="3" 
          md="3" 
          sm="12" 
          class="text-lg-right text-md-right text-sm-left">
            <label class="font-weight-regular text-uppercase">
              Hora de inicio:
            </label>
        </v-col>
        <v-col 
          cols="12" 
          xl="3" 
          md="3" 
          sm="12">
            <label class="font-weight-light">
              {{ start_time }}
            </label>
        </v-col>

        <v-col 
          cols="12" 
          xl="3" 
          md="3" 
          sm="12" 
          class="text-lg-right text-md-right text-sm-left">
            <label class="font-weight-regular text-uppercase">
              Fecha de finalización:
            </label>
        </v-col>
        <v-col 
          cols="12" 
          xl="3" 
          md="3" 
          sm="12">
            <label class="font-weight-light">
              {{ finish_date }}
            </label>
        </v-col>

        <v-col 
          cols="12" 
          xl="3" 
          md="3" 
          sm="12" 
          class="text-lg-right text-md-right text-sm-left">
            <label class="font-weight-regular text-uppercase">
              Hora de finalización:
            </label>
        </v-col>
        <v-col 
          cols="12"
          xl="3"
          md="3"
          sm="12">
            <label class="font-weight-light">
              {{ finish_time }}
            </label>
        </v-col>

      </v-row>  
    </v-sheet>
  </v-col>
</template>
<script>
  export default {
    props:['published', 'start_date', 'start_time', 'finish_date', 'finish_time'],
  }
</script>