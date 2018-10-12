<template>
    <div class="inner_home_bg">
		<div class="container">
			<div class="inner_home">
				<!-- sidebar Component -->
				<keep-alive>
					<component :is="navbarComponent"></component>
				</keep-alive>
				<!-- navbarComponent End -->
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 home_content">
					<div class="inner_container">
						<div class="pre_loading" v-if="loader"><swapping-squares-spinner
							:animation-duration="1000"
							:size="100"
							color="#7fcbce"
							/>
						</div>
						<div class="col-sm-4 col-md-4 col-xs-12 left_side ">
							<div class="border_full">
								<div :class="{'inner_left_side': true, 'active': activeClassFront }">
									<h4>Front Cover</h4>
									<div class="inner_left_img">
										<router-link :to="routerToFrontCover">
											<img :src="frontCoverImage" alt="" title="">
										</router-link>
									</div>
								</div>
								<div :class="{'inner_left_side': true, 'active': activeClassInFront }">
									<h4>Inside Front Cover</h4>
									<div class="inner_left_img ">
										<router-link :to="routerToInsideFrontCover">
											<img :src="insideFrontCoverImage" alt=""  title="">
										</router-link>
									</div>
								</div>
								<div :class="{'inner_left_side': true, 'active': activeClassInBack }">
									<h4>Inside Back Cover</h4>
									<div class="inner_left_img ">
										<router-link :to="routerToInsideBackCover">
											<img :src="insideBackCoverImage" alt="" title="">
										</router-link>
									</div>
								</div>
								<div :class="{'inner_left_side': true, 'active': activeClassBack }">
									<h4>Back Cover</h4>
									<div class="inner_left_img ">
										<router-link :to="routerToBackCover">
											<img :src="backCoverImage"  alt="" title="">
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
				 <!-- footer area -->
                <div class="col-sm-12 col-md-12 col-xs-12 footer_text">
					<p><router-link to="/my/magazineProfile">MARKETING CONTACT INFO </router-link> </p>
				</div>
                <!-- end footer area -->
			</div>
		</div>
	</div>
</template>

<script>
	// import frontCoverCompnent from './frontCoverComponent.vue';
	// import insideFrontCoverComponent from './insideFrontCoverComponent.vue';
	import { SwappingSquaresSpinner  } from 'epic-spinners'
	import navbarComponent from '../navbarComponent.vue'
	import { mapState, mapMutations, mapActions } from 'vuex'
    export default {
		components: {
			navbarComponent,
			'swapping-squares-spinner': SwappingSquaresSpinner,
		},
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
				navbarComponent: navbarComponent,
				activeFront: false,
				activeInsideFront: false,
				activeInsideBack: false,
				activeBack: false,
				loader: false,
				routerToFrontCover: '/cover1/frontCover',
				routerToInsideFrontCover: '/cover1/insideFrontCover',
				routerToInsideBackCover: '/cover1/insideBackCover',
				routerToBackCover: '/cover1/backCover',
				frontCoverImage: 'magazine/images/cover1.jpg',
				insideFrontCoverImage: 'magazine/images/ifc1.jpg',
				insideBackCoverImage: 'magazine/images/ibc1.jpg',
				backCoverImage: 'magazine/images/bc1.jpg',

				// dynamicComponent: this.$session.has('currentComponent') ? this.$session.has('currentComponent') : frontCoverCompnent
            }
		},
        mounted () {
			// set book wise data
			this.setPagesData()
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
			},
			runLoader (value) {
				if (value === 1) {
					this.loader = true
				} else {
					this.loader = false
				}
				
			},
			 setPagesData () {
				//  set routes book wise dynamic
				this.routerToFrontCover =  '/cover' + this.$session.get('bookCoverId') + '/frontCover'
				this.routerToInsideFrontCover =  '/cover' + this.$session.get('bookCoverId') + '/insideFrontCover'
				this.routerToInsideBackCover =  '/cover' + this.$session.get('bookCoverId') + '/insideBackCover'
				this.routerToBackCover =  '/cover' + this.$session.get('bookCoverId') + '/backCover'

				//  set Images book wise dynamic
				this.frontCoverImage = 'magazine/images/book_cover' + this.$session.get('bookCoverId') + '.jpg'
				this.insideFrontCoverImage = 'magazine/images/ifc' + this.$session.get('bookCoverId') + '.jpg'
				this.insideBackCoverImage = 'magazine/images/ibc' + this.$session.get('bookCoverId') + '.jpg'
				this.backCoverImage = 'magazine/images/bc' + this.$session.get('bookCoverId') + '.jpg'

			 }
            
		}
    }
</script>
