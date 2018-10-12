<template>
    <div class="inner_home_bg">
		<div class="container">
			<div class="inner_home">
				<!-- sidebar Component -->
				<keep-alive>
					<component :is="navbarComponent"></component>
				</keep-alive>
				<!-- sideBarComponent End -->
                <!-- Dynamic -->
                    <router-view  class="view"></router-view>
                <!-- end Dynamic -->
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
	import navbarComponent from '../navbarComponent.vue';
	import { mapState, mapMutations, mapActions } from 'vuex';
    export default {
		components: {
			navbarComponent,
		},
        computed: {
            ...mapState([
                'insideFrontCover',
            ]),
        },
        data () {
            return {
               navbarComponent: navbarComponent,
                // dynamicComponent: this.$session.has('currentComponent') ? this.$session.has('currentComponent') : frontCoverCompnent
            }
        },
        mounted () {
           
        }
    }
</script>
