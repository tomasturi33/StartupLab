<template>
  <v-row>
    <v-col cols="12"> 
      <v-sheet 
        outlined
        min-height="400"
        >
        <v-row>
          <v-col cols="12">
            <v-col
              class="d-flex pa-6"
              cols="12"
            >
              <v-select
                :loading="loading"
                :items="editions"
                label="Edición"
                v-model="edition_id"
                name="editions"
                :item-text="'name'"
                :item-value="'id'"
                outlined
              ></v-select>
            </v-col>
          </v-col>

          <v-col cols="12">
            <v-divider></v-divider>
          </v-col>

          <v-col cols="12" v-if="!loading">
            <v-tabs
              v-model="tabs"
              fixed-tabs
            >
              <v-tabs-slider></v-tabs-slider>
              <v-tab
                href="#tab-list"
                class="primary--text"
                @click="changeTab('tab-list')"
              >
                <v-icon>mdi-reorder-horizontal</v-icon>
              </v-tab>

              <v-tab
                href="#tab-trello"
                class="primary--text"
                @click="changeTab('tab-trello')"
              >
                <v-icon>mdi-reorder-vertical</v-icon>
              </v-tab>

              <v-tab
                href="#tab-window"
                class="primary--text"
                @click="changeTab('tab-window')"
              >
                <v-icon>mdi-table</v-icon>
              </v-tab>
            </v-tabs>
          </v-col>
          
          <template v-if="!loading">

            <EntrepreneurshipsList :edition_id="edition_id" v-if="tabs=='tab-list'"/>

            <EntrepreneurshipsTrello class="ma-3" :edition_id="edition_id" v-if="tabs=='tab-trello'"/>

            <v-col cols="12">
              <EntrepreneurshipsWindows :edition_id="edition_id" v-if="tabs=='tab-window'"/>
            </v-col>
            

          </template>
          
        </v-row>
      </v-sheet>
    </v-col>
  </v-row>
</template>

<script>
  import axios from 'axios'
  import EntrepreneurshipsList from '@/components/entrepreneurships/EntrepreneurshipsList'
  import EntrepreneurshipsWindows from '@/components/entrepreneurships/EntrepreneurshipsWindows'
  import EntrepreneurshipsTrello from '@/components/entrepreneurships/EntrepreneurshipsTrello'

  export default {
    name: 'Entrepreneurships',
    components:{EntrepreneurshipsList, EntrepreneurshipsWindows, EntrepreneurshipsTrello},
    data: () => ({
      loading:true,
      
      dialog:false,
      name:'',

      active_tab:0,
      editions:[],
      edition_id:null,

      tabs: 'tab-list',
      text: '',
    }),

    methods:{
      createdView()
      {
        this.tabs = this.$store.state.currentTab
        this.edition_id = this.$store.state.currentEdition
      },

      async getEditions()
      {
        await axios.get('admin/editions').then(response =>{
          this.editions = response.data
          
          if(this.editions && !this.edition_id){
            this.edition_id = this.editions[0].id
          }
          this.loading=false
        }).catch(error => {
          console.log(error);
          this.loading=false
        })
      },

      changeTab(tab)
      {
        this.$store.state.currentTab = tab
      }
    },

    created(){
      this.createdView()
      this.getEditions()
    },
  }
</script>