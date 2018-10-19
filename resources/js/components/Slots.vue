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
        <!-- Edit Popup Dialog -->
        <v-dialog v-model="dialog" max-width="500px">
            <v-btn slot="activator" color="primary" dark class="mb-2">Add Response</v-btn>
            <v-card>
                <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12 sm12 md12>
                                <v-text-field v-model="slot.title" label="Term"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm12 md12>
                                <synonyms></synonyms>
                            </v-flex>
                            <v-flex xs12 sm12 md12>
                                <wysiwyg class="mt-5" v-model="slot.response" />
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

    <!-- Table for Slots -->
    <v-data-table :headers="headers" :items="slots" :loading="loading" :search="search" :rows-per-page-items="itemsPerPage">
    <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
        <template slot="items" slot-scope="props">
            <tr @click="editSlot(props.item)">
                <td>
                    {{ props.item.title }}
                </td>
                <td>
                    <span v-html="props.item.response"></span>
                </td>
            </tr>
        </template>
        <!-- No Search Results Error -->
        <v-alert slot="no-results" :value="true" color="error" icon="warning">
          Your search for "{{ search }}" found no results.
        </v-alert>
        <!-- Pagination -->
        <template slot="pageText" slot-scope="{ pageStart, pageStop }">
            From {{ pageStart }} to {{ pageStop }}
        </template>
    </v-data-table>

    <!-- Snackbar Popup -->
    <v-snackbar
        v-model="snackbar.enabled"
        :bottom="snackbar.y === 'bottom'"
        :left="snackbar.x === 'left'"
        :multi-line="snackbar.mode === 'multi-line'"
        :right="snackbar.x === 'right'"
        :timeout="snackbar.timeout"
        :top="snackbar.y === 'top'"
        :vertical="snackbar.mode === 'vertical'"
      >
        {{ snackbar.text }}
        <v-btn
          color="pink"
          flat
          @click="snackbar.enabled = false"
        >
          Close
        </v-btn>
    </v-snackbar>
</div>
</template>

<script>
export default {
    props: ['intentName'],
    data() {
        return {
            intent: this.intentName,
            search: '',
            itemsPerPage: [50, 75],
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
            defaultItem: {
                title: '',
                response: ''
            },
            snackbar: {
                enabled: false,
                y: 'bottom',
                x: 'right',
                mode: '',
                timeout: 5000,
                text: 'Hello, I\'m a snackbar'
            },

        }
    },
    watch: {
        '$route.params.intentName': function (id) {
            this.intent = id;
            this.fetchSlots();
        }
    },
    computed: {
        formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
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
        // deleteIntent(name) {
        //     if (confirm('Are you sure you want to delete?')) {
        //         fetch(`api/intents/${name}`, {
        //                 method: 'delete'
        //             })
        //             .then(res => res.json())
        //             .then(data => {
        //                 alert('Article Removed');
        //             })
        //             .catch(err => console.log(err));
        //     }
        // },
        save() {
            if (this.editedIndex > -1) {
                this.updateSlot()
                Object.assign(this.slots[this.editedIndex], this.slot)
            } else {

                this.createSlot();
                this.slots.push(this.slot)
                }
            this.close()
        },
        editSlot(item) {
            this.editedIndex = this.slots.indexOf(item)
            this.slot = Object.assign({}, item)
            this.dialog = true
        },
        createSlot() {
            fetch('api/intents/' + this.intent + '/slots', {
                    method: 'post',
                    body: JSON.stringify(this.slot),
                    headers: {
                        'content-type': 'application/json'
                    }
                }).then(res => res.json())
                .then(data => {
                    // this.slot.title = '';
                    // this.slot.response = '';
                    this.showSnackbar('Slot Added');
                    this.fetchSlots();
                })
                .catch(err => console.log(err))
        },
        updateSlot() {
            fetch('api/intents/' + this.intent + '/slots', {
                    method: 'put',
                    body: JSON.stringify(this.slot),
                    headers: {
                        'content-type': 'application/json'
                    }
                }).then(res => res.json())
                .then(data => {
                    // this.slot.title = '';
                    // this.slot.response = '';
                    // alert('Slot Updated');
                    this.showSnackbar('Slot Updated');
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
                this.slot = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            }, 300)
        },
        showSnackbar(message){
            this.snackbar.text = message;
            this.snackbar.enabled = true;
        }
    }
}
</script>
