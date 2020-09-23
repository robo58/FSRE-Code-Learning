<template>
    <b-card>
        <img :src="'/uploads/avatars/'+user.avatar" alt="no img" style="width:15%; float:left; border-radius:50%; margin-right:25px;">
        <h2>{{ user.name }}</h2>
        <h6>{{ user.email }}</h6>
        <h6 class="text-center" v-if="courses.length>0" >{{user.name}}'s courses</h6>
        <b-list-group horizontal class="overflow-auto">
            <b-list-group-item
                v-for="course in courses" :key="course.id"
                v-text="course.title"
                :href="'/courses/'+course.id"
            ></b-list-group-item>
        </b-list-group>
        <div class="py-3 d-flex justify-content-end">
            <b-button variant="primary" :href="'/profile/'+user.id"><b-icon-person></b-icon-person></b-button>
            <b-button variant="info" :href="'/inbox/'+user.id" v-if="loggedInUser.id !== user.id"><b-icon-chat></b-icon-chat></b-button>
        </div>
    </b-card>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "UserInfo",
        props:['user','loggedInUser'],
        data(){
            return{
                courses: []
            }
        },
        created() {
            axios.get('/getCourses/'+this.user.id)
            .then(response=>{
               this.courses=response.data;
            });
        }
    }
</script>
