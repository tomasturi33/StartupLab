<template>
  <v-row>
    <v-col cols="12">
      <v-sheet
        width="100%"
        outlined 
        >
        <v-row class="ma-1">

          <v-col cols="12">
            <h2 class="font-weight-light">Mi vidriera:</h2>
          </v-col>

          <v-col cols="12">
            <v-text-field
              :maxlength="200"
              :counter="200"
              :rules="[v => (v || '' ).length <= 180 || 'El nombre de la idea no debe tener mas de 200 caracteres']"
              ref="title"
              outlined
              v-model="title"
              label="Titulo"
              required
            ></v-text-field>

            <v-textarea
              :maxlength="300"
              :counter="300"
              :rules="[v => (v || '' ).length <= 280 || 'El resumen ejecutivo no debe tener mas de 200 caracteres']"
              outlined
              ref="executive_summary"
              name="executive_summary"
              v-model="executive_summary"
              label="Resumen ejecutivo"
            ></v-textarea>

            <v-textarea
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1480 || 'El problema detectado no debe tener mas de 1500 caracteres']"
              outlined
              ref="problem_detected"
              name="problem_detected"
              v-model="problem_detected"
              label="Problema detectado"
            ></v-textarea>

            <v-textarea
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1480 || 'La solición propuesta no debe tener mas de 1500 caracteres']"
              outlined
              ref="proposed_solution"
              name="proposed_solution"
              v-model="proposed_solution"
              label="Solución propuesta"
            ></v-textarea>

            <v-textarea
              :maxlength="2000"
              :counter="2000"
              :rules="[v => (v || '' ).length <= 1980 || 'El mercado no debe tener mas de 2000 caracteres']"
              outlined
              ref="market"
              name="market"
              v-model="market"
              label="Mercado"
            ></v-textarea>

            <v-textarea
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1480 || 'El mercado no debe tener mas de 1500 caracteres']"
              outlined
              ref="strategic_alliance"
              name="strategic_alliance"
              v-model="strategic_alliance"
              label="Alianzas estratégicas"
            ></v-textarea>

            <v-textarea
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1480 || 'El mercado no debe tener mas de 1500 caracteres']"
              outlined
              ref="entrepreneurial_team"
              name="entrepreneurial_team"
              v-model="entrepreneurial_team"
              label="Equipo emprendedor (integrantes, roles, aportes)"
            ></v-textarea>

            <v-textarea
              outlined
              :maxlength="1500"
              :counter="1500"
              :rules="[v => (v || '' ).length <= 1480 || 'El plan de acción no debe tener mas de 1500 caracteres']"
              ref="contact"
              name="contact"
              v-model="contact"
              label="Datos de contacto"
            ></v-textarea>

            <v-select
              :items="items"
              v-model="degree_development"
              item-text="name"
              item-value="id"
              label="Grado de desarrollo"
              outlined
            ></v-select>
          </v-col>

          <v-col cols="12">
            <h2 class="font-weight-light">Logo:</h2>
          </v-col>

          <v-col cols="12">
            <v-file-input
              outlined
              v-if="!logo"
              v-model="logo"
              :rules="rules"
              @change="onLogoChange"
              accept="image/png, image/jpeg, image/bmp"
              prepend-icon="mdi-camera"
              label="Logo"
              :messages="['Para una mejor visualización, usar un logo cuadrado, y si tiene transparencia asegurarse de que sea formato PNG.']"
            ></v-file-input>

            <v-card
              max-width="380px"
              v-if="logo"
              wei>
              <v-img
                contain
                :src="url_logo"
                class="grey lighten-2"
                height="240px"
              >
              </v-img>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon>
                  <v-icon color="black" @click="deleteLogo()">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>            
          </v-col>

          <v-col cols="12">
            <h2 class="font-weight-light">Imagenes <small><small>(máximo cuatro)</small></small>:</h2>
          </v-col>

          <v-col cols="12" xl="3" md="3" sm="12">
            <v-file-input
              outlined
              v-if="!image_1"
              v-model="image_1"
              @change="onImageChange(1)"
              accept="image/png, image/jpeg, image/bmp"
              prepend-icon="mdi-camera"
              label="Imagen 1"
            ></v-file-input>

            <v-card
              max-width="380px"
              v-if="image_1"
              wei>
              <v-img
                contain
                :src="url_image_1"
                class="grey lighten-2"
                height="240px"
              >
              </v-img>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon>
                  <v-icon color="black" @click="deleteImage(1)">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>            
          </v-col>

          <v-col cols="12" xl="3" md="3" sm="12">
            <v-file-input
              outlined
              v-if="!image_2"
              v-model="image_2"
              @change="onImageChange(2)"
              accept="image/png, image/jpeg, image/bmp"
              prepend-icon="mdi-camera"
              label="Imagen 2"
            ></v-file-input>

            <v-card
              max-width="380px"
              v-if="image_2"
              wei>
              <v-img
                contain
                :src="url_image_2"
                class="grey lighten-2"
                height="240px"
              >
              </v-img>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon>
                  <v-icon color="black" @click="deleteImage(2)">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>            
          </v-col>

          <v-col cols="12" xl="3" md="3" sm="12">
            <v-file-input
              outlined
              v-if="!image_3"
              v-model="image_3"
              @change="onImageChange(3)"
              accept="image/png, image/jpeg, image/bmp"
              prepend-icon="mdi-camera"
              label="Imagen 3"
            ></v-file-input>

            <v-card
              max-width="380px"
              v-if="image_3"
              wei>
              <v-img
                contain
                :src="url_image_3"
                class="grey lighten-2"
                height="240px"
              >
              </v-img>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon>
                  <v-icon color="black" @click="deleteImage(3)">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>            
          </v-col>

          <v-col cols="12" xl="3" md="3" sm="12">
            <v-file-input
              outlined
              v-if="!image_4"
              v-model="image_4"
              @change="onImageChange(4)"
              accept="image/png, image/jpeg, image/bmp"
              prepend-icon="mdi-camera"
              label="Imagen 4"
            ></v-file-input>

            <v-card
              max-width="380px"
              v-if="image_4"
              wei>
              <v-img
                contain
                :src="url_image_4"
                class="grey lighten-2"
                height="240px"
              >
              </v-img>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon>
                  <v-icon color="black" @click="deleteImage(4)">mdi-delete</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>            
          </v-col>


          <v-col cols="12">
            <v-divider></v-divider>
          </v-col>

          <v-col cols="12">
            <h2 class="font-weight-light">Video:</h2>
          </v-col>

          <v-col cols="12">

            <v-text-field
              outlined
              v-model="video"
              label="Video"
              :messages="['Links a videos de Youtube']"
            ></v-text-field>
          </v-col>

          <v-col cols="12">
            <v-switch
              v-model="published"
              label="Publicar la vidriera para que sea visible por los demas emprendimientos."
            ></v-switch>
          </v-col>  
        </v-row>
      </v-sheet>
    </v-col>

    <v-col cols="12" class="pt-8 d-flex justify-space-between">
      <v-btn
        depressed
        color="primary"
        :to="{ name: 'myEntrepreneurship'}"
        >
        <v-icon left>
          mdi-arrow-left
        </v-icon>
        Volver
      </v-btn>

      <v-spacer />

      <v-btn
        depressed
        color="primary"
        v-if="published"
        @click="updateMyWindow"
        :loading="loading">
        Guardar y publicar
      </v-btn>

      <v-btn
        depressed
        color="primary"
        v-if="!published"
        @click="updateMyWindow"
        :loading="loading">
        Guardar
      </v-btn>
    </v-col>

    <v-dialog
        v-model="dialog_error"
        max-width="290"
      >
        <v-card>
          <v-card-title class="text-h5">
            
          </v-card-title>

          <v-card-text>
            No pueden quedar campos vacios. Por favor, complete todos los campos.
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
              color="green darken-1"
              text
              @click="dialog_error = false"
            >
              Cerrar
            </v-btn>
          </v-card-actions>
        </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog_upload"
      persistent
      max-width="490"
    >
      <v-card>
        <v-card-title class="text-h5 font-weight-light">
          Cargando Imagenes
        </v-card-title>
        <v-card-text>
          <v-progress-linear
            v-model="uploadPercentage"
            color="primary"
            height="25"
          >
            <strong>{{ uploadPercentage}}%</strong>
          </v-progress-linear>
          <h4 class="font-weight-light" v-if="uploadPercentage!=100">Subiendo archivos al servidor...</h4>
          <h4 class="font-weight-light" v-if="uploadPercentage==100">Esperando respuesta del servidor...</h4>
        </v-card-text>
      </v-card>
    </v-dialog>

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
  const APP_URL = process.env.VUE_APP_URL

  import axios from 'axios'
  import { mapGetters } from 'vuex'

  export default {
    name: 'myStartUp',

    data: () => ({
      show: false,
      dialog_error: false,
      dialog_image:false,
      uploadPercentage:null,
      color:'grey',

      window:[], 
      
      id: null,
      title:'',
      executive_summary:'',
      problem_detected:'',
      proposed_solution:'',
      market:'',
      strategic_alliance:'',
      entrepreneurial_team:'',
      contact:'',

      logo:null,
      url_logo:null,

      image_1: null,
      url_image_1: null,

      image_2: null,
      url_image_2: null,

      image_3: null,
      url_image_3: null,
      
      image_4: null,
      url_image_4: null,

      rules: [
        (value) =>
          !value ||
          value.size < 2 ||
          "file is too big",
      ],

      video: null,

      degree_development: 'MDN reformulado',
      items: ['MDN reformulado', 'Validado', 'Redactado y aprobado', 'En construcción'],

      user_id:null,
      edition_id:null,
      convocation_form_id:null,
      published:false,

      loading:true,
      dialog_upload:false,
    }),
    computed: {
      ...mapGetters([ 
          'convocation_form'
      ])
    },
    methods:{
      addImage(){
        this.image_aux=null
        this.dialog_image=true
      },

      upImage(){
        this.images.push({
          'id': this.image_id,
          'image': this.image_aux,
          'image_url': URL.createObjectURL(this.image_aux)
        })

        this.image_id++
        this.dialog_image=false

      },

      onLogoChange() {
        this.url_logo = URL.createObjectURL(this.logo);
      }, 

      onImageChange(image) {
        switch (image) {
          case 1:
            this.url_image_1 = URL.createObjectURL(this.image_1);
            break
          case 2:
            this.url_image_2 = URL.createObjectURL(this.image_2);
            break
          case 3:
            this.url_image_3 = URL.createObjectURL(this.image_3);
            break
          case 4:
            this.url_image_4 = URL.createObjectURL(this.image_4);
            break
        }
      }, 

      deleteLogo(){
        this.logo=null
        this.url_logo=null
      },

      deleteImage(image) {
        switch (image) {
          case 1:
            this.image_1=null
            this.url_image_1=null
            break
          case 2:
            this.image_2=null
            this.url_image_2=null
            break
          case 3:
            this.image_3=null
            this.url_image_3=null
            break
          case 4:
            this.image_4=null
            this.url_image_4=null
            break
        }
      }, 

      async getMyWindow(){
        await axios.get('entrepreneurship-window/'+ this.convocation_form.convocation_form.id ).then(response =>{

          this.window = response.data.window
          this.id = response.data.window.id
          this.title = response.data.window.title
          this.executive_summary = response.data.window.executive_summary
          this.problem_detected = response.data.window.problem_detected
          this.proposed_solution = response.data.window.proposed_solution
          this.market = response.data.window.market
          this.strategic_alliance = response.data.window.strategic_alliance
          this.entrepreneurial_team = response.data.window.entrepreneurial_team
          this.contact = response.data.window.contact
          this.logo = response.data.window.logo
          this.url_logo = APP_URL + this.logo
          
          this.image_1 = response.data.window.image_1
          this.url_image_1 = APP_URL + this.image_1
          
          this.image_2 = response.data.window.image_2
          this.url_image_2 = APP_URL + this.image_2

          this.image_3 = response.data.window.image_3
          this.url_image_3 = APP_URL + this.image_3

          this.image_4 = response.data.window.image_4
          this.url_image_4 = APP_URL + this.image_4

          this.video = response.data.window.video
          this.degree_development = response.data.window.degree_development
          this.user_id = response.data.window.user_id
          this.edition_id = response.data.window.edition_id
          this.convocation_form_id = response.data.window.convocation_form_id
          this.published = response.data.window.published
          this.loading = false
        }).catch(error => {
          console.log(error);
        })
      },

      async updateMyWindow(){
        this.loading=true

        let formData= new FormData()

        formData.append('id', this.id)
        formData.append('title', this.title)

        if(this.executive_summary!=null){
          formData.append('executive_summary', this.executive_summary);
        }

        if(this.problem_detected!=null){
          formData.append('problem_detected', this.problem_detected);
        }

        if(this.proposed_solution!=null){
          formData.append('proposed_solution', this.proposed_solution);
        }

        if(this.market!=null){
          formData.append('market', this.market);
        }

        if(this.strategic_alliance!=null){
          formData.append('strategic_alliance', this.strategic_alliance);
        }

        if(this.entrepreneurial_team!=null){
          formData.append('entrepreneurial_team', this.entrepreneurial_team);
        }
        
        if(this.contact!=null){
          formData.append('contact', this.contact);
        }


        formData.append('logo', this.logo)

        formData.append('image_1', this.image_1)
        formData.append('image_2', this.image_2)
        formData.append('image_3', this.image_3)
        formData.append('image_4', this.image_4)

        if(this.video!=null){
          formData.append('video', this.video);
        }

        formData.append('degree_development', this.degree_development)
        formData.append('user_id', this.user_id)
        formData.append('edition_id', this.edition_id)
        formData.append('convocation_form_id', this.convocation_form_id)
        formData.append('published', this.published)

        try {
          await axios({
            method: 'post',
            url: 'entrepreneurship-window/'+ this.convocation_form.convocation_form.id,
            data: formData,
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }).then( response =>{
            console.log('Response: '+response.data)
            this.loading=false
            this.$router.push({ name: 'myEntrepreneurship' })
          })
        } catch (error) {
          console.log('Response: ')
          console.error(error.response.data);
        }
      },
    },

    created(){
      this.getMyWindow()
    },
  }
</script>