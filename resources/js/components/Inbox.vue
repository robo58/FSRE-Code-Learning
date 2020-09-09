<template>
    <div class="py-3">
        <b-row class="py-4">
            <b-col md="4">
                <h2 class="text-center">User list</h2>
                <b-list-group class="text-center">
                    <b-list-group-item
                        v-for="user in users"
                        :key="user.id"
                        :active="user.id === selected.id"
                        :href="'#'+user.id"
                        v-text="user.name"
                        @click="selected = user, getMessages()"
                        class="py-4"
                    ></b-list-group-item>
                </b-list-group>
            </b-col>
            <b-col md="1"></b-col>
            <b-col md="6">
                <h2 class="text-center">Chat</h2>
                <div
                    v-for="message in messages"
                    :key="message.id"
                    v-if="selected.id === message.receiver_id || selected.id === message.sender_id"
                    :class="message.sender_id === user.id ? 'd-flex justify-content-start' : 'd-flex justify-content-end'"
                >
                    <b-card
                        :bg-variant="message.sender_id===user.id ? 'info':'success'"
                        text-variant="white"
                        class="w-25"
                    >
                        <b-card-text v-text="message.text"></b-card-text>
                        <small><em v-text="message.created_at"></em></small>
                    </b-card>
                </div>
            </b-col>
        </b-row>
        <b-row no-gutters class="py-3" v-if="Object.keys(selected).length!==0">
            <b-col md="5"></b-col>
            <b-col md="5">
                <b-input v-model="newMessage"></b-input>
            </b-col>
            <b-col md="1">
                <b-button block variant="primary" @click="sendMessage">Send</b-button>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Inbox",
        props:['user'],
        data(){
            return{
                newMessage: '',
                users: [],
                selected: {},
                messages: []
            }
        },
        created() {
            axios.get('/api/getUsers').then(response=>{
                this.users=response.data;
            })
        },

        methods:{
            sendMessage(){
                axios.post('/api/sendMessage',{ sender_id: this.user.id, receiver_id: this.selected.id, text: this.newMessage })
                .then(response=>{
                   this.messages.push(response.data);
                });
                this.newMessage='';
            },

            getMessages(){
                axios.get('/api/getMessages/'+this.user.id+'/'+this.selected.id).then(response=>{
                   this.messages = response.data;
                });
            }
        }

    }
</script>
