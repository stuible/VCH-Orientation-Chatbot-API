<template>
    <div id="slots" class="elevation-5">
        <!-- <h1 class="title is-1" >{{ intentName }} Slots</h1> -->
            
        <!-- <table style="width:100%">
            <tr>
                <th>ID</th>
                <th>Title</th> 
                <th>Response</th>
            </tr>
            <tr v-for="slot in slots" v-bind:key="slot.id">
                <td>{{ slot.id }}</td>
                <td>{{ slot.title }}</td> 
                <td>{{ slot.response }}</td>
            </tr>
        </table> -->

        <v-toolbar flat color="white">
        <v-toolbar-title>{{ intent }} Slots</v-toolbar-title>
        <!-- <v-divider
          class="mx-2"
          inset
          vertical
        ></v-divider> -->
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>
          <v-card>
            <v-card-title>
              <span class="headline">Create New Response</span>
            </v-card-title>
  
            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm12 md12>
                    <v-text-field v-model="editedItem.title" label="Term"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm12 md12>
                    <v-text-field v-model="editedItem.response" label="Response"></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
  
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
              <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>

        <v-data-table :headers="headers" :items="slots">
        <template slot="items" slot-scope="props">
          <td>
            <v-edit-dialog
              :return-value.sync="props.item.title"
              lazy
              @save="save"
              @cancel="cancel"
              @open="open"
              @close="close"
            > {{ props.item.title }}
              <v-text-field
                slot="input"
                v-model="props.item.title"
                label="Edit"
                single-line

              ></v-text-field>
            </v-edit-dialog>
          </td>
          <td>
            <v-edit-dialog
              :return-value.sync="props.item.response"
              lazy
              @save="save"
              @cancel="cancel"
              @open="open"
              @close="close"
            > {{ props.item.response }}
              <v-text-field
                slot="input"
                v-model="props.item.response"
                label="Edit"
                single-line

              ></v-text-field>
            </v-edit-dialog>
          </td>
        </template>
        <template slot="pageText" slot-scope="{ pageStart, pageStop }">
          From {{ pageStart }} to {{ pageStop }}
        </template>
      </v-data-table>
    </div>
</template>

<script>
    export default {
        props: ['intentName'],
        data() {
            return {
                intent: this.intentName,
                max25chars: (v) => v.length <= 25 || 'Input too long!',
                dialog: false,
                slots: [],
                slot: {
                    id: '',
                    title: '',
                    response: '',
                },
                headers: [
                    {
                    text: 'Term',
                    align: 'left',
                    sortable: true,
                    value: 'title'
                    },
                    {
                    text: 'Response',
                    align: 'left',
                    sortable: false,
                    value: 'response'
                    },
                ],
                editedIndex: -1,
                editedItem: {
                name: '',
                calories: 0,
                fat: 0,
                carbs: 0,
                protein: 0
                },
                defaultItem: {
                name: '',
                calories: 0,
                fat: 0,
                carbs: 0,
                protein: 0
                }
            }
        },
        created() {
            this.fetchIntents();
        },
        beforeRouteUpdate(to) {
            this.intent = to.params.intentName;
            this.fetchIntents();
        },

        methods: {
            fetchIntents() {
                fetch('api/intents/' + this.intent + '/slots')
                    .then(res => res.json())
                    .then(res => {
                        this.slots = res.data;
                    })
            },
            deleteIntent(name){
                if(confirm('Are you sure you want to delete?')){
                    fetch(`api/intents/${name}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('Article Removed');
                    })
                    .catch(err => console.log(err));
                }
            },
            save () {

            },
            cancel () {

            },
            open () {

            },
            close () {
            this.dialog = false
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            }, 300)
            },
        }
    }
</script>