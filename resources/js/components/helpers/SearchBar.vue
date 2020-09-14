<template>
    <div class="d-flex align-items-center">
        <b-input
            size="sm"
            type="search"
            list="my-list-id"
            placeholder="Search courses..."
            v-model="searchString"
            @keyup="search"
            @keydown.enter="getCourse"
        >
        </b-input>
        <b-form-datalist id="my-list-id" :options="courses" text-field="category.name" value-field="title"></b-form-datalist>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {

        name: "SearchBar",

        data(){
            return{
                searchString: '',
                courses: [],
            }
        },

        methods:{
            search(){
                axios.post('/api/searchCourses',{searchString: this.searchString})
                .then(response=>{
                    this.courses=response.data;
                });
            },

            getCourse(){
                let course = this.courses.filter(x=>x.title.toLowerCase().includes(this.searchString.toLowerCase()))[0];
                window.location.href= window.location.href.substr(0, window.location.href.length - 1) + '/courses/' + course.id;
            }
        }

    }
</script>

<style scoped>

</style>
