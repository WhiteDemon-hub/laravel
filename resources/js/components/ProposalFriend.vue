<template>
    <div class="friend-list-item">
        <div class="avater-warpper">
                <img class="avatar" :src="'/storage/'+request_friend.Photo">
        </div>
            <div class="friend-info">
                <div>
                    <a :href="'/profile/'+request_friend.id">{{request_friend.name+' '+request_friend.Surname}}</a>    
                </div>
                <button class="btn_std" @click="FriendAdd">Подтвердить</button>
                <button class="btn_std" @click="FriendDel">Отклонить</button>
                <button class="btn_std">Написать сообщение <i class="fa fa-envelope" aria-hidden="true"></i></button>
            </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
export default {
    props:
    {
        request_friend:
        {
            type: Object,
            requerid: true
        },
    },
    computed: {
        ...mapGetters('user', ['GetSessionId']),
        Sid()
        {
            return this.GetSessionId;
        }
    },
    methods:
    {
        ...mapActions('friendlist', ['FriendConfirm', 'FriendDeny']),
        FriendAdd()
        {
            const data = {
                id: this.request_friend.id,
            }
            this.FriendConfirm(data);
        },
        FriendDel()
        {
            const data = {
                id: this.request_friend.id
            }
            this.FriendDeny(data);
        }
    }
}
</script>