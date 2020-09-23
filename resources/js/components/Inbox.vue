<template>
    <b-container class="py-3">
        <b-row class="py-4">
            <!--  Users  -->
            <b-col md="4">
                <h2 class="text-center">User list</h2>
                <b-list-group v-if="contacts.length>0" style="max-height: 600px; overflow-y: auto;">
                    <b-list-group-item
                        v-for="contact in sortedContacts"
                        :key="contact.id"
                        :active="contact.id === selected.id"
                        :href="'#'+contact.id"
                        v-if="contact.id !== user.id"
                        @click="selected = contact, getMessages()"
                        class="py-4"
                    >
                        <user-info-chat :user="contact" :logged-in-user="user">
                            <template v-slot:unread v-if="contact.unread">
                                <h5><b-badge variant="primary">{{ contact.unread }} <span class="sr-only">unread messages</span></b-badge></h5>
                            </template>
                        </user-info-chat>
                    </b-list-group-item>
                </b-list-group>
                <h3 v-else><em>No available users.</em></h3>
            </b-col>
            <!--  Chat  -->
            <b-col md="8">
                <h2 class="text-center">Chat</h2>
                <h3 v-if="messages.length===0"><em>No messages.</em></h3>
                <div style="max-height: 600px; overflow-y: auto" ref="feed">
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
                </div>
            </b-col>
        </b-row>
        <b-row no-gutters class="py-3" v-if="Object.keys(selected).length!==0">
            <b-col md="4"></b-col>
            <b-col md="7">
                <b-input v-model="newMessage"></b-input>
            </b-col>
            <b-col md="1">
                <b-button block variant="primary" @click="sendMessage">Send</b-button>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import axios from 'axios';
    import UserInfoChat from "./helpers/UserInfoChat";
    export default {
        name: "Inbox",
        components: {UserInfoChat},
        props:{
            user:{
                type: Object,
                default: null
            },
            select:{
                type: Object,
                default: null
            }
        },
        data(){
            return{
                newMessage: '',
                contacts: [],
                selected: {},
                messages: []
            }
        },
        created() {
            axios.get('/api/getUsers/'+this.user.id).then(response=>{
                this.contacts=response.data;
                if(this.select!==null){
                    this.selected=this.select;
                    this.getMessages();
                }
            });
            Echo.private('chat.'+this.user.id).listen('MessageSent', (e) => {
                        this.handleIncoming(e.message);
                });
        },

        computed:{
          sortedContacts(){
              return _.sortBy(this.contacts, [(contact)=>{
                  if(contact==this.selected){
                      return Infinity;
                  }
                  return contact.unread;
              }]).reverse();
          }
        },

        methods:{

            scrollToBottom(){
                setTimeout(()=>{
                    this.$refs.feed.scrollTop=this.$refs.feed.scrollHeight-this.$refs.feed.clientHeight;
                },50);
            },

            sendMessage(){
                axios.post('/api/sendMessage',{ sender_id: this.user.id, receiver_id: this.selected.id, text: this.newMessage })
                .then(response=>{
                   this.messages.push(response.data);
                   this.scrollToBottom();
                });
                this.newMessage='';
            },

            getMessages(){
                this.updateUnreadCount(this.selected, true);
                axios.get('/api/getMessages/'+this.user.id+'/'+this.selected.id).then(response=>{
                   this.messages = response.data;
                    this.scrollToBottom();
                });
            },

            handleIncoming(message){
                if(this.selected && message.sender_id === this.selected.id ){
                    this.messages.push(message);
                    this.scrollToBottom();
                    return;
                }
                this.updateUnreadCount(this.contacts.filter(x=>x.id === message.sender_id)[0], false);
            },

            updateUnreadCount(contact, reset){
                this.contacts = this.contacts.map((single)=>{
                    if(single.id !== contact.id){
                        return single;
                    }
                    if(reset){
                        single.unread = 0;
                    }else{
                        single.unread += 1;
                    }
                    return single;
                });
            }
        }

    }
</script>
