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
            
            <p class="text-pre-wrap font-weight-light pt-4">
              {{ user.name + ' ' + user.lastname  }}
            </p>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Correo electrónico
            </p>
            
            <p class="text-pre-wrap font-weight-light pt-4">
              {{ user.email }}
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

          <v-col cols="12" xl="4" md="4" sm="12">
            <p class="font-weight-regular text-uppercase">
              Vertical de trabajo:
            </p>
            
            <p class="text-pre-wrap font-weight-light pt-4">
              {{ vertical_works.name }}
            </p>
          </v-col>

          <v-col cols="12" xl="4" md="4" sm="12">
            <p class="font-weight-regular text-uppercase">
              Estadio de la StartUp:
            </p>
            
            <p class="text-pre-wrap font-weight-light pt-4">
              {{ entrepreneurship_stadia.name }}
            </p>
          </v-col>

          <v-col cols="12" xl="4" md="4" sm="12">
            <p class="font-weight-regular text-uppercase">
              Grado de desarrollo actual:
            </p>
            
            <p class="text-pre-wrap font-weight-light pt-4">
              {{ (entrepreneurship_stadia.id===2)?development_degrees.name:'--' }}
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
            
            <p class="text-pre-wrap font-weight-light pt-4">
              {{ provincia.name  }}
            </p>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Localidad:
            </p>
            
            <p class="text-pre-wrap font-weight-light pt-4">
              {{ localidad.name }}
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
              Titulo de la idea:
            </label>
          </v-col>
          <v-col cols="12">
            <label class="font-weight-light">
              {{ title }}
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
              {{ executive_summary }}
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
              {{ problem_detected }}
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
              {{ proposed_solution }}
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
              {{ products_services_you_offer }}
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
              {{ market }}
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
              {{ entrepreneurial_team }}
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
              {{ action_plan }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2" v-if="need_startup.length>0">
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
            <p class="font-weight-light text" v-for="need in need_startup" :key="need.id">
              - {{ need.entrepreneurship_need.name }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2" v-if="video">
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
              {{ video }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2" v-if="curriculum_idea.length>0">
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
            <p class="font-weight-light text" v-for="cv in curriculum_idea" :key="cv.id">
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
    props: [
            'user',
            'provincia',
            'localidad',
            'entrepreneurship_stadia',
            'development_degrees',
            'vertical_works',

            'title',
            'executive_summary',
            'problem_detected',
            'proposed_solution',
            'products_services_you_offer',
            'market',
            'entrepreneurial_team',
            'action_plan',
            'need_startup',
            'video',
            'curriculum_idea'],
  }
</script>