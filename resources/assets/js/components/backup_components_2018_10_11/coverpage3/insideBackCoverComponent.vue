<template>
    <div class="col-sm-8 col-md-8 col-xs-12 right_side">
        <div class="padding_left_right">
            <form>
                <div class="form-group">
                    <p class="heading_title" style="margin-top: 0px;">Step 3. Inside Back Cover</p>
                    <p class="magin_bottom_70">Select an inside back cover ad.</p>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="inner_step3">
                            <div class="col-xs-12 col-md-5 col-sm-6">
                                <div class="preview_img_div"><img src="magazine/images/ibc3.jpg" alt="" title=""></div>
                                <div class="form-group col-sm-12">
                                    <!-- <label class="radio-inline"><input type="radio" name="image" @click="changeImage(1)" :checked="step3Image === 'magazine/images/insidefront1.jpg'? true : false"  value="">Option 1</label> -->
                                    <label class="radio-inline"><input type="radio" name="image" @click="changeImage(1)" :checked="checkOption1"  value="">Option 1</label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-5 col-sm-6">
                                <div class="preview_img_div">
                                    <img :src="showHidePdfPageImage ? showHidePdfPageImage : 'magazine/images/TravelBenefits.pdf'" alt="" srcset="" width="100%" height="200">
                                    <!-- <embed :src="showHidePdfPageImage ? showHidePdfPageImage : 'magazine/images/TravelBenefits.pdf'" type="application/pdf"  width="100%" height="200"> -->
                                </div>
                                <div class="form-group col-sm-12">
                                    <label class="radio-inline">
                                        <!-- <input type="radio" name="image" @click="changeImage(2)" :checked="step3Image === option2Image ? true : false" value="">Option 2 -->
                                        <!-- <input type="radio" name="image" @click="changeImage(2)" :checked="step3Image === option2Image ? true : false" value="">Upload PDF Artwork -->
                                        <input type="radio" name="image" @click="changeImage(2)" :checked="checkOption2" value="">Upload Artwork
                                    </label>
                                    <!-- <button v-if="isShowButton" type="button" class="green_btn submit_btn" data-toggle="modal" data-target="#myModal">Choose Image</button> -->
                                     <div class="row">
                                        <div class="checkbox" v-if="option2" style="margin-bottom:0px;">
                                            <!-- <label><input type="checkbox" :checked="showHidePdf" value="" @click="showHidePdf = !showHidePdf"><b>Upload PDF Artwork</b> </label>  -->
                                            <label style="padding:0px; padding-bottom:10px;">Check here if you are uploading your own artwork. <br> Note: High resolution Image only.</label>
                                            <div >
                                                <input type="file" name="file" id="" ref="fileInput" v-on:change="onImageChange" v-validate="'ext:jpg,png,jpeg'">
                                                <span v-show="errors.has('file')" class="color-red">{{ errors.first('file') }}</span>
                                                <!-- <button type="button" class="green_btn submit_btn" @click="uploadPdf" style="float:none; margin-top:10px;">Upload</button> -->
                                            </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-9 col-md-9 col-sm-9 pull-left " v-if="!option2">
                            <div class="preview_img_div inside_bc">
                                <div>
                                    <img :src="step3Image ? step3Image : '/magazine/images/inner_bc3.jpg'" alt="" title="">
                                </div>
                                <!--<div class="inner_fc_bottom">
                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                        <div class="col-sm-4 col-xs-4 col-md-4 ">
                                            <div class="inner_fc_bottom_img">
                                                <img :src="logoImage ? logoImage : 'magazine/images/cover_logo.png'" alt="" title="" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 col-md-4 ">
                                            <h3>{{contactName1 ? contactName1 : isSaved ? '' : 'Contact 1'}}</h3>
                                            <h3>{{ contactTitle1 ? contactTitle1 : isSaved ? '' : 'Title' }}</h3><br class="responsive_br">
                                            <h3>{{contactName2 ? contactName2 : isSaved ? '' : 'Contact 2'}}</h3>
                                            <h3>{{ contactTitle2 ? contactTitle2 : isSaved ? '' : 'Title' }}</h3><br class="responsive_br">
                                            <h3>{{contactName3 ? contactName3 : isSaved ? '' : 'Contact 3'}}</h3>
                                            <h3>{{ contactTitle3 ? contactTitle3 : isSaved ? '' : 'Title' }}</h3>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 col-md-4 ">
                                            <h3>{{address ? address + ',' : isSaved ? '' :'address' }}</h3>
                                            <h3>{{address2 ? address2 + ',' : isSaved ? '' :'address2' }}</h3>
                                            <h3>{{ city ? city + ',' : '' }} {{state ? state + ',' : isSaved ? '' :'state' }} {{zipCode ? zipCode : isSaved ? '' : 'xxxx'}}</h3><br class="responsive_br">
                                            <h3>{{directNumber ? directNumber : isSaved ? '' :'XXXXXXXXXXX or' }}  {{directNumber && officeNumber ? 'or' : ''}} {{officeNumber ? officeNumber : isSaved ? '' : 'xxxxxxxxxxx' }}</h3>
                                            <h3>{{website ? website : isSaved ? '' : 'www.example.org' }}</h3>
                                            <h3>{{email ? email + ',' : isSaved ? '' : 'example@example.com' }}</h3>
                                            <h3>{{ memberCSTNumber ? 'ST# ' +  memberCSTNumber : '' }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                        <div class="col-sm-7 col-xs-7 col-md-7 col-sm-offset-3 text-center">
                                            <h3> <br class="responsive_br">{{ memberCSTNumber ? 'ST# ' +  memberCSTNumber : '' }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-sm-12 tag_linebelow">
                                        <h3><br>{{companyTagLine ? companyTagLine : 'Tagline for this page can go here if they would like'}}</h3>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <div class="col-xs-9 col-md-9 col-sm-9 pull-left " v-if="option2">
                            <img :src="showHidePdfPageImage" alt="" srcset="" width="100%">
                            <!-- <embed :src="showHidePdfPageImage" type="application/pdf"  width="100%" height="700"> -->
                        </div>
                        <div class="col-xs-3 col-md-3 col-sm-3 approve_btn pull-right">
                            <button type="button" name="" @click="saveInsideBackCover(1)" value="Preview" class="green_btn submit_btn" style="margin-right: 0px;" ><span>Save</span></button>
                            <button type="button" class="green_btn submit_btn" style="margin-right: 0px;" @click="saveInsideBackCover(2)"><span>Approve & Go</span></button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- <router-link  to="backCover" class="green_btn submit_btn magin_bottom_70" style="margin-right: 0px;">Approve Step 3. Go to Step 4</router-link> -->
                </div>
                <!-- <div class="form-group">
                    <router-link  to="backCover" class="green_btn submit_btn " style="margin-right: 0px;">Approve and Next</router-link>
                </div> -->
            </form>
        </div>

        <!-- model for choose logo -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <othersPopupComponent :libraryImages="libraryImages" ></othersPopupComponent>
            </div>
        </div>
    </div>
</template>


<script>
import othersPopupComponent from '../common/othersPopupComponent.vue';
import { mapState, mapMutations, mapActions } from 'vuex';
    export default {
        components: {
            othersPopupComponent,
        },
        computed: {
            ...mapState([
                'insideFrontCover',
            ]),
        },
        data () {
            return {
                title: 'Travel the world',
                title: 'Travel the world',
                bookId: this.$session.get('bookCoverId') ? this.$session.get('bookCoverId') : 1,
                withPhoto: '',
                agency1: '',
                agency2: '',
                tagLine2: '',
                tagLine3: '',
                address: '',
                address2: '',
                city: '',
                cityData: [],
                loadedCityData: [],
                stateData: '',
                state: '',
                zipCode: '',
                phone: '',
                tollFreeNumber: '',
                email: '',
                website: '',
                memberCSTNumber: '',
                choseFile: '',
                libraryImages: [],
                logoImage: '',
                logoImageId: '',
                officeNumber: '',
                contactName1: '',
                contactName2: '',
                contactName3: '',
                contactTitle1: '',
                contactTitle2: '',
                contactTitle3: '',
                directNumber: '',
                nameOrCompanyName: '',
                step3Image : 'magazine/images/ibc_book3.jpg',
                option2Image : 'magazine/images/inner_bc3.jpg',
                isSaved: false,
                isShowButton: false,
                image: '',
                showHidePdf: false,
                showHidePdfPage: 'image',
                showHidePdfPageImage: '',
                isPdfShow: false,
                option2: false,
                checkOption2: false,
                checkOption1: true,
                companyTagLine: '',

            }
        },
        mounted () {
            this.setActiveClass()
            this.fetchBooks();
            // this.fetchLogoImages();
        },
        methods: {
            ...mapMutations([
                'SET_ACTIVE_CLASS',
                'PUSH_IN_INSIDE_FRONT_COVER',
                'EMPTY_MESSAGE_LIST',
                'PUSH_MESSAGE',
			]),
            changeImage (image) {
                if (image === 1) {
                    this.step3Image = 'magazine/images/ibc_book3.jpg';
                    this.isShowButton = false
                    this.isPdfShow = false
                    this.showHidePdf = false
                    this.option2 = false
                    this.checkOption2 = false
                    this.checkOption1 = true
                }
                if (image === 2) {
                    this.step3Image = this.option2Image;
                    this.showHidePdfPageImage = this.showHidePdfPageImage ? this.showHidePdfPageImage : 'magazine/images/TravelBenefits.pdf'
                    this.isShowButton = true
                    this.isPdfShow = true
                    this.option2 = true
                    this.checkOption2 = true
                    this.checkOption1 = false
                }
            },
              onImageChange(e) {
                 this.$validator.validateAll().then(result => {
                    if (result) {
                        let files = e.target.files || e.dataTransfer.files;
                        if (!files.length)
                            return;
                        this.createImage(files[0]);
                    }
                })
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
                // upload image to database and folder
                axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
                axios.post('api/myLibrary',{
                    image: imageData,
                    imageType: 'others',
                })
                .then(response => {                
                    this.showHidePdfPageImage = response.data.data.image
                    this.$store.state.successMessage.push({message: 'Artwork Uploaded!'})
                    document.getElementById('fileName').value = "";
                })
                .catch(errorResponse => {
                    this.$store.state.successMessage.push({message: errorResponse.response.data.message})
                })
            },
            option2ImageChange (image, imageId) {
                this.step3Image = image
                this.option2Image = image
            },
			setActiveClass() {
				// call to the store ation method
				this.SET_ACTIVE_CLASS(3)				
			},
            changeActive (param) {
                
            },
            setDataToinsideFrontEnd (resp) {
                this.PUSH_IN_INSIDE_FRONT_COVER(resp)
                this.condition = true
            },
            fetchBooks () {
                axios.get(this.$url + 'api/usersBook/' + this.$session.get('bookCoverId'), {
                    headers: {
                        Authorization: this.$session.get('accessToken')
                    }
                })
                .then(response => {
                    // set Response data to form data
                    // console.log(response.data.data, 'sadasdasd')
                    if (response.data.data) {
                        this.setFormData(response.data.data.inside_back_cover, response.data.data.inside_front_cover);
                        this.isSaved = true
                    }
                    // this.insideFrontCover.push(response.data.data.inside_front_cover)
                    
                })
            },
            saveInsideBackCover (types) {
                this.EMPTY_MESSAGE_LIST()
                axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
                var data = {
                    withPhoto: this.withPhoto,
                    agency1: this.agency1,
                    agency2: this.agency2,
                    tagLine2: this.tagLine2,
                    tagLine3: this.tagLine3,
                    address: this.address,
                    address2: this.address2,
                    city: this.city,
                    state: this.state,
                    zipCode: this.zipCode,
                    phone: this.phone,
                    tollFreeNumber: this.tollFreeNumber,
                    email: this. email,
                    website: this.website,
                    memberCSTNumber: this.memberCSTNumber,
                    user_id: this.$session.get('userId'),
                    book_id: this.$session.get('bookCoverId'),
                    columnName: 'inside_back_cover',
                    logoImage: this.logoImage,
                    logoImageId: this.logoImageId,
                    step3Image: this.step3Image,
                    option2: this.option2,
                    showHidePdfPageImage: this.showHidePdfPageImage,
                    checkOption2: this.checkOption2, 
                    checkOption1: this.checkOption1,
                }
                axios.post(this.$url + 'api/usersBook', data)
                .then(response => {
                    if (types === 2) {
                        this.PUSH_MESSAGE('Inside Back Cover Saved and Aproved!')
                        this.$router.push('/cover3/backCover');
                    } else {
                        this.PUSH_MESSAGE('Inside Back Cover Saved!')
                    }
                })
                .catch(errorResponse => {
                    // console.log(errorResponse.response)
                    this.PUSH_MESSAGE('Invernal server error!')
                })
                // redirect to the next page
                
            },
            fetchLogoImages () {
                axios.get(this.$url + 'api/myLibrary', {
                    headers: {
                        Authorization: this.$session.get('accessToken')
                    }
                })
                .then (response => {
                    this.libraryImages = response.data.data;
                    // console.log(response.data.data, 'images')
                })
                .catch (errorResponse => {
                    console.log(errorResponse, 'error')
                })
            },
            // set Form Data from database
            setFormData (responseData, responseData2) {
                // this.PUSH_IN_INSIDE_FRONT_COVER(responseData)                
                // this.$store.state.insideFrontCover.push(responseData)
                // console.log(responseData, 'respo')
                this.withPhoto = responseData.withPhoto;
                this.agency1 = !responseData ? responseData2.agency1 : responseData.agency1;
                this.agency2 = !responseData ? responseData2.agency2 : responseData.agency2;
                // this.tagLine2 = !responseData ? this.$session.get('magazineProfile').tagLine2 : responseData.tagLine2;
                // this.tagLine3 = !responseData ? this.$session.get('magazineProfile').tagLine3 : responseData.tagLine3;
                this.address = !responseData ? responseData2.address : responseData.address;
                // this.address2 = !responseData ? this.$session.get('magazineProfile').address2 : responseData.address2;
                this.city = !responseData ? responseData2.city : responseData.city;
                this.state = !responseData ? responseData2.state : responseData.state;
                this.zipCode = !responseData ? responseData2.zipCode : responseData.zipCode;
                this.phone = !responseData ? responseData2.phoneNumber : responseData.phone;
                this.tollFreeNumber = !responseData ? responseData2.tollFreeNumber : responseData.tollFreeNumber;
                this.email = !responseData ? responseData2.email : responseData. email;
                this.website = !responseData ? responseData2.website : responseData.website;
                this.memberCSTNumber = !responseData ? responseData2.memberCSTNumber : responseData.memberCSTNumber;
                this.logoImage = responseData2.logoImage;
                this.logoImageId = responseData2.logoImageId;
                this.step3Image = responseData.step3Image ? responseData.step3Image : 'magazine/images/ibc_book3.jpg'
                this.option2Image = responseData.step3Image ? responseData.step3Image : 'magazine/images/ibc_book3.jpg'
                if (this.option2Image !== 'magazine/images/inner_bc3.jpg' && this.option2Image !== 'magazine/images/ibc_book3.jpg') {
                    this.isShowButton = true
                }
                this.officeNumber = responseData2.officeNumber
                this.contactName1 = responseData2.contactName1
                this.contactName2 = responseData2.contactName2
                this.contactName3 = responseData2.contactName3
                this.contactTitle1 = responseData2.contactTitle1
                this.contactTitle2 = responseData2.contactTitle2
                this.contactTitle3 = responseData2.contactTitle3
                this.directNumber = responseData2.directNumber
                this.nameOrCompanyName = responseData2.nameOrCompanyName
                this.option2 = responseData.option2
                if (!this.option2) {
                    this.changeImage(1)
                }
                this.showHidePdf = this.option2 ? true : false
                this.showHidePdfPageImage = responseData.showHidePdfPageImage
                this.checkOption2 = responseData.checkOption2
                this.checkOption1 = responseData ? responseData.checkOption1 : true
                if(!this.checkOption1) {
                    this.checkOption1 = true
                }
                this.companyTagLine = responseData2.companyTagLine
                // console.log(responseData, 'kandarp pandya')
            }
        }
    }
</script>
