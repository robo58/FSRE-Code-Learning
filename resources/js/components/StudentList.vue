<template>
    <b-container>
        <b-row class="justify-content-center py-4">
            <h1>List of Students.</h1>
        </b-row>

        <b-row class="justify-content-center py-4" v-for="student in students" :key="student.id">
            <b-col sm="12">
                <user-info :user="student" :logged-in-user="user"></user-info>
            </b-col>
        </b-row>

    </b-container>
</template>

<script>
    import axios from 'axios';
    import UserInfo from "./helpers/UserInfo";
    export default {
        name: "TeacherList",
        components: {UserInfo},
        props:{
            students: Array,
            user: Object
        },
        data() {
            return {
            }
        },

        created(){

        },

        methods:{

        }
    }
</script>
