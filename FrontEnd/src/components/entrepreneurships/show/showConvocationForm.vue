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
              {{ convocation_form.user.name + ' ' + convocation_form.user.lastname  }}
            </p>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Correo electrónico
            </p>
            
            <p class="font-weight-light pt-4">
              {{ convocation_form.user.email }}
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
            
            <p class="font-weight-light pt-4">
              {{ convocation_form.vertical_works.name }}
            </p>
          </v-col>

          <v-col cols="12" xl="4" md="4" sm="12">
            <p class="font-weight-regular text-uppercase">
              Estadio de la StartUp:
            </p>
            
            <p class="font-weight-light pt-4">
              {{ convocation_form.entrepreneurship_stadia.name }}
            </p>
          </v-col>

          <v-col cols="12" xl="4" md="4" sm="12">
            <p class="font-weight-regular text-uppercase">
              Grado de desarrollo actual:
            </p>
            
            <p class="font-weight-light pt-4">
              {{ (convocation_form.entrepreneurship_stadia.id===2)?convocation_form.development_degrees.name:'--' }}
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
              {{ convocation_form.provincia.name  }}
            </p>
          </v-col>

          <v-col cols="12" xl="6" md="6" sm="12">
            <p class="font-weight-regular text-uppercase">
              Localidad:
            </p>
            
            <p class="font-weight-light pt-4">
              {{ convocation_form.localidad.name }}
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
              {{ convocation_form.title }}
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
              {{ convocation_form.executive_summary }}
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
              {{ convocation_form.problem_detected }}
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
              {{ convocation_form.proposed_solution }}
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
              {{ convocation_form.products_services_you_offer }}
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
              {{ convocation_form.market }}
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
              {{ convocation_form.entrepreneurial_team }}
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
              {{ convocation_form.action_plan }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2" v-if="convocation_form.idea_need.length>0">
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
            <p class="font-weight-light text" v-for="need in convocation_form.idea_need" :key="need.id">
              - {{ need.entrepreneurship_need.name }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2" v-if="convocation_form.video">
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
              {{ convocation_form.video }}
            </p>
          </v-col>
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-2" v-if="convocation_form.curriculum_idea.length>0">
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
            <p class="font-weight-light text" v-for="cv in convocation_form.curriculum_idea" :key="cv.id">
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
    props: ['convocation_form'],
  }
</script>