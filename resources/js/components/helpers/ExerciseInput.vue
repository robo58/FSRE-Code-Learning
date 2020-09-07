<template>
    <b-row no-gutters class="text-white">
        <b-col md="3"></b-col>
        <b-col md="6" class="bg-primary rounded px-3 py-3">
            <label>Enter question!</label>
            <b-input v-model="question"></b-input>
            <label>Enter answer!</label>
            <b-input v-model="answer"></b-input>
            <b-button variant="success" @click="saveExercise">Save</b-button>
            <b-button variant="danger" @click="$emit('onDelete')"><b-icon-trash-fill /></b-button>
        </b-col>
        <b-col md="3"></b-col>
    </b-row>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "ExerciseInput",
        props:['part_id','q','a'],
        data(){
            return {
                question: '',
                answer: ''
            }
        },
        created() {
           this.question = this.q;
           this.answer = this.a;
        },
        methods:{
            saveExercise(){
                axios.post('/api/exercises',{question: this.question, answer: this.answer, course_part_id: this.part_id})
                .then(response=>{

                });
            },
        }
    }
</script>
