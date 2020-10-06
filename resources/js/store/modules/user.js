export default {
    namespaced: true,
    actions: {
        async Loging({commit}, data)
        {
            let message = await axios
            .post("user-auth", data)
            .then(
                    
            )
            if(message.data.message == '1')
                window.location = "/"
            else
            commit('Erorr', message)
        },
        async Registration({commit}, data)                             
        {;
            let message = await axios
             .post("user-register", data, {
                headers: {
                  'Content-Type': 'multipart/form-data'
                }}
            )
             .then(
                    
            )
            if(message.data.message == '1')
                window.location = "/"
            else
            commit('Erorr', message)
        },
        Quit()
        {   
            window.location = "/quit"
        },
        User({commit}, data)
        {
            commit('LoadUser', data);
        },
        async SessionId({commit})
        {
            await axios
            .get('/user-session')
            .then(
                response =>
                {
                    commit("LoadSession", response.data)
                }
            )
        },
        async AddFriend({commit}, data)
        {
            let b = await axios
            .post('/friendlist', data)
            commit("SendFriend", b.data.status)
        },
        async FriendInfo({commit}, data)
        {
            let b = await axios
            .post('/info-friend', data)
            commit("Finfo", b.data)
        },
        async FriendDelete({commit}, data)
        {
            let a =
            await axios
            .delete('/friendlist/'+data.id)
            commit("Finfo", a.data.status)
        }
    },
    mutations: {
        Erorr(state, data)
        {
            state.message = data.data.message;
        },
        LoadUser(state, data)
        {
            state.user = data;
        },
        LoadSession(state, data)
        {
            state.session_id = data;
        },
        SendFriend(state, data)
        {
            console.log(data);
            state.IsFriend = data;
        },
        Finfo(state, data)
        {
            state.IsFriend = data;
        }
    },
    state:
    {
        message: '',
        user: [],
        session_id: '',
        IsFriend: 2
    },
    getters:
    {
        GetMessage(state)
        {
            return state.message;
        },
        GetUser(state)
        {
            return state.user;
        },
        GetSessionId(state)
        {
            return state.session_id
        },
        GetFriendInfo(state)
        {
            return state.IsFriend;
        }
    }
}