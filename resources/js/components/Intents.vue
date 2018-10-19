<template>
<v-list two-line subheader>
    <router-link tag="v-list-tile" v-for="intent in intents" :to="intent.name" :key="intent.id">
        <v-list-tile-avatar>
            <v-icon class="blue white--text">assignment</v-icon>
        </v-list-tile-avatar>

        <v-list-tile-content>
            <v-list-tile-title>{{ intent.name }}</v-list-tile-title>
            <v-list-tile-sub-title>{{ intent.description }}</v-list-tile-sub-title>
        </v-list-tile-content>

        <v-list-tile-action>
            <v-btn icon ripple>
                <v-icon color="grey lighten-1">edit</v-icon>
            </v-btn>
        </v-list-tile-action>
    </router-link>
</v-list>
</template>

<script>
export default {
    data() {
        return {
            intents: [],
            intent: {
                id: '',
                name: '',
                description: ''
            }
        }
    },
    created() {
        this.fetchIntents();
    },

    methods: {
        fetchIntents() {
            fetch('api/intents/')
                .then(res => res.json())
                .then(res => {
                    this.intents = res.data;
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
        }
    }
}
</script>
