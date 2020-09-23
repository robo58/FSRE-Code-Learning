<template>
        <div>
            <img :src="'/uploads/avatars/'+user.avatar" alt="no img" style="width:15%; height:15%; float:left; border-radius:50%; margin-right:25px;">
            <h4>{{ user.name }}</h4>
            <small>{{ user.email }}</small>
            <div class="d-flex justify-content-end">
                <slot name="unread"></slot>
            </div>
        </div>
</template>

<script>
    export default {
        name: "UserInfoChat",
        props:['user','loggedInUser'],
    }
</script>
