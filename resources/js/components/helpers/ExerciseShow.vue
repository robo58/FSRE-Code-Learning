<template>
    <b-row no-gutters class="text-white">
        <b-col md="3"></b-col>
        <b-col md="6" class="bg-primary rounded px-3 py-3">
            <h6>Question?</h6>
            <label>Enter answer!</label>
            <b-input v-model="answer"></b-input>
            <b-button block variant="success" >Submit</b-button>
        </b-col>
        <b-col md="3"></b-col>
    </b-row>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "ExerciseShow",
        props:['part_id'],
        data(){
            return {
                question: '',
                answer: ''
            }
        },
        methods:{

        }
    }
</script>
