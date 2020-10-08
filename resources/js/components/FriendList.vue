<template>
    <section class="friendList">
        <div class="find">
            <input type="text" name="" id="" v-model="find_text" placeholder="Поиск...">
            <FindUser 
            v-for="user of FindResult" :key="user.id"
            v-bind:user="user"
            />
        </div>
        <div class="friend-requests">
            <h2>Заявки</h2>
            <ProposalFriend
            v-for="request_friend of Request" :key="request_friend.id"
            v-bind:request_friend="request_friend"
           />
        </div>
        <div class="friend">
            <h2>Друзья</h2>
            <FrienItem
            v-for="friends of AllFriend" :key="friends.id"
            v-bind:friend="friends"/>
        </div>
    </section>
</template>

<script>
import { component } from 'vue';
import {mapActions, mapGetters} from 'vuex'
import FrienItem from './../components/FrienItem'
import FindUser from './../components/FindUser'
import ProposalFriend from './../components/ProposalFriend'
export default {
    data()
    {
        return{
            find_text: ''
        }
    },
    computed: {
        ...mapGetters('user', ['GetSessionId', 'GetFind']),
        ...mapGetters('friendlist', ['GetList', 'GetRequestList']),
        AllFriend()
        {
            return this.GetList;
        },
        Sid()
        {
            return this.GetSessionId;
        },
        Request()
        {
            return this.GetRequestList;
        },
        FindResult()
        {
            return this.GetFind;
        }
    },
    watch: {
        find_text(newVal) {
            if(newVal.length > 2)
            {
                const data = {
                    findText: this.find_text
                }
                this.Find(data);
            }
        },
    },
    methods:
    {
        ...mapActions('user', ['SessionId', 'Find']),
        ...mapActions('friendlist', ['UpdateFriendList', 'UpdateRequestList']),
        LoadData()
        {
            this.SessionId();
            this.UpdateFriendList();
            this.UpdateRequestList();
        },
        // Find()
        // {
        //     if(this.find_text.length > 2)
        //     {
        //         const data = {
        //             findText: this.find_text
        //         }
                
        //         this.Find(data);
        //     }
        // }
    },
    created()
    {
        this.LoadData();
    },
    components:
    {
        FrienItem,
        ProposalFriend,
        FindUser
    }
}
</script>