<template>
    <b-row no-gutters class="text-white">
        <b-col md="3"></b-col>
        <b-col md="6" class="bg-primary rounded px-3 py-3">
            <h4 v-text="q"></h4>
            <label>Enter answer!</label>
            <b-input
                v-model="a"
                :state="true"
                aria-describedby="input-error"
                disabled
            ></b-input>
        </b-col>
        <b-col md="3"></b-col>
    </b-row>
</template>

<script>
    export default {
        name: "ExerciseCompleted",
        props:['part_id','q','a'],
    }
</script>
