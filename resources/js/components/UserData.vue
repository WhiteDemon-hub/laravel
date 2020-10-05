<template>
    <section class="user-info">
        <div class="head-avatar">
            <img :src="'/storage/'+GetUser.Photo">
        </div>
        <div>
            <p>{{GetUser.name + " " + GetUser.Surname + " " + GetUser.Middlename}}</p>
        </div>    
            <div class="update-photo" v-if="GetUser.id==Sid">
                <form>

                </form>
            </div>
            <div class="action" v-else>
                <button class="btn_std" @click="FriendAdd" v-if="Friend==2">Добавить</button>
                <button class="btn_std_re"  disabled v-if="Friend==0">Запрос отправлен</button>
                <button class="btn_std" @click="FriendDel" v-if="Friend==1">Удалить</button>
                <button class="btn_std">Написать сообщение <i class="fa fa-envelope" aria-hidden="true"></i></button>
            </div>
    </section>
</template>

<script>
import { component } from 'vue';
import {mapActions, mapGetters} from 'vuex'
export default {
    props:[
        'user'
    ],
    data()
    {
        return {
        }
    },
    computed: {
        ...mapGetters('user', ['GetUser', 'GetSessionId', 'GetFriendInfo']),
        ItUser()
        {
            return this.GetUser;
        },
        Sid()
        {
            return this.GetSessionId;
        },
        Friend()
        {
            return this.GetFriendInfo;
        }
    },
    methods:{
        ...mapActions('user', ['User', 'SessionId', 'AddFriend', 'FriendInfo', 'FriendDelete']),
        LoadUser()
        {
            this.User(this.user);
            this.SessionId();
            this.FriendInfo(this.user);
        },
        FriendAdd()
        {
            const data = {
                id: this.ItUser.id
            }
            this.AddFriend(data);
        },
        FriendDel()
        {
            const data = {
                id: this.ItUser.id
            }
            this.FriendDelete(data);
        }
    },
    created()
    {
        this.LoadUser();
    },
}
</script>