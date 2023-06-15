<template>
  <v-col cols="12" class="pt-2">
    <v-sheet
        width="100%"
        outlined
      >
      <v-responsive
        class="overflow-y-auto"
        height="400"
      >
        <v-row class="pa-4">
          <v-col cols="12">
            <h3 class="font-weight-regular">Terminos y condiciones de la edición:</h3>
          </v-col>

          <v-col 
            cols="12"
            v-show="terms_and_conditions">
              <p class="text">
                {{ terms_and_conditions }}
              </p>
          </v-col>

        </v-row>  
      </v-responsive>
    </v-sheet>
  </v-col>
</template>
<script>
  export default {
    props:['terms_and_conditions'],
  }
</script>