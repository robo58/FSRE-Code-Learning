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
                <b-jumbotron>
                    <template v-slot:header>{{ part.title }}</template>
                    <hr class="my-4" />
                    <div class="px-3" v-html="part.body" />

                    <hr class="my-4" />
                    <div class="d-flex">
                        <b-button class="mr-auto p-2" :disabled="canPrevious(part)" @click="selectPrevious(part)">Previous</b-button>
                        <b-button class="p-2" :disabled="canNext(part)" @click="selectNext(part)">Next</b-button>
                    </div>
                </b-jumbotron>
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

            canPrevious(part){
                let x = this.parts.indexOf(part);
                if(x !== -1){
                    x=this.parts.indexOf(this.parts[x-1]);
                    if(x !== -1){
                        return false;
                    }
                }
                return true;
            },

            canNext(part){
                let x = this.parts.indexOf(part);
                if(x !== -1){
                    x=this.parts.indexOf(this.parts[x+1]);
                    if(x !== -1){
                        return false;
                    }
                }
                return true;
            },

            selectPrevious(part){
                let x = this.parts.indexOf(part);
                if(x !== -1){
                    x=this.parts.indexOf(this.parts[x-1]);
                    if(x !== -1){
                        this.selected = this.parts[x].id;
                    }
                }
            },

            selectNext(part){
                let x = this.parts.indexOf(part);
                if(x !== -1){
                    x=this.parts.indexOf(this.parts[x+1]);
                    if(x !== -1){
                        this.selected = this.parts[x].id;
                    }
                }
            },

        }
    }
</script>
