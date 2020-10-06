<template>
    <div class="friend-list-item">
        <div class="avater-warpper">
                <img class="avatar" :src="'/storage/'+friend.Photo">
        </div>
            <div class="friend-info">
                <div>
                    <a :href="'/profile/'+friend.id">{{friend.name+' '+friend.Surname}}</a>    
                </div>
                <button class="btn_std" @click="FriendAdd" v-if="friend.status=='2'">Отменить</button>
                <button class="btn_std" @click="FriendDel" v-if="friend.status=='1'">Удалить</button>
                <button class="btn_std">Написать сообщение <i class="fa fa-envelope" aria-hidden="true"></i></button>
            </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
export default {
    props:
    {
        friend:
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
        ...mapActions('friendlist', ['AddFriend', 'FriendDelete']),
        FriendAdd()
        {
            const data = {
                id: this.friend.id,
                canceling: true
            }
            this.AddFriend(data);
        },
        FriendDel()
        {
            const data = {
                id: this.friend.id
            }
            this.FriendDelete(data);
        }
    }
}
</script>