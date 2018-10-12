<template>
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
        <nav class="navbar">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                <!--<li><router-link to="/my/magazineProfile">MARKETING CONTACT INFO </router-link></li>-->
                <li><router-link to="/my/myLibrary">LIBRARY OF ASSETS</router-link></li>
                <li><router-link to="/home">MY CUSTOMIZED PAGES</router-link></li>
                <li><router-link to="/logout">LOGOUT</router-link></li>
                </ul>
            </div>
        </nav>
        <!-- alert error message -->
        <div  v-if="errorMessage.length > 0" class="alert alert-danger alert-dismissible fade in">
            <a class="close" data-dismiss="alert" aria-label="close" @click="emptyMessage">&times;</a>
            <strong v-for="(er,index) in errorMessage" :key="index" > {{ er.message }} </strong>
        </div>
        <!-- alert success message -->
        <div v-if="successMessage.length > 0" class="alert alert-success alert-dismissible fade in">
            <a class="close" data-dismiss="alert" aria-label="close" @click="emptyMessage">&times;</a>
            <strong v-for="(ss,index) in successMessage" :key="index" > {{ ss.message }} </strong>
        </div>
</div>
</template>

<script>
import {mapMutations, mapGetters, mapState, mapActions} from 'vuex';
export default {
    computed: {
        ...mapState([
            'errorMessage',
            'successMessage',
        ])
    },
    data () {
        return {
            // errorMessage: [],//errors varidale define as null
        }
    },
    mounted () {
        // redirect to login if not authenticated
        if (!this.$session.exists('accessToken')) {
            this.$router.push('/')
        }
        
    },
    created () {
        // console.log(this.successMessage, 'successmessage')
    },
    methods: {
        ...mapMutations ([
            'EMPTY_MESSAGE_LIST',
        ]),
        emptyMessage () {
            this.EMPTY_MESSAGE_LIST();
        },
    }
}
</script>

