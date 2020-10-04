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
        async Quit()
        {   
            let a =
            axios
            .get("quit")
            .then(
                window.location = "/"
            )
            console.log(a);
        }
    },
    mutations: {
        Erorr(state, data)
        {
            state.message = data.data.message;
        }
    },
    state:
    {
        message: ''
    },
    getters:
    {
        GetMessage(state)
        {
            return state.message;
        }
    }
}