<template>
<div id="slots" class="elevation-5">
    <v-toolbar flat color="white">
        <v-toolbar-title>{{ intent }} Slots</v-toolbar-title>

        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
            <v-btn slot="activator" color="primary" dark class="mb-2">Add Response</v-btn>
            <v-card>
                <v-card-title>
                    <span class="headline">Create New Response</span>
                </v-card-title>

                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12 sm12 md12>
                                <v-text-field v-model="slot.title" label="Term"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm12 md12>
                                <!-- <v-text-field v-model="editedItem.response" label="Response"></v-text-field> -->
                                <wysiwyg v-model="slot.response" />
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="createSlot">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-toolbar>

    <v-data-table :headers="headers" :items="slots" :loading="loading" :search="search">
    <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
        <template slot="items" slot-scope="props">
            <td>
                {{ props.item.title }}
            </td>
            <td>
                <span v-html="props.item.response"></span>
            </td>
        </template>
        <v-alert slot="no-results" :value="true" color="error" icon="warning">
          Your search for "{{ search }}" found no results.
        </v-alert>
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
            search: '',
            max25chars: (v) => v.length <= 25 || 'Input too long!',
            dialog: false,
            loading: false,
            slots: [],
            slot: {
                id: '',
                title: '',
                response: '',
            },
            headers: [{
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
    watch: {
        '$route.params.intentName': function (id) {
            this.intent = id;
            this.fetchSlots();
        }
    },
    created() {
        this.fetchSlots();
    },

    methods: {
        fetchSlots() {
            this.loading = true;
            fetch('api/intents/' + this.intent + '/slots')
                .then(res => res.json())
                .then(res => {
                    this.slots = res.data;
                    this.loading = false;
                })
        },
        deleteIntent(name) {
            if (confirm('Are you sure you want to delete?')) {
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
        save() {

        },
        createSlot() {
            // if (this.editedIndex > -1) {
            //     Object.assign(this.desserts[this.editedIndex], this.editedItem)
            // } else {
            //     this.desserts.push(this.editedItem)
            // }
            // this.close()
            fetch('api/intents/' + this.intent + '/slots', {
                    method: 'post',
                    body: JSON.stringify(this.slot),
                    headers: {
                        'content-type': 'application/json'
                    }
                }).then(res => res.json())
                .then(data => {
                    this.slot.title = '';
                    this.slot.response = '';
                    alert('Slot Added');
                    this.fetchSlots();
                })
                .catch(err => console.log(err))
        },
        cancel() {

        },
        open() {

        },
        close() {
            this.dialog = false
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            }, 300)
        },
    }
}
</script>
