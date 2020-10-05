<template>
    <div id="header">
        <!-- <p>Имя пользователья: {{user.login}}</p> -->
            <div class="logo">
                <img src="" alt="">
                <h1>SN</h1>
            </div>
            <form @submit.prevent="Exit" v-if="Sid!=0">
                <button type="submit" class="btn_std">Выйти</button>
            </form>
            <form @submit.prevent="ToCome" v-else>
                <button type="submit" class="btn_std">Войти</button>
            </form>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex' 
export default {
    methods: mapActions('user', ['Quit']),
    methods:
    {
        ...mapActions('user', ['Quit']),
        Exit()
        {
            this.Quit()
        },
        ToCome()
        {
            window.location = "/auth"
        }
    },
    computed: {
        ...mapGetters('user', ['GetSessionId']),
        Sid()
        {
            return this.GetSessionId;
        }
    },
}
</script>