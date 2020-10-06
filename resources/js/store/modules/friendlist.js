export default {
    namespaced: true,
    actions:
    {
        async UpdateFriendList({commit}, data)
        {
            axios
            .get('/friend-this-user')
            .then(
                response =>
                {
                    commit("MutationFriendList", response.data.ThisUserFriend);
                }
            )
        },
        UpdateRequestList({commit}, data)
        {
            axios
            .get('/response-friend')
            .then(
                response =>
                {
                    commit("MutationRequestList", response.data.ResponseFriend);
                    console.log(response.data.ResponseFriend);
                }
            )
        },
        async AddFriend({commit}, data)
        {
            let b = await axios
            .post('/friendlist', data)
            commit("MutationUpdate", b.data)
        },
        async FriendDelete({commit}, data)
        {
            let a =
            await axios
            .delete('/friendlist/'+data.id)
            commit("MutationUpdate", a.data)
        },
        async FriendDeny({commit}, data)
        {
            let a =
            await axios
            .delete('/friendlist/'+data.id)
            commit("MutationDeny", a.data)
        },
        async FriendConfirm({commit}, data)
        {
            console.log(data)
            let b = await axios
            .post('/confirm-friend', data)
            commit("MutationConfirm", b.data)
            
        }
    },
    mutations:
    {
        MutationRequestList(state, data)
        {
            state.requestfriend=data;
        },
        MutationFriendList(state, data)
        {
            state.friendlist=data;
        },
        MutationUpdate(state, data)
        {
            state.friendlist.find(x=>x.id==data.id).status = data.status;
        },
        MutationDeny(state, data)
        {
            state.requestfriend.splice(state.requestfriend.indexOf(state.requestfriend.find(x=>x.id==data.id)), 1);
        },
        MutationConfirm(state, data)
        {
            state.friendlist.unshift(state.requestfriend.find(x=>x.id==data.id));
            state.requestfriend.splice(state.requestfriend.indexOf(state.requestfriend.find(x=>x.id==data.id)), 1);
            state.friendlist.find(x=>x.id==data.id).status = data.status;
        }
    },
    state:
    {
        friendlist: [],
        requestfriend: []
    },
    getters:
    {
        GetList(state)
        {
            return state.friendlist;
        },
        GetRequestList(state)
        {
            return state.requestfriend;
        }
    }
}