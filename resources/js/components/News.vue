<template>
    <section class="post">
        <div v-if="AllPosts.length">
        <Post 
            v-for="posts in AllPosts" :key="posts.id"
            v-bind:posts="posts"
            
            @show-event="ShowMessage"
            />
        </div>
            <div v-else>
                <div class="cssload-thecube">
	            <div class="cssload-cube cssload-c1"></div>
	            <div class="cssload-cube cssload-c2"></div>
	            <div class="cssload-cube cssload-c4"></div>
	            <div class="cssload-cube cssload-c3"></div>
            </div>
            
        </div>
        <div class="message-hidden" v-bind:class="{show: Show}">
            <i class="fa fa-times" aria-hidden="true" @click="NoShow"></i>
            <p>Чтобы совершить это действие нужно войти или зарегистрироватся</p>
            <a href="/auth" class="btn_std">Перейти</a>
        </div>
    </section>
</template>

<script>
import { component } from 'vue';
import {mapActions, mapGetters} from 'vuex'
import Post from './../components/Post'
export default {
    data()
    {
        return {
            isShow: false,
            post_content: ''
        }
    },
    // computed: mapGetters('user', ['GetUser']),
    // computed: mapGetters('post', ['GetPosts']),
    computed: {
        ...mapGetters('user', ['GetSessionId']),
        ...mapGetters('post', ['GetPosts']),
        AllPosts()
        {
            return this.GetPosts;
        },
        Sid()
        {
            return this.GetSessionId;
        },
        Show()
        {
            return this.isShow;
        }
    },
    methods:{
        ...mapActions('user', ['User', 'SessionId']),
        ...mapActions('post', ['AllNewsPosts']),
        LoadUser()
        {
            this.SessionId();
        },
        LoadPost()
        {
            this.AllNewsPosts(this.ItUser);
        },
        NoShow()
        {
            this.isShow=false;
        },
        ShowMessage()
        {
            this.isShow=true;
        }
    },
    created()
    {
        this.LoadUser();
        this.LoadPost();
    },
    components:
    {
        Post
    }
}
</script>

<style scoped>
.cssload-thecube {
	width: 169px;
	height: 169px;
	margin: 0 auto;
	margin-top: 113px;
	position: relative;
	transform: rotateZ(45deg);
		-o-transform: rotateZ(45deg);
		-ms-transform: rotateZ(45deg);
		-webkit-transform: rotateZ(45deg);
		-moz-transform: rotateZ(45deg);
}
.cssload-thecube .cssload-cube {
	position: relative;
	transform: rotateZ(45deg);
		-o-transform: rotateZ(45deg);
		-ms-transform: rotateZ(45deg);
		-webkit-transform: rotateZ(45deg);
		-moz-transform: rotateZ(45deg);
}
.cssload-thecube .cssload-cube {
	float: left;
	width: 50%;
	height: 50%;
	position: relative;
	transform: scale(1.1);
		-o-transform: scale(1.1);
		-ms-transform: scale(1.1);
		-webkit-transform: scale(1.1);
		-moz-transform: scale(1.1);
}
.cssload-thecube .cssload-cube:before {
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgb(0,0,0);
	animation: cssload-fold-thecube 2.16s infinite linear both;
		-o-animation: cssload-fold-thecube 2.16s infinite linear both;
		-ms-animation: cssload-fold-thecube 2.16s infinite linear both;
		-webkit-animation: cssload-fold-thecube 2.16s infinite linear both;
		-moz-animation: cssload-fold-thecube 2.16s infinite linear both;
	transform-origin: 100% 100%;
		-o-transform-origin: 100% 100%;
		-ms-transform-origin: 100% 100%;
		-webkit-transform-origin: 100% 100%;
		-moz-transform-origin: 100% 100%;
}
.cssload-thecube .cssload-c2 {
	transform: scale(1.1) rotateZ(90deg);
		-o-transform: scale(1.1) rotateZ(90deg);
		-ms-transform: scale(1.1) rotateZ(90deg);
		-webkit-transform: scale(1.1) rotateZ(90deg);
		-moz-transform: scale(1.1) rotateZ(90deg);
}
.cssload-thecube .cssload-c3 {
	transform: scale(1.1) rotateZ(180deg);
		-o-transform: scale(1.1) rotateZ(180deg);
		-ms-transform: scale(1.1) rotateZ(180deg);
		-webkit-transform: scale(1.1) rotateZ(180deg);
		-moz-transform: scale(1.1) rotateZ(180deg);
}
.cssload-thecube .cssload-c4 {
	transform: scale(1.1) rotateZ(270deg);
		-o-transform: scale(1.1) rotateZ(270deg);
		-ms-transform: scale(1.1) rotateZ(270deg);
		-webkit-transform: scale(1.1) rotateZ(270deg);
		-moz-transform: scale(1.1) rotateZ(270deg);
}
.cssload-thecube .cssload-c2:before {
	animation-delay: 0.265s;
		-o-animation-delay: 0.265s;
		-ms-animation-delay: 0.265s;
		-webkit-animation-delay: 0.265s;
		-moz-animation-delay: 0.265s;
}
.cssload-thecube .cssload-c3:before {
	animation-delay: 0.54s;
		-o-animation-delay: 0.54s;
		-ms-animation-delay: 0.54s;
		-webkit-animation-delay: 0.54s;
		-moz-animation-delay: 0.54s;
}
.cssload-thecube .cssload-c4:before {
	animation-delay: 0.805s;
		-o-animation-delay: 0.805s;
		-ms-animation-delay: 0.805s;
		-webkit-animation-delay: 0.805s;
		-moz-animation-delay: 0.805s;
}



@keyframes cssload-fold-thecube {
	0%, 10% {
		transform: perspective(315px) rotateX(-180deg);
		opacity: 0;
	}
	25%,
				75% {
		transform: perspective(315px) rotateX(0deg);
		opacity: 1;
	}
	90%,
				100% {
		transform: perspective(315px) rotateY(180deg);
		opacity: 0;
	}
}

@-o-keyframes cssload-fold-thecube {
	0%, 10% {
		-o-transform: perspective(315px) rotateX(-180deg);
		opacity: 0;
	}
	25%,
				75% {
		-o-transform: perspective(315px) rotateX(0deg);
		opacity: 1;
	}
	90%,
				100% {
		-o-transform: perspective(315px) rotateY(180deg);
		opacity: 0;
	}
}

@-ms-keyframes cssload-fold-thecube {
	0%, 10% {
		-ms-transform: perspective(315px) rotateX(-180deg);
		opacity: 0;
	}
	25%,
				75% {
		-ms-transform: perspective(315px) rotateX(0deg);
		opacity: 1;
	}
	90%,
				100% {
		-ms-transform: perspective(315px) rotateY(180deg);
		opacity: 0;
	}
}

@-webkit-keyframes cssload-fold-thecube {
	0%, 10% {
		-webkit-transform: perspective(315px) rotateX(-180deg);
		opacity: 0;
	}
	25%,
				75% {
		-webkit-transform: perspective(315px) rotateX(0deg);
		opacity: 1;
	}
	90%,
				100% {
		-webkit-transform: perspective(315px) rotateY(180deg);
		opacity: 0;
	}
}

@-moz-keyframes cssload-fold-thecube {
	0%, 10% {
		-moz-transform: perspective(315px) rotateX(-180deg);
		opacity: 0;
	}
	25%,
				75% {
		-moz-transform: perspective(315px) rotateX(0deg);
		opacity: 1;
	}
	90%,
				100% {
		-moz-transform: perspective(315px) rotateY(180deg);
		opacity: 0;
	}
}
</style>