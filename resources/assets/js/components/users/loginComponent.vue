<template>
       <div class="login_bg">
		<div class="container">
			<div class="col-sm-5 col-xs-12 col-md-4 col-lg-5 pull-left">
				<div class="login_inner">
					<div class="login_form">
						<div v-if="errorMessage.length > 0">
							<h4 v-for="(er,index) in errorMessage" :key="index" class="alert alert-danger" >{{ er.message }}</h4>
						</div>
						<div class="form-group">
							<input data-vv-name="username" v-validate="{ required: true }"  type="text" :class="{'form-control': true, 'alert-danger': errors.has('username') }" v-model="users.username" name="" placeholder="Username" @keyup.enter="onSubmit">
							<span v-show="errors.has('username')" class="color-red">{{ errors.first('username') }}</span>
						</div>
						<div class="form-group">
							<input data-vv-name="password" v-validate="{ required: true }"  type="password" v-model="users.password" :class="{'form-control': true, 'alert-danger': errors.has('password') }" name="" placeholder="Password" @keyup.enter="onSubmit">
							<span v-show="errors.has('password')" class="color-red">{{ errors.first('password') }}</span>
						</div>
						<div class="form-group">
							<!--<input type="submit" class="submit_btn" value="Submit">-->
                            <!-- <a href="home.html" class="submit_btn" >Submit </a> -->
                            <button type="button" v-on:click="onSubmit" class="submit_btn">Submit</button>
                            <!-- <a href="" class="submit_btn" >Register </a>
							<router-link class="submit_btn" to = "/example">Register</router-link> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import {mapMutations, mapGetters, mapState, mapActions} from 'vuex';
    export default {
        data(){
            return {
                users: {
                    username: '',
                    password: '',
                },//this is for category creation time set all data null
                errorMessage: [],//errors varidale define as null
            }
        },
        mounted() {
			// call this function whent component is mounted
            console.log('Component mounted.')
		},
		methods: {
			// For state data from the vuex store
			...mapState ([
				'coverTitle1',
			]),
			// For mutations data from the vuex store
			...mapMutations([
				'GET_USER_DETAILS',
			]),
			onSubmit() {
				// whent form submit this functrion called
				// check validation
				// assign errorMessage to null
				this.errorMessage = []
				this.$validator.validateAll().then(result => {
					if(result) {
						axios.post(this.$url + 'api/login', {
							username: this.users.username,
							password: this.users.password
						})
						.then(response => {
							// this.errorMessage.push(response.data)
							// Set access token to session							
							this.$store.state.loginUsersDetail.push(response.data)
							this.$session.set('userName', response.data.data.name)
							this.$session.set('userId', response.data.data.id)
							this.$session.set('userCompanyName', response.data.data.agency)
							this.$session.set('magazineProfile', response.data.data)
							var access = 'Bearer ' + response.data.accessToken
							this.$session.set('accessToken', access)
							this.getStates()
							// console.log(this.$session.get('userName'),response.data.data.name, response.data)

							// get books details of users.
							// axios.get(this.$url + 'api/usersBook/' + response.data.data.id)
							// .then(userBookResponse => {
							// 	console.log(userBookResponse.data, 'book reaspnse')
							// })
							// .catch(userBookError => {
							// 	console.log('errors', userBookError)
							// })
							// this.GET_USER_DETAILS(response.data.data);
							this.$router.push('home')
							// window.location.href = '/home'
						})
						.catch(errorsResponse => {
							// console.log(errorsResponse, 'errors')
							this.errorMessage.push(errorsResponse.response.data)
						})
					}
				});			
			},
			getStates () {
            axios.get(this.$url + 'api/stateAndCity', {
                headers: {
                    Authorization: this.$session.get('accessToken')
                }
            })
            .then(response => {
                // console.log(response.data)
				// this.stateData = response.data.state
				this.$session.set('states', response.data.state)
            })
        },
		}
		
    }
</script>