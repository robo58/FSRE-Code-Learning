<template>
    <b-card v-if="messages.length>0" border-variant="light">
        <img :src="'/uploads/avatars/'+contact.avatar" alt="no img" style="width:15%; float:left; border-radius:50%;">
        <h4 class="text-left">
            {{ contact.name }}
            <b-badge variant="info" class="text-white">{{ contact.unread }} <span class="sr-only">unread messages</span></b-badge>
        </h4>
        <h6 class="text-left">{{ contact.email }}</h6>
        <div class="d-flex justify-content-center">
            <h5 class="text-left">Last message:</h5>
            <div class="bg-info text-white rounded mx-3 px-3">
                <p>{{ messages[0].text }}</p>
                <small>{{ messages[0].created_at }}</small>
            </div>
            <b-button variant="info" :href="'/inbox/'+contact.id"><b-icon-chat></b-icon-chat></b-button>
        </div>
    </b-card>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "UserMessages",
        props:['user','contact'],
        data(){
            return{
                messages: []
            }
        },
        created() {
            axios.get('/api/getUnreadMessages/'+this.user.id+'/'+this.contact.id)
                .then(response=>{
                    this.messages = response.data;
                });
            Echo.private('chat.'+this.user.id).listen('MessageSent', (e) => {
                this.handleIncoming(e.message);
            });
        },
        methods:{
            handleIncoming(message){
                if(message.sender_id === this.contact.id){
                    this.messages.unshift(message);
                    this.contact.unread+=1;
                }
            }
        },

    }
</script>
