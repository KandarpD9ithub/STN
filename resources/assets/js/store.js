import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
export const store = new Vuex.Store({
    state: {
        loginUsersDetail: [],
        stnCheckbox: [],
        storeBookId: '',
        coverTitle1: '',
        dynamicComponent: '',
        frontCover: [],
        insideFrontCover: [],
        backCover: [],
        userDetails: [],
        title: 'kandarp pandya',
        activeClassFront: false,
        activeClassInFront: false,
        activeClassInBack: false,
        activeClassBack: false,
        errorMessage: [],
        successMessage: [],
    },
    actions: {
        EMPTY_INSIDE_FRONTCOVER (state) {
            state.insideFrontCover = []            
        },
        EMPTY_INSIDE_BACKCOVER (state) {
            state.backCover = []
        },
        
    },
    mutations: {
        GET_USER_DETAILS(state, data) {
            state.userDetails.push(data)
        },
        SET_ACTIVE_CLASS(state, active) {
            state.activeClassFront = false;
            state.activeClassInFront = false;
            state.activeClassInBack = false;
            state.activeClassBack = false;
            if(active === 1){
                state.activeClassFront = true
            }
            if(active === 2){
                state.activeClassInFront = true
            }
            if(active === 3){
                state.activeClassInBack = true
            }
            if(active === 4){
                state.activeClassBack = true
            }
        },
        PUSH_IN_INSIDE_FRONT_COVER (state, response) {
            state.insideFrontCover = []
            state.insideFrontCover.push(response)
            // console.log(state.insideFrontCover, 'storage vur')
        },
        EMPTY_MESSAGE_LIST (state) {
            state.errorMessage = []
            state.successMessage = []
        },
        PUSH_MESSAGE (state, data) {
            state.errorMessage = []
            state.successMessage = []
            state.successMessage.push({message: data});
        },
        PUSH_ERROR_MESSAGE (state, data) {
            state.errorMessage = []
            state.errorMessage.push({message: data});
        }

    },
    getters: {
        
    },  
    modules: {
      
    }
});
