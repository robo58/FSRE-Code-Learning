<template>
    <div>
        <h2 class="text-center text-white">
            Messages feed &nbsp&nbsp<b-button @click="collapsed=!collapsed" ><b-icon-arrow-bar-down v-if="!collapsed" class="mx-3" /><b-icon-arrow-bar-up v-else class="mx-3" /></b-button>
        </h2>
        <b-collapse :visible="collapsed">
            <b-card class="text-center">
                <b-card-body>
                    <b-list-group class="justify-content-center py-4">
                        <b-list-group-item v-for="contact in contacts" :key="contact.id" style="border: 0 white;">
                            <user-messages :user="user" :contact="contact"></user-messages>
                        </b-list-group-item>
                    </b-list-group>
                </b-card-body>
            </b-card>
        </b-collapse>
    </div>

</template>

<script>
    import axios from 'axios';
    export default {
        name: "MessageFeed",
        props:['user'],
        data(){
            return{
                contacts: [],
                collapsed: false
            }
        },
        created() {
            axios.get('/api/getUsers/'+this.user.id)
                .then(response=>{
                    this.contacts=response.data;
                });

        },

    }
</script>
