<template>
    <div id="header">
        <!-- <p>Имя пользователья: {{user.login}}</p> -->
            <form @submit.prevent="Exit">
                <button type="submit" class="btn_std">Выйти</button>
            </form>
    </div>
</template>

<script>
import {mapActions} from 'vuex' 
export default {
    methods: mapActions('user', ['Quit']),
    methods:
    {
        ...mapActions('user', ['Quit']),
        Exit()
        {
            this.Quit()
        }
    }
}
</script>