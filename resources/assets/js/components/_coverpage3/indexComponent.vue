<template>
    <div class="inner_home_bg">
		<div class="container">
			<div class="inner_home">
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
							<li><router-link to="/my/magazineProfile">MAGAZINE <b> PROFILE </b></router-link></li>
							<li><router-link to="/my/myLibrary">MY <b> LIBRARY </b></router-link></li>
							<li><router-link to="/home">MY <b> CUSTOMIZED PAGES</b></router-link></li>
							<li><a href="#">FAQ</a></li>
							<li><router-link to="/logout">Logout</router-link></li>
						  </ul>
						</div>
					</nav>
				</div>
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 home_content">
					<div class="inner_container">
						<div class="col-sm-4 col-md-4 col-xs-12 left_side ">
							<div class="border_full">
								<div :class="{'inner_left_side': true, 'active': activeClassFront }">
									<h4>Front Cover</h4>
									<div class="inner_left_img">
										<router-link to="/cover1/frontCover">
											<img src="magazine/images/cover1.jpg" alt="" title="">
										</router-link>
									</div>
								</div>
								<div :class="{'inner_left_side': true, 'active': activeClassInFront }">
									<h4>Inside Front Cover</h4>
									<div class="inner_left_img ">
										<router-link to="/cover1/insideFrontCover">
											<img src="magazine/images/2.png" alt="" title="">
										</router-link>
									</div>
								</div>
								<div :class="{'inner_left_side': true, 'active': activeClassInBack }">
									<h4>Inside Back Cover</h4>
									<div class="inner_left_img ">
										<router-link to="/cover1/insideBackCover">
											<img src="magazine/images/3.png" alt="" title="">
										</router-link>
									</div>
								</div>
								<div :class="{'inner_left_side': true, 'active': activeClassBack }">
									<h4>Back Cover</h4>
									<div class="inner_left_img ">
										<router-link to="/cover1/backCover">
											<img src="magazine/images/4.png" alt="" title="">
										</router-link>
									</div>
								</div>
							</div>
						</div>
						<!-- Component Changes -->
						<!-- <keep-alive>
							<component :is="this.$store.state.dynamicComponent"></component>
						</keep-alive> -->
						<router-view class="view"></router-view>
						<!-- Component end -->
					</div>
 				</div>
			</div>
		</div>
	</div>
</template>

<script>
	// import frontCoverCompnent from './frontCoverComponent.vue';
	// import insideFrontCoverComponent from './insideFrontCoverComponent.vue';
	import { mapState, mapMutations, mapActions } from 'vuex';
    export default {
		computed: {
            ...mapState([
				'activeClassFront',
				'activeClassInFront',
				'activeClassInBack',
				'activeClassBack',
				'insideFrontCover',
			]),
        },
        data () {
            return {
				title: 'Travel the world',
				bookId: 1,
				activeFront: false,
				activeInsideFront: false,
				activeInsideBack: false,
				activeBack: false,
				// dynamicComponent: this.$session.has('currentComponent') ? this.$session.has('currentComponent') : frontCoverCompnent
            }
		},
        mounted () {
			// set Active class
			//  axios.get(this.$url + 'api/usersBook/' + 1, {
            //     headers: {
            //         Authorization: this.$session.get('accessToken')
            //     }
            // })
            // .then(response => {				
			// 	if (this.insideFrontCover.length  < 1) {
			// 		this.setDataToinsideFrontEnd(response.data.data)
			// 	}
            //     this.title = this.coverTile1
            // })
		},
		methods: {
			...mapMutations([
				'PUSH_IN_INSIDE_FRONT_COVER',
			]),
			
			setDataToinsideFrontEnd (resp) {
				this.PUSH_IN_INSIDE_FRONT_COVER(resp)				
			}
		}
    }
</script>
