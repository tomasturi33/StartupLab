<template>
  <v-row>

    <v-col cols="12">
      <v-img
        :src="require('@/assets/img/potencia.png')"
        contain
        max-height="540"
      />
    </v-col>

    <v-col cols="12" class="mt-8 pt-8 pb-8">
      <v-row>
      
        <v-col cols="12" xl="2" md="2" sm="4" xs="6">
          <v-hover>
            <template v-slot:default="{ hover }">
              <v-card
                class="mx-auto pa-3"
                max-width="136"
              >
                <v-img :src="require('@/assets/icons/home_accepted/postulation_idea.png')"></v-img>

                <v-fade-transition>
                  <v-overlay
                    v-if="hover"
                    absolute
                    color="#036358"
                  >
                    <v-btn
                      @click="show1">
                      Ver más
                    </v-btn>
                  </v-overlay>
                </v-fade-transition>
              </v-card>
            </template>
          </v-hover>
        </v-col>

        <v-col cols="12" xl="2" md="2" sm="4" xs="6">
          <v-hover>
            <template v-slot:default="{ hover }">
              <v-card
                class="mx-auto pa-3"
                max-width="136"
              >
                <v-img :src="require('@/assets/icons/home_accepted/feedback.png')"></v-img>

                <v-fade-transition>
                  <v-overlay
                    v-if="hover"
                    absolute
                    color="#036358"
                  >
                  <v-btn
                      @click="show2">
                      Ver más
                    </v-btn>
                  </v-overlay>
                </v-fade-transition>
              </v-card>
            </template>
          </v-hover>
        </v-col>

        <v-col cols="12" xl="2" md="2" sm="4" xs="6">
          <v-hover>
            <template v-slot:default="{ hover }">
              <v-card
                class="mx-auto pa-3"
                max-width="136"
              >
                <v-img :src="require('@/assets/icons/home_accepted/selection.png')"></v-img>

                <v-fade-transition>
                  <v-overlay
                    v-if="hover"
                    absolute
                    color="#036358"
                  >
                  <v-btn
                      @click="show3">
                      Ver más
                    </v-btn>
                  </v-overlay>
                </v-fade-transition>
              </v-card>
            </template>
          </v-hover>
        </v-col>

        <v-col cols="12" xl="2" md="2" sm="4" xs="6">
          <v-hover>
            <template v-slot:default="{ hover }">
              <v-card
                class="mx-auto pa-3"
                max-width="136"
              >
                <v-img :src="require('@/assets/icons/home_accepted/pre_incubation.png')"></v-img>

                <v-fade-transition>
                  <v-overlay
                    v-if="hover"
                    absolute
                    color="#036358"
                  >
                    <v-btn
                      @click="$router.push('/home/pre-incubation')">
                      Ver más
                    </v-btn>
                  </v-overlay>
                </v-fade-transition>
              </v-card>
            </template>
          </v-hover>
        </v-col>

        <v-col cols="12" xl="2" md="2" sm="4" xs="6">
          <v-hover>
            <template v-slot:default="{ hover }">
              <v-card
                class="mx-auto pa-3"
                max-width="136"
              >
                <v-img :src="require('@/assets/icons/home_accepted/incubation.png')"></v-img>

                <v-fade-transition>
                  <v-overlay
                    v-if="hover"
                    absolute
                    color="#036358"
                  >
                    <v-btn
                      @click="show5">
                      Ver más
                    </v-btn>
                  </v-overlay>
                </v-fade-transition>
              </v-card>
            </template>
          </v-hover>
        </v-col>

        <v-col cols="12" xl="2" md="2" sm="4" xs="6">
          <v-hover>
            <template v-slot:default="{ hover }">
              <v-card
                class="mx-auto pa-3"
                max-width="136"
              >
                <v-img :src="require('@/assets/icons/home_accepted/pre_aceleration.png')"></v-img>

                <v-fade-transition>
                  <v-overlay
                    v-if="hover"
                    absolute
                    color="#036358"
                  >
                    <v-btn
                      @click="show6">
                      Ver más
                    </v-btn>
                  </v-overlay>
                </v-fade-transition>
              </v-card>
            </template>
          </v-hover>
        </v-col>
      </v-row>
    </v-col>

    <v-dialog
      v-model="dialog"
      width="450"
    >
      <v-card>
        <v-card-title class="text-h5">
          {{ title }}
        </v-card-title>

        <v-card-text>
          {{ messange }}
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog = false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
      
  </v-row>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    name: 'entrepreneurEmpty',
    data: () => ({
      loading:true,
      dialog:false,
      title:'',
      messange:''
    }),

    computed: {
      ...mapGetters([
        'isLogged', 'drawer', 'user'
      ])
    },

    methods:{
      show1(){
        this.title="Postulación de Ideas"
        this.messange= "Período de inscripción destinado a personas humanas con ideas de negocio y/o startups (que tengan como máximo 1 año en el mercado) con potencial de crecimiento y un grado destacable de diferenciación o innovación."
        this.dialog=true
      },
      
      show2(){
        this.title="Feedback"
        this.messange= "El feedback consiste en entrevistas con miembros del comité de selección a fin de ampliar detalles o disipar dudas provenientes de la aplicación. Esto les permitiría realizar ajustes y modificaciones para adecuar el formulario de inscripción."
        this.dialog=true
      },

      show3(){
        this.title="Selección"
        this.messange= "Podrán resultar seleccionadas hasta 20 startups por convocatoria que ingresarán a la etapa de preincubación, pudiendo ampliarse este cupo a criterio del Programa. La evaluación será realizada por una comisión evaluadora ad hoc. Como resultado de este procedimiento se confeccionará un orden de mérito que determinará qué startups ingresarán a la etapa de Preincubación. "
        this.dialog=true
      },

      show5(){
        this.title="Incubación"
        this.messange= "En esta segunda etapa, que dura 12 meses, las startups ya han diseñado un esquema mínimo de negocio, por lo que aquí proponemos validar aquellos supuestos incluidos en el negocio, con ánimo de gestionar los riesgos inherentes propios a la creación de una nueva empresa. Para ello, las startups tendrán a disposición espacios de capacitación orientados a la creación y formalización de su empresa. En idéntico sentido, tendrán feedback entre pares y con empresarios. La finalización exitosa de esta etapa requerirá del cumplimiento de los trabajos prácticos y su aprobación. "
        this.dialog=true
      },

      show6(){
        this.title="Pre-aceleración"
        this.messange= "Por último, a lo largo de seis meses, en la pre aceleración se trabaja exclusivamente sobre el lanzamiento al mercado, facilitando las condiciones para ello y cooperando en la búsqueda del financiamiento necesario para hacerlo posible, sea público o privado y alianzas estratégicas que les permitan concretar esta acción."
        this.dialog=true
      }
    }
  }
</script>
<style scoped>

@keyframes float {
	0% {
		transform: translatey(0px);
    transform: rotate(0deg);
	}
	33% {
		transform: translatey(-50px);
    transform: rotate(2deg);
	}
  66% {
		transform: translatey(50px);
    transform: rotate(-2deg);
	}
	100% {
		transform: translatey(0px);
    transform: rotate(0deg);
	}
}

.avatar {
	transform: translatey(0px);
	animation: float 6s ease-in-out infinite;
}

</style>