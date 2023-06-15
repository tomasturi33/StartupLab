<template>
  <v-row>

    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Convocatoria enviada por:
            </p>
            
            <p class="font-weight-light pt-4">
              {{ entrepreneurship.user.name + ' ' + entrepreneurship.user.lastname  }}
            </p>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Correo electrónico
            </p>
            
            <p class="font-weight-light pt-4">
              {{ entrepreneurship.user.email }}
            </p>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Vertical de trabajo:
            </p>
            
            <p class="font-weight-light pt-4">
              {{ entrepreneurship.vertical_works.name }}
            </p>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Estadio de la StartUp:
            </p>
            
            <p class="font-weight-light pt-4">
              {{ entrepreneurship.entrepreneurship_stadia.name }}
            </p>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Grado de desarrollo actual:
            </p>
            
            <p class="font-weight-light pt-4">
              {{ (entrepreneurship.entrepreneurship_stadia.id===2)?entrepreneurship.development_degrees.name:'--' }}
            </p>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Provincia:
            </p>
            
            <p class="font-weight-light pt-4">
              {{ entrepreneurship.provincia.name  }}
            </p>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Localidad:
            </p>
            
            <p class="font-weight-light pt-4">
              {{ entrepreneurship.localidad.name }}
            </p>
          </v-col>

        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Nombre de la StartUp:
            </label>
          </v-col>
          <v-col cols="12">
            <label class="font-weight-light">
              {{ entrepreneurship.title }}
            </label>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Resumen Ejecutivo:
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text">
              {{ entrepreneurship.executive_summary }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Problema detectado:
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text">
              {{ entrepreneurship.problem_detected }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Solución propuesta:
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text">
              {{ entrepreneurship.proposed_solution }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Producto ó servicio que ofrece:
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text">
              {{ entrepreneurship.products_services_you_offer }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Mercado:
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text">
              {{ entrepreneurship.market }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Equipo emprendedor:
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text">
              {{ entrepreneurship.entrepreneurial_team }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Plan de acción:
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text">
              {{ entrepreneurship.action_plan }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2" v-if="entrepreneurship.need_startup.length>0">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              ¿Qué estas buscando de la convocatoria?
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text" v-for="need in entrepreneurship.need_startup" :key="need.id">
              - {{ need.entrepreneurship_need.name }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2" v-if="entrepreneurship.video">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Video:
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text">
              {{ entrepreneurship.video }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2" v-if="entrepreneurship.curriculum.length>0">
      <v-sheet
        width="100%"
        outlined 
      >
        <v-row class="pa-8">
          <v-col cols="12">
            <label class="font-weight-regular text-uppercase">
              Curriculum de la Idea:
            </label>
          </v-col>
          <v-col cols="12">
            <p class="font-weight-light text" v-for="cv in entrepreneurship.curriculum" :key="cv.id">
              <b>- {{ cv.type }}:</b><br>
              {{ cv.description }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

  </v-row>
</template>
<script>

  export default {
    props: ['entrepreneurship'],
  }
</script>