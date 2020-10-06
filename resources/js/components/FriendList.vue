<template>
    <section class="friendList">
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
import ProposalFriend from './../components/ProposalFriend'
export default {
    data()
    {
        return{
            
        }
    },
    computed: {
        ...mapGetters('user', ['GetSessionId']),
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
        }
    },
    methods:
    {
        ...mapActions('user', ['SessionId']),
        ...mapActions('friendlist', ['UpdateFriendList', 'UpdateRequestList']),
        LoadData()
        {
            this.SessionId();
            this.UpdateFriendList();
            this.UpdateRequestList();
        },
    },
    created()
    {
        this.LoadData();
    },
    components:
    {
        FrienItem,
        ProposalFriend
    }
}
</script>