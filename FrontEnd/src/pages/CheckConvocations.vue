<template>
<v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">Seleccione una convocatoria:</span>
        </v-card-title>
        <v-card-text>

          <v-col cols="12">
            <label>Usted se encuentra registrado en mas de una convocatoria, seleccione la convocatoria que quiere acceder:</label>
          </v-col>
          <v-col cols="12" v-for="item in convocation_forms" :key="item.id">
            <v-btn
              block
              color="error"
              @click="select(item.id)"
            >
              {{ (item.title)?item.title:'(sin titulo)' }}
            </v-btn>
          </v-col>
          <v-col cols="12">
            <label>Para cambiar de convocatoria, cierre sesión y vuelva a ingresar.</label>
          </v-col>

        </v-card-text>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  import { mapGetters } from 'vuex'
  import axios from 'axios'

  export default {
    name: 'Home',

    data: () => ({
      loading: true,
      dialog:false,

      convocation_forms:null,
    }),

    computed: {
      ...mapGetters([ 
        'isLogged', 'user', 'convocation_form'
      ])
    },

    methods:{
      async checkRoles(){

        if(this.user.roles.find(element => element=== 'entrepreneur')){
          this.checkConvocations()
        }else{
          if(this.user.roles.find(element => element=== 'evaluator')){
            this.$store
                .dispatch('Logged', {
                  is_logged: true
                })
            this.$router.push({ name: 'EntrepreneurshipsAssigned' })
          }

          if(this.user.roles.find(element => element=== 'admin')){
            this.$store
                .dispatch('Logged', {
                  is_logged: true
                })
            this.$router.push({ name: 'editions' })
          }
        }
      },

      async checkConvocations(){
        let that = this

        await axios.get('check-my-convocations').then(response => {
          this.convocation_forms = response.data.convocation_forms

          if(that.convocation_forms.length<=1){
            localStorage.setItem('convocation_forms_id', that.convocation_forms.id);
            localStorage.setItem('convocation_forms', that.convocation_forms);
            
            that.$store
              .dispatch('convocationForm', {
                convocation_form: that.convocation_forms[0]
              })

            that.$store
              .dispatch('Logged', {
                is_logged: true
              })

            that.$router.push({ name: 'home' })
          }else{
            that.dialog = true
            that.loading = false
          }
        }).catch(()=>{
          alert('error con su token')
        })
      },

      select(id_convocation){
        let convocation_selected= this.convocation_forms.filter(function (data){
          return data.id === id_convocation
        });

        this.$store
          .dispatch('convocationForm', {
            convocation_form: convocation_selected[0]
          })

        this.$store.dispatch('Logged', {
              is_logged: true
            })

        localStorage.setItem('convocation_forms_id', convocation_selected[0].id);
        localStorage.setItem('convocation_forms', convocation_selected[0]);
        this.$router.push({ name: 'home' })
      }
    },

    created(){
      this.checkRoles()
    },
  }
</script>