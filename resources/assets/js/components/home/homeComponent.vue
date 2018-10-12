<template>
    <div class="home_bg">
		<div class="container">
			<div class="inner_home">
				<!-- navbar Component -->
				<keep-alive>
					<component :is="navbarComponent" ></component>
				</keep-alive>
				<!-- navbarComponent End -->
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 home_content">
					<h1>Welcome {{ this.$session.get('userName') }} – {{ this.$session.get('userCompanyName') ? this.$session.get('userCompanyName') : 'SDN' }}</h1>
					<!--<h2><span>Issue:</span>  XXXX 2018   &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;   <span>Deadline:</span> XXXXXX, 2018 {{userDetails.length}}</h2>-->
					<p>Please select from the below product to review, update and <br/>
					approve your agency's information before the noted deadline.</p>
					<a><!--Download 2018 Editorial and Production Calendar--></a>
					<p class="select_cover">Select an Option to Customize</p>
				</div>
				<div>
				</div>
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 home_content_image">
					<div class="col-sm-4 col-xs-6 col-md-4">
						<router-link to="/cover1/frontCover" class="image_hover"><img src="magazine/images/TTM.jpg" @click="setCover(1)" alt="" title=""></router-link><router-link to="/cover1/frontCover"><p>The Travel Magazine</p><p>Deadline: 9/26/18</p></router-link>
						<!-- <a href="step1.html" class="image_hover"><img src="magazine/images/cover1.jpg" alt="" title=""></a><a href="#"><p>The Travel Magazine</p></a> -->
					</div>
					<div class="col-sm-4 col-xs-6 col-md-4">
						<router-link to="/cover2/frontCover" class="image_hover"><img src="magazine/images/UltimateExperience.jpg" @click="setCover(2)" alt="" title=""></router-link><router-link to="/cover2/frontCover"><p>Ultimate Experiences</p><p>Deadline: 9/26/18</p></router-link>
						<!-- <a href="step1.html" class="image_hover"><img src="magazine/images/cover3.jpg" alt="" title=""></a><a href="#"><p>Ultimate Experiences</p></a> -->
					</div>
					<div class="col-sm-4 col-xs-6 col-md-4">
						<router-link to="/cover3/frontCover" class="image_hover"><img src="magazine/images/TravelBenefits.jpg"  @click="setCover(3)" alt="" title=""></router-link><router-link to="/cover3/frontCover"><p>Travel Benefits Brochure</p><p>Deadline: 9/26/18</p></router-link>
						<!-- <a href="step1.html" class="image_hover"><img src="magazine/images/cover2.jpg" alt="" title=""></a><a href="#"><p>Ultimate Experiences</p></a> -->
					</div>
					<div class="col-sm-4 col-xs-6 col-md-4">
						<router-link to="/cover4/frontCover" class="image_hover"><img src="magazine/images/book_cover4.jpg" @click="setCover(4)" alt="" title=""></router-link><router-link to="/cover4/frontCover"><p>Hotel & Resorts Brochure</p><p>Come back to<br/> review 10/3 - 10/8</p></router-link>
						<!-- <a href="step1.html" class="image_hover"><img src="magazine/images/cover3.jpg" alt="" title=""></a><a href="#"><p>Ultimate Experiences</p></a> -->
					</div>
					<div class="col-sm-4 col-xs-6 col-md-4" >
						<router-link to="/cover5/frontCover" class="image_hover"><img src="magazine/images/HotelandResortsGuide.jpg" @click="setCover(5)" alt="" title=""></router-link><router-link to="/home"><p>Hotel & Resorts Directory</p><p>Come back to <br/> review 10/3 - 10/8</p></router-link>
						<!-- <a href="step1.html" class="image_hover"><img src="magazine/images/cover3.jpg" alt="" title=""></a><a href="#"><p>Ultimate Experiences</p></a> -->
					</div>
					<div class="col-sm-4 col-xs-6 col-md-4" style="filter: grayscale(80%);">
						<router-link to="/home" class="image_hover last_image"><img src="magazine/images/LuxuryBenefits.jpg" @click="setCover(6)" alt="" title=""></router-link><router-link to="/home"><p>Luxury Benefits Brochure</p></router-link>
						<!-- <a href="step1.html" class="image_hover"><img src="magazine/images/cover3.jpg" alt="" title=""></a><a href="#"><p>Ultimate Experiences</p></a> -->
						<router-link to="/home" class="image_hover last_image"><img src="magazine/images/Calendar.jpg" @click="setCover(7)" alt="" title=""></router-link><router-link to="/home"><p>Wall Calendar</p><p>Come back to <br/>review 10/3 - 10/8</p></router-link>
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
import navbarComponent from '../navbarComponent.vue';
import { mapState, mapMutations, mapActions } from 'vuex';

export default {
	components: {
			navbarComponent,
		},
	 computed: {
		 ...mapState([
				'userDetails',
				'errorMessage',
			]),
	 	},
    data() {
        return {
			navbarComponent: navbarComponent,	
        }
    },
    mounted () {
				console.log(this.userDetails)
				this.emptyMessages()
		},
		methods: {
			...mapMutations ([
				'EMPTY_MESSAGE_LIST',
			]),
			emptyMessages () {
				this.EMPTY_MESSAGE_LIST()
			},
			setCover (pageId) {
				// set page id in session
				this.$session.set('bookCoverId', pageId);
				// alert(this.$session.get('pageId'))
			}
		}
}
</script>

