<template>
  <v-col cols="12" class="pt-2">
    <v-sheet
        width="100%"
        outlined 
      >
      <v-row class="pa-4">

        <v-col class="pl-4" cols="12">
          <h3 class="font-weight-regular">Estadios:</h3>
        </v-col>

        <v-col 
          cols="12" 
          xl="9" 
          md="9" 
          sm="12">
          
        </v-col> 

        <v-col cols="12">
          <v-expansion-panels focusable>
            <v-expansion-panel>
              <v-expansion-panel-header 
                color="info" 
                class="white--text font-weight-regular text-uppercase">
                Modulos pre-incubación
              </v-expansion-panel-header>
              <v-expansion-panel-content>
              
                <v-simple-table class="pa-4">
                  <template v-slot:default>
                    <thead>
                      <tr>
                        <th class="text-center">
                          <b>
                            Modulo
                          </b>
                        </th>
                        <th class="text-center">
                          <b>Ver</b>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="item in module_pre_incubations"
                        :key="item.name"
                      >
                        <td>{{ item.name }}</td>
                        <td class="text-center">
                          <v-btn
                            class="mx-2"
                            fab
                            dark
                            x-small
                            color="primary"
                            @click="showModule(item.id)"
                          >
                            <v-icon dark small>
                              mdi-eye
                            </v-icon>
                          </v-btn>

                        </td>
                      </tr>
                    </tbody>
                  </template>
                </v-simple-table>     
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </v-col>

      </v-row>
    </v-sheet>
  </v-col>
</template>
<script>
  export default {
    props:['module_pre_incubations'],
  }
</script>