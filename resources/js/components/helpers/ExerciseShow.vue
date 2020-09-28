<template>
    <b-row no-gutters class="text-white">
        <b-col md="3"></b-col>
        <b-col md="6" class="bg-primary rounded px-3 py-3">
            <h4 v-text="q"></h4>
            <label>Enter answer!</label>
            <b-input
                v-model="answer"
                :state="state"
                aria-describedby="input-error"
            ></b-input>
            <b-form-invalid-feedback id="input-error">
                Wrong answer!
            </b-form-invalid-feedback>
            <b-button block variant="success" @click="checkAnswer">Submit</b-button>
        </b-col>
        <b-col md="3"></b-col>
    </b-row>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "ExerciseShow",
        props:['part_id','q','a'],
        data(){
            return {
                answer: '',
                state: null
            }
        },
        methods:{
            checkAnswer(){
                this.state =  this.answer === this.a;
                if(this.state){
                    this.$emit('answerTrue');
                }
            }
        }
    }
</script>
