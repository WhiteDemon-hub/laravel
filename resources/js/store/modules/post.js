export default
{
    namespaced: true,
    actions: {
        async AllUserPosts({commit}, data)
        {
            await axios
            .get('/post-user?id=' + data.id)
            .then(
                response =>{
                    console.log(response.data.post)
                    commit('LoadPost', response.data.post)
                }
            );
        },
        async CreatePost({commit}, data)
        {
            let answer =
            await axios
            .post('/post', data)
                commit('AddPost', answer.data.post)
                console.log(answer.data.post);
        },
        async CreateComment({commit}, data)
        {
            let answer =
            await axios
            .post('/comment', data)
            commit('AddComment', answer.data.comment)
        },
        async LikeOrDisLike({commit}, data)
        {
            await axios
            .post('/post-like', data)
            commit('Like', data)
        },
        async CommentLikeOrDisLike({commit}, data)
        {
            await axios
            .post('/comment-like', data)
            commit('CommentLike', data)
        }
    },
    mutations: {
        LoadPost(state, data)
        {
            state.posts = data
        },
        AddPost(state, data)
        {
            state.posts.unshift(data)
        },
        AddComment(state, data)
        {
            state.posts.find(item=>item.id==data.post_id).comments.unshift(data);
        },
        Like(state, data)
        {
            if(state.posts.find(item=>item.id==data.post_id).is_like==0)
            {
                state.posts.find(item=>item.id==data.post_id).is_like=1;
                state.posts.find(item=>item.id==data.post_id).likes=state.posts.find(item=>item.id==data.post_id).likes+1;
            }
            else
            {
                state.posts.find(item=>item.id==data.post_id).is_like=0;
                state.posts.find(item=>item.id==data.post_id).likes=state.posts.find(item=>item.id==data.post_id).likes-1;
            }
        },
        CommentLike(state, data)
        {
            if(state.posts.find(item=>item.id==data.post_id).comments.find(x=>x.id==data.comment_id).is_like==0)
            {
                state.posts.find(item=>item.id==data.post_id).comments.find(x=>x.id==data.comment_id).is_like=1;
                state.posts.find(item=>item.id==data.post_id).comments.find(x=>x.id==data.comment_id).likes=state.posts.find(item=>item.id==data.post_id).comments.find(x=>x.id==data.comment_id).likes+1;
            }
            else
            {
                state.posts.find(item=>item.id==data.post_id).comments.find(x=>x.id==data.comment_id).is_like=0;
                state.posts.find(item=>item.id==data.post_id).comments.find(x=>x.id==data.comment_id).likes=state.posts.find(item=>item.id==data.post_id).comments.find(x=>x.id==data.comment_id).likes-1;
            }
        }
    },
    state: {
        posts: []
    },
    getters: {
        GetPosts(state)
        {
            return state.posts
        }
    }
}