<template>
        <div>
        <div class="post-item" v-if="posts.del == 0">
            <i class="fa fa-times del" aria-hidden="true" @click="Del" v-if="posts.users.id==Sid"></i>
            <div class="user-data">
                <div class="avater-warpper">
                    <img class="avatar" :src="'/storage/'+posts.users.Photo">
                </div>
                <a :href="'/profile/'+posts.users.id">{{posts.users.name+' '+posts.users.Surname}}</a>    
            </div>
            <div class="post-content" v-html="content_filter(posts.content)">
                    
            </div>
            <div class="item-info">
                <p><i class="fa fa-clock-o" aria-hidden="true"></i> {{posts.created_at | data}}</p>
                <p><i class="fa fa-heart"  aria-hidden="true" @click="Like" v-bind:class="{red: posts.is_like==1}" ></i>{{posts.likes}}</p>
            </div>
            <hr/>
            <Comment v-for="comment in posts.comments" :key="comment.id"
                v-bind:comment="comment"
                @show-event="ShowEvent"/>
                <hr>
                <div class="create-comment">
                    <form @submit.prevent="NewComment">
                        <!-- <input type="hidden" name="post_id" v-model="post_id" :value="posts.id"> -->
                        <textarea name="" id="" cols="30" rows="10" placeholder="Прокоментировать это..." required v-model="content_comment"></textarea>
                        <button type="submit" class="btn_min" title="Добавить"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </form>
                </div>
        </div>
        <div class="post-item" v-else>
            <button class="btn_std" @click="DelCancel" title="Восстоновить">Восстоновить</button>
        </div>
    </div>
</template>
<script>
import { component } from 'vue';
import {mapActions, mapGetters} from 'vuex'
import Comment from './../components/Comment'
export default {
    props:{
        posts:
        {
            type: Object,
            required: true
        },
    },
    data()
    {
        return {
            post_content: '',
            content_comment: '',
            post_id: ''
        }
    },
    // computed: mapGetters('user', ['GetUser']),
    // computed: mapGetters('post', ['GetPosts']),
    computed: {
        ...mapGetters('user', ['GetUser', 'GetSessionId']),
        ...mapGetters('post', ['GetPosts']),
        ItUser()
        {
            return this.GetUser;
        },
        Sid()
        {
            return this.GetSessionId;
        },
        Show()
        {
            return this.show
        }
    },
    filters: {
        data: function (value) {
            value =  String(value);
            return value.substr(0, 10).replace(/-/g, ".")+" "+value.substr(11, 5);
        },
    },
    methods:{
        ...mapActions('user', ['User', 'SessionId']),
        ...mapActions('post', ['AllUserPosts', 'CreateComment', 'LikeOrDisLike', 'DelPost', 'DelPostCancel']),
        content_filter: function (val)
        {
            // var txt = document.createElement("textarea");
            // txt.innerHTML = val;
            return val.replace(/\n/g, "<br/>");
        },
        NewComment()
        {
            if(this.Sid!=0)
            {
                const Comment = {
                    user_id: this.Sid,
                    post_id: this.posts.id,
                    content: this.content_comment
                }

                this.CreateComment(Comment);
                this.content_comment = '';
            }
            else
            {
                 this.$emit('show-event');
            }
        },
        Like()
        {
            if(this.Sid!=0)
            {
                const Like = {
                    user_id: this.Sid,
                    post_id: this.posts.id,
                    is_like: this.posts.is_like
                }
                this.LikeOrDisLike(Like);
            }
            else
            {
                this.$emit('show-event');
            }
        },
        ShowEvent()
        {
             this.$emit('show-event');
        },
        Del()
        {
            const data = {
                id: this.posts.id,
            }
            this.DelPost(data);
        },
        DelCancel()
        {
            const data = {
                id: this.posts.id,
            }
            this.DelPostCancel(data);
        }
    },
    components:
    {
        Comment
    }
}
</script>