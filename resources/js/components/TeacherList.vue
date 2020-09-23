<template>
    <b-container>
        <b-row class="justify-content-center py-4">
            <h1>List of teachers.</h1>
        </b-row>

        <b-row class="justify-content-center py-4" v-for="teacher in teachers" :key="teacher.id">
            <b-col sm="12">
                <user-info :user="teacher" :logged-in-user="user"></user-info>
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
          teachers: Array,
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
