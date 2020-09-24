<template>
    <b-container class="py-3">

        <!--  Content  -->
        <b-row class="my-3 py-4 bg-info rounded text-white text-center">

                    <b-col>
                        <a href="/categories" class="text-white">
                            <b-card bg-variant="info" border-variant="info" title="Categories" href="/categories">
                                <b-card-text>Browse Categories</b-card-text>
                            </b-card>
                        </a>
                    </b-col>

                    <b-col>
                        <a href="/courses" class="text-white">
                            <b-card bg-variant="info" border-variant="info" title="Courses" href="/courses">
                                <b-card-text>Browse Courses</b-card-text>
                            </b-card>
                        </a>
                    </b-col>

                    <b-col>
                        <a href="/teachers" class="text-white">
                            <b-card bg-variant="info" border-variant="info" title="Teachers" href="/teachers">
                                <b-card-text>Browse Teachers</b-card-text>
                            </b-card>
                        </a>
                    </b-col>

                </b-row>

        <!--  Last course entered  -->
        <b-row class="my-3 py-4 bg-info rounded text-center">
            <b-col>
                <last-course :user="user"></last-course>
            </b-col>
        </b-row>

        <!--  Message feed  -->
        <b-row class="my-3 py-4 bg-info rounded">
            <b-col>
                <message-feed :user="user"></message-feed>
            </b-col>
        </b-row>

        <!--  Enrolled courses  -->
        <b-row class="my-3 py-4 bg-info rounded text-center">
            <b-col>
                <enrolled-courses :user="user"></enrolled-courses>
            </b-col>
        </b-row>

    </b-container>
</template>

<script>
    import LastCourse from "./helpers/LastCourse";
    import EnrolledCourses from "./helpers/EnrolledCourses";
    import MessageFeed from "./helpers/MessageFeed";
    export default{
        props:{
            user:{
                default: null,
                type: Object
            }
        },
        data(){
            return{
                teacher: false
            }
        },
        components: {LastCourse,EnrolledCourses,MessageFeed},
    }
</script>
