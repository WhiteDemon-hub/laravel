<template>
    <ul>
            <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Дом</a></li>
            <li><a href="/list"><i class="fa fa-address-book" aria-hidden="true"></i> Друзья</a><div class="count" v-if="GetRequestList.length">{{GetRequestList.length}}</div></li>
            <li><a href=""><i class="fa fa-envelope" aria-hidden="true"></i> Сообщения</a></li>
            <li><a href="/news"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Новости</a></li>
    </ul>
</template>

<script>
import { component } from 'vue';
import {mapActions, mapGetters} from 'vuex'
export default {
    computed: {
        ...mapGetters('user', ['GetSessionId']),
        ...mapGetters('friendlist', ['GetRequestList']),
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
        ...mapActions('friendlist', ['UpdateRequestList']),
        LoadData()
        {
            this.UpdateRequestList();
        },
    },
    created()
    {
        this.LoadData();
    },
}
</script>