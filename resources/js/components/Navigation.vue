<template>
<div>
    <v-navigation-drawer v-model="drawer" fixed clipped class="grey lighten-4" app>
        <v-toolbar flat>
            <v-list>
                <v-list-tile>
                    <v-list-tile-title class="title">
                        Intents
                    </v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-toolbar>

        <v-divider></v-divider>

        <intents></intents>
        <div class="text-xs-center">
            <v-btn fab dark small color="green">
                <v-icon dark>add</v-icon>
            </v-btn>
        </div>

    </v-navigation-drawer>

    <v-toolbar app absolute clipped-left>
        <v-toolbar-side-icon @click.native="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title>VCH Orientation Chatbot</v-toolbar-title>
    </v-toolbar>
</div>
</template>

<script>
export default {
    data() {
        return {
            drawer: null
        };
    }
};
</script>
