<template>
    <div>
        <h2 class="text-center text-white">
            Enrolled courses &nbsp&nbsp<b-button @click="toggle" ><b-icon-arrow-bar-down v-if="!collapsed" class="mx-3" /><b-icon-arrow-bar-up v-else class="mx-3" /></b-button>
        </h2>
        <b-collapse :visible="collapsed">
            <b-list-group class="text-center">
                <b-list-group-item v-for="item in started"
                                   :key="item.id"
                                   class="my-3 rounded"
                >
                    <b-card :title="item.course.title" border-variant="light">
                        <b-card-body>
                            <b-row class="py-3 d-flex justify-content-center align-content-center">
                                <b-col sm="2">
                                    Progress:
                                </b-col>
                                <b-col sm="8">
                                    <b-progress :value="item.progress" :max="100" show-progress></b-progress>
                                </b-col>
                                <b-col>
                                    <b-button block variant="info" class="text-white" :href="'/courses/'+item.course.id">Continue</b-button>
                                </b-col>
                            </b-row>
                        </b-card-body>
                    </b-card>
                </b-list-group-item>
            </b-list-group>
        </b-collapse>
    </div>

</template>

<script>
    import axios from "axios";

    export default {
        name: "EnrolledCourses",
        props:['user'],
        data(){
            return {
                started: [],
                collapsed: false
            }
        },
        created() {
            axios.get('/api/startedCourses/'+this.user.id).then(response => {
                this.started = response.data;
            });
        },
        methods:{
            toggle(){
                this.collapsed=!this.collapsed;
            }
        }

    }
</script>

