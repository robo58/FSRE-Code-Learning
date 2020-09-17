<template>
    <div class="py-2">
        <h4>Statistics</h4>
        <b-row no-gutters>
            <b-col sm="5">
                <h5>Total enrolled students: <em>{{ totalStudents }}</em></h5>
                <h5>Parts: <em>{{ countP }}</em></h5>
                <h5>Exercises: <em>{{ countE }}</em></h5>
            </b-col>
            <b-col sm="2"></b-col>
            <b-col sm="5">
                <h5>Students with 50%+: <em>{{ halfStudents }}</em></h5>
                <h5>Students with 100%: <em>{{ completeStudents }}</em></h5>
            </b-col>
        </b-row>
        <b-row>
            <b-table
                :items="studentTable"
            ></b-table>
        </b-row>


    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "CourseStats",
        props:['course','author'],
        data(){
            return{
                students: [],
                countE: 0,
                countP: 0
            }
        },
        created() {
            axios.get('/api/getStats/'+this.course.id)
            .then(response=>{
                this.students=response.data.students;
                this.countE=response.data.exercises;
                this.countP=response.data.parts;
            });
        },
        computed:{
              totalStudents(){
                  return this.students.length;
              },
            studentTable(){
              let items=[];
              this.students.forEach(student=>{
                  let item={
                      name: null,
                      email: null,
                      progress: null,
                      enrolled_at: null
                  };
                  item.name=student.user.name;
                  item.email=student.user.email;
                  item.progress=student.progress+'%';
                  item.enrolled_at=student.created_at;
                  items.push(item);
              });
              return items;
            },
            halfStudents(){
                  let count=0;
                  this.students.forEach(s=>{
                     if(s.progress>=50){
                         count++;
                     }
                  });
                  return count;
            },
            completeStudents(){
                let count=0;
                this.students.forEach(s=>{
                    if(s.progress===100){
                        count++;
                    }
                });
                return count;
            }
        },
    }
</script>

