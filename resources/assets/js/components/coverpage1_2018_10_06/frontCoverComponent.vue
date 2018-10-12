<template>
    <div class="col-sm-8 col-md-8 col-xs-12 right_side">
        <div class="padding_left_right">
            <h2>Begin customizing each cover of your magazine by going through steps 1-4.</h2>
            <form>
                <!--<div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Check this box if you'd like the system to customize each issue for you automatically by pulling your STN profile information.</label>
                    </div>
                </div>-->
                <div class="form-group">
                    <p class="heading_title">Step 1. Front Cover</p>
                    <p class="magin_bottom_70">Customize the front cover with your company logo or name that will appear above the masthead. Note: Cover image is not final.</p>
                </div>
                <div class="form-group">
                    <input v-validate="'max:35'" type="text" maxlength="35" data-vv-name="title" v-model="title" :class="{'form-control': true, 'alert-danger': errors.has('title'), 'step_input': true }" placeholder="For example : ABC Trvel - John Smith">
                    <span v-show="errors.has('title')" class="color-red">{{ errors.first('title') }}</span>
                </div>
                <div class="form-group">
                    <input type="text" data-vv-name="subTitle" maxlength="25" v-model="subTitle" v-validate="'max:25'" :class="{'form-control': true, 'alert-danger': errors.has('subTitle'), 'step_input': true }" placeholder="Member / Affiliate Name">
                    <span v-show="errors.has('subTitle')" class="color-red">{{ errors.first('subTitle') }}</span>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-9 col-md-9 col-sm-9 pull-left ">
                            <div class="full_img magin_bottom_70 step1_bg_img">
                                <div class="above_step1_text">
                                    <h4><img v-if="includeLogo" :src="coverLogo" alt="" title="">{{ !includeLogo ? title : '' }}<br/><span>{{ !includeLogo ? subTitle : '' }}</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 col-md-3 col-sm-3 approve_btn pull-right">
                            <div class="checkbox">
                                <label ><input type="checkbox" :checked="includeLogo" @click="includeLogo = !includeLogo" value="">Check here to include logo on cover. Note: Only upload PNG and JPEG transparent files.</label>
                                <!-- <input v-if="includeLogo" v-on:change="logoOnCover" type="file" name="file"><br/> -->
                                <button type="button" v-if="includeLogo" class="green_btn submit_btn" data-toggle="modal" data-target="#myModal" style="margin-right:0px;"><span>Choose Logo</span></button>
                                <br/>
                            </div>
                            <button type="button" class="green_btn submit_btn" style="margin-right: 0px;" @click="saveBook(1)"><span>Save</span></button>                            
                            <button type="button" class="green_btn submit_btn " style="margin-right: 0px;" @click="saveBook(2)"><span>Approve & Go</span></button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p class="magin_bottom_70">Customize the front cover with your company logo or name that will appear above the masthead. Note: Cover image is not final.</p>
                </div>
                <div class="form-group">
                    
                    <!-- <router-link to="insideFrontCover" class="green_btn submit_btn" style="margin-right: 0px;"><span @click="saveBook">Approve Step 1. Go to Step 2</span    ></router-link> -->
                </div>
                    <!-- <p class="magin_bottom_70">Once they click on preview, the magazine shows up...can we have it show here? OR do we have to send to another screen? Either is fine</p> -->
                </form>
        </div>
    
    <!-- model for choose logo -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <logoPopupComponent></logoPopupComponent>
            </div>
        </div>

    </div>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex';
import logoPopupComponent from '../common/logoPopupComponent.vue';
    export default {
        components: {
            logoPopupComponent,
        },
        computed: {
            ...mapState([
                'coverTitle1',
                'successMessage',
            ]),
        },
        data () {
            return {
                title: 'YOUR TRAVEL EXPERT',
                bookId: this.$session.get('bookCoverId') ? this.$session.get('bookCoverId') : 1,      
                subTitle: '',
                includeLogo: false,
                coverLogo: '',
                coverLogoId: '',
            }
        },
        mounted () {
            this.setActiveClass()
            axios.get(this.$url + 'api/usersBook/' + this.$session.get('bookCoverId'), {
                headers: {
                    Authorization: this.$session.get('accessToken')
                }
            })
            .then(response => {
                console.log(response.data)
                if (response.data.data) {
                    this.coverTile1 = response.data.data.front_cover.title
                    this.title = this.coverTile1
                    this.subTitle = response.data.data.front_cover.subTitle
                    this.coverLogo = response.data.data.front_cover.coverLogo
                    this.coverLogoId = response.data.data.front_cover.coverLogoId
                    this.includeLogo = response.data.data.front_cover.includeLogo
                }
            })
        },
        methods: {
            ...mapMutations([
				'SET_ACTIVE_CLASS',
                'PUSH_IN_INSIDE_FRONT_COVER',
                'EMPTY_MESSAGE_LIST',
                'PUSH_MESSAGE',
                'PUSH_ERROR_MESSAGE',
            ]),
            setActiveClass() {
				// call to the store ation method
				this.SET_ACTIVE_CLASS(1)				
            },
            saveBook (type) {
                // empty error and success message
                this.EMPTY_MESSAGE_LIST()
                this.$validator.validateAll().then(result => {
					if(result) {
                        this.$validator.validateAll().then(result => {
                            if(result) {
                                axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
                                axios.post(this.$url + 'api/usersBook', {
                                    user_id: this.$session.get('userId'),
                                    book_id: this.bookId,
                                    title: this.title,
                                    columnName: 'front_cover',
                                    subTitle: this.subTitle,
                                    coverLogo: this.coverLogo,
                                    coverLogoId: this.coverLogoId,
                                    includeLogo: this.includeLogo,
                                })
                                .then(response => {
                                    // this.$store.state.frontCover.title.push(this.title)
                                    // console.log(response.data, 'index')
                                    
                                    this.coverTile1 = this.title
                                    if (type === 2) {
                                        this.PUSH_MESSAGE('Front Cover Saved and Aproved!')
                                        this.$router.push('/cover1/insideFrontCover')    
                                    } else {
                                        this.PUSH_MESSAGE('Front Cover Saved!')
                                    }
                                    
                                    
                                    // console.log(this.$store.state.frontCover.title, 'pandya')
                                })
                                .catch (error => {
                                    this.PUSH_ERROR_MESSAGE('Internal server error')
                                })
                            }
                        })
                    } else {
                        this.PUSH_ERROR_MESSAGE('Something went wrong!')
                    }
                })
            },
            changeActive (param) {
                // alert(param)
            },
            logoOnCover(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.image = e.target.result;
                    this.uploadImage(this.image);
                };
                reader.readAsDataURL(file);
            },
            uploadImage(imageData){
                // upload image to database and folder
                axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
                axios.post('api/myLibrary',{
                    image: imageData,
                    imageType: 'coverLogo',
                })
                .then(response => {
                    console.log(response.data.data)
                    // set logo to image
                    this.coverLogo = response.data.data.image
                })
                .catch(errorResponse => {
                    this.$store.state.successMessage.push({message: errorResponse.response.data.message})
                })
            },
            changeLogo (imageURL, imageId) {
                // for logo
                this.coverLogo = imageURL
                this.coverLogoId = imageId
            },
        }
    }
</script>
