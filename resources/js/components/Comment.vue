<template>
    <div>
        <div class="comment-item" v-if="comment.del == 0">
            <i class="fa fa-times del" aria-hidden="true" @click="Del" v-if="comment.users.id==Sid"></i>
            <div class="avater-warpper">
                <img class="avatar" :src="'/storage/'+comment.users.Photo">
            </div>
            <div class="comment-data">
                <div class="user-data">
                    <a :href="'/profile/'+comment.users.id">{{comment.users.name+' '+comment.users.Surname}}</a>    
                </div>
                <div class="comment-content" v-html="content_filter(comment.content)">
                </div>
                <div class="item-info">
                    <p><i class="fa fa-clock-o" aria-hidden="true"></i> {{comment.created_at | data}}</p>
                    <p><i class="fa fa-heart" @click="Like" v-bind:class="{red: comment.is_like==1}" aria-hidden="true"> </i>{{comment.likes}}</p>
                </div>
            </div>
        </div>
        <div class="comment-item" v-else>
            <button class="btn_std" @click="DelCancel" title="Восстоновить">Восстоновить</button>
        </div>
    </div>
</template>

<script>
import { mapActions,mapGetters } from 'vuex';
export default {
    props: {
        comment:
        {
            type: Object,
            required: true
        }
    },
    data()
    {
        return {

        }
    },
    computed: {
        ...mapGetters('user', ['GetSessionId']),
        Sid()
        {
            return this.GetSessionId;
        }
    },
    filters: {
        data: function (value) {
            value =  String(value);
            return value.substr(0, 10).replace(/-/g, ".")+" "+value.substr(11, 5);
        } 
    },
    methods: 
    {
        ...mapActions('post', ['CommentLikeOrDisLike', 'DelCommentCancel', 'DelComment']),
        content_filter: function (val)
        {
            return val.replace(/\n/g, "<br/>");
        },
        Like()
        {
            if(this.Sid!=0)
            {
                const Like = {
                    user_id: this.Sid,
                    comment_id: this.comment.id,
                    is_like: this.comment.is_like,
                    post_id: this.comment.post_id
                }
                this.CommentLikeOrDisLike(Like);
            }
            else
            {
                this.$emit('show-event');
            }
        },
        Del()
        {
            const data = {
                id: this.comment.id,
            }
            this.DelComment(data);
        },
        DelCancel()
        {
            const data = {
                id: this.comment.id,
            }
            this.DelCommentCancel(data);
        }
    }
    
}
</script>