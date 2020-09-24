<template>
    <div>
        <b-list-group class="p-3">
            <b-list-group-item
                size="sm"
                v-for="document in documents"
                :key="document.id"
            >
                <b-row no-gutters>
                    <b-col sm="10">
                        <h6>{{ document.title }}</h6>
                        <small>{{ document.description }}</small>
                    </b-col>
                    <b-col>
                        <b-button variant="info" :href="'/files/download/'+document.id"><b-icon-arrow-bar-down></b-icon-arrow-bar-down></b-button>
                    </b-col>
                </b-row>
            </b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props:['part_id'],
        data(){
            return{
                documents: [],
            }
        },
        watch:{
            part_id(){
                axios.get('/files/'+this.part_id)
                    .then(response=>{
                        this.documents = response.data;
                    });
            }
        },
    }
</script>
