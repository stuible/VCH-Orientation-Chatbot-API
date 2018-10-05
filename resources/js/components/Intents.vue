<template>
    <div id="intents" class="">
        <h1 class="title is-1" >Intents</h1>
        <div class="columns is-multiline">
            <div class="column is-half" v-for="intent in intents" v-bind:key="intent.id">
                <div class="intent box">
                    <article class="media">
                        <div class="content">
                            <p class="card-header-title">
                            {{ intent.name }}
                            </p>
                        
                            <div class="content">
                                {{ intent.description }}
                                <!-- <br> -->
                                <time datetime="2016-1-1">{{ intent.created_at }}</time>
                            </div>
                        
                            <div class="level">
                                <button @click="deleteIntent(intent.name)" class="button is-danger">Delete</button>
                            </div>
                        </div>
                        
                        <!-- <footer class="card-footer">
                            <a @click="saveIntent(intent.name)" class="card-footer-item">Save</a>
                            <a @click="ediIntent(intent.name)" class="card-footer-item">Edit</a>
                            <a @click="deleteIntent(intent.name)" class="card-footer-item">Delete</a>
                        </footer> -->
                    </article>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                intents: [],
                intent: {
                    id: '',
                    title: '',
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
            }
        }
    }
</script>