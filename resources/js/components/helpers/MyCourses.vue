<template>
    <div>
        <h2 class="text-center text-white">
            My Courses &nbsp&nbsp<b-button @click="collapsed=!collapsed" ><b-icon-arrow-bar-down v-if="!collapsed" class="mx-3" /><b-icon-arrow-bar-up v-else class="mx-3" /></b-button>
        </h2>
        <b-collapse :visible="collapsed">
            <b-list-group class="text-center">
                <b-list-group-item v-for="course in courses"
                                   :key="course.id"
                                   v-b-toggle="'collapse-'+course.id"
                >
                    <h5 class="mb-1">{{course.title}}</h5>
                    <small>{{course.created_at}}</small>
                    <b-collapse :id="'collapse-'+course.id" class="mt-2">
                        <course-stats :course="course" :author="user"></course-stats>
                    </b-collapse>
                </b-list-group-item>
            </b-list-group>
        </b-collapse>
    </div>

</template>

<script>
    import axios from "axios";

    export default {
        name: "MyCourses",
        props: ['user'],
        data(){
            return {
                courses: [],
                collapsed: false
            }
        },
        created() {
            axios.get('/api/'+this.user.id+'/getMyCourses')
            .then(response=>{
                this.courses=response.data;
            });
        },
        methods:{

        }
    }
</script>

