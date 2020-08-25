<template>
    <b-row no-gutters>
        <b-col sm="0" class="border-right" v-show="showSidebar">
            <b-list-group class="text-center">
                <b-list-group-item v-for="part in parts" :key="part.id" :href="'#'+part.id" :active="part.id === selected" @click.prevent="selectPart(part.id)" v-text="part.title"></b-list-group-item>
            </b-list-group>
        </b-col>
        <b-col>
            <b-button variant="info" class="text-white" @click="showSidebar = !showSidebar"><b-icon-arrow-bar-left v-if="showSidebar" /><b-icon-arrow-bar-right v-else /></b-button>
            <div v-for="part in parts" :key="part.id" v-if="part.id === selected">
                <b-row class="justify-content-center" no-gutters>
                    <h1>{{ part.title }}</h1>
                </b-row>
                <b-row no-gutters class="py-5">
                    <b-col sm="1" />
                    <b-col sm="10" v-html="part.body">

                    </b-col>
                    <b-col sm="1" />
                </b-row>
            </div>
        </b-col>

    </b-row>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "CourseShow",
        props: ['course'],
        data() {
            return {
                showSidebar: true,
                selected: {},
                parts: []
            }
        },

        created(){
            axios.get('/api/courses/'+this.course.id+'/getParts').then(response => {
                this.parts = response.data;
                if(this.parts.length > 0)
                {
                    this.selected = this.parts[0].id;
                }
            });
        },

        methods:{

            selectPart(id){
                this.selected = id;
            },

        }
    }
</script>
