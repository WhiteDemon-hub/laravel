<template>
    <div class="friend-list-item">
        <div class="avater-warpper">
                <img class="avatar" :src="'/storage/'+user.Photo">
        </div>
            <div class="friend-info">
                <div>
                    <a :href="'/profile/'+user.id">{{user.name+' '+user.Surname}}</a>    
                </div>
            </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
export default {
    props:
    {
        user:
        {
            type: Object,
            requerid: true
        },
    },
}
</script>