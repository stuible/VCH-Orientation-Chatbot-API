<template>
    <div id="intents">
        <h1>Intents</h1>
        <div class="card" v-for="intent in intents" v-bind:key="intent.id">
            <header class="card-header">
                <p class="card-header-title">
                {{ intent.name }}
                </p>
                <!-- <a href="#" class="card-header-icon" aria-label="more options">
                <span class="icon">
                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
                </a> -->
            </header>
            <div class="card-content">
                <div class="content">
                {{ intent.description }}
                <br>
                <time datetime="2016-1-1">{{ intent.created_at }}</time>
                </div>
            </div>
            <!-- <footer class="card-footer">
                <a href="#" class="card-footer-item">Save</a>
                <a href="#" class="card-footer-item">Edit</a>
                <a href="#" class="card-footer-item">Delete</a>
            </footer> -->
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
            }
        }
    }
</script>