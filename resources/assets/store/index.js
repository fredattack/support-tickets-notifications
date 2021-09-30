import {createStore} from 'vuex'
export default createStore({
    state: { auth:{}},
    getters:{},
    mutations: {
        INSERT_AUTH(state, user){
            state.auth = user
        },
    },
    actions:{
        async insertAuth({commit}, payload){
            //make some kind of ajax request
            console.log('insertAuth',payload)
            try{

                // can commit multiple mutations in an action
                commit('INSERT_AUTH', payload)

            }catch(error){
                console.log('error',error)
                commit('INSERT_ERROR', error)
            }
        }
    }
})
