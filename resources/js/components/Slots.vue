<template>
    <div id="slots" class="">
        <h1 class="title is-1" >{{ intentName }} Slots</h1>
        <div class="" v-for="slot in slots" v-bind:key="slot.id">
            {{ slot.title }}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['intentName'],
        data() {
            return {
                slots: [],
                slot: {
                    id: '',
                    title: '',
                }
            }
        },
        created() {
            this.fetchIntents();
        },

        methods: {
            fetchIntents() {
                fetch('api/intents/' + this.intentName + '/slots')
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
            }
        }
    }
</script>