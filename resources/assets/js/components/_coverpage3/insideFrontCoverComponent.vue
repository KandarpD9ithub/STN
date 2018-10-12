<template>
    <div class="col-sm-8 col-md-8 col-xs-12 right_side"> 
        <div class="padding_left_right">
            <form >
                <div class="form-group">
                    <p class="heading_title" style="margin-top: 0px;">Step 2. Inside Front Cover</p>
                    <p class="magin_bottom_70">Select page template from dropdown menu to begin customization.</p>
                </div>
                <div class="form-group">
                    <select class="form-control" name="withPhoto" v-model="withPhoto">
                        <option value="with_no_photo">Letter with No Photo</option>
                        <option value="with_photo">Letter with Photo</option>
                        <option value="with_pdf">Upload PDF</option>
                        <!-- <option value="with_horizontal_photo">Letter With Horizontal photo</option>
                        <option value="with_vertical_photo">Letter With Vertical photo</option> -->
                    </select>
                </div>
                <!-- if selected value is pdf -->
                <div v-if="withPhoto !== 'with_pdf'">
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" id="" v-model="nameOrCompanyName" class="form-control" placeholder="Agency Name" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" v-model="contactName1" class="form-control" id="" placeholder="Contact Name">
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" v-model="contactTitle1" class="form-control" id="" placeholder="Contact Title" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" id="" v-model="address" class="form-control" placeholder="Address" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" v-model="contactName2" class="form-control" id="" placeholder="Contact Name">
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" v-model="contactTitle2" class="form-control" id="" placeholder="Contact Title" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" id="" v-model="address2" class="form-control" placeholder="Address" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" v-model="contactName3" class="form-control" id="" placeholder="Contact Name">
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" v-model="contactTitle3" class="form-control" id="" placeholder="Contact Title" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="city" class="form-control" id="" placeholder="City" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-xs-12 col-md-4 col-sm-4 full_width">
                                        <select class="form-control" v-model="state">
                                            <option value="">Select State</option>
                                            <option :value="state.short_code" v-for="(state, index) in this.$session.get('states')" :key="index">{{state.short_code}}</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-md-8 col-sm-8">
                                        <input type="text" name="" v-model="zipCode" class="form-control" id="" placeholder="Zipcode" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="directNumber" id="" class="form-control" placeholder="Direct Number" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="officeNumber" id="" class="form-control" placeholder="Office Number" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" v-model="email" name="" id="" class="form-control" placeholder="Email" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" v-model="website" name="" id="" class="form-control" placeholder="URL" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" v-model="companyTagLine" name="" id="" class="form-control" placeholder="Company Tagline " >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" v-model="memberCSTNumber" name="" id="" class="form-control" placeholder="ST #" >
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <p class="heading_title" style="margin-top: 0px;">Singnature Details</p>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="signatureHolderName" id="" class="form-control" placeholder="Full Name" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="signatureHolderTitle" id="" class="form-control" placeholder="Title" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-12 col-sm-12 editor_design">
                                <vue-editor v-model="personDetail"></vue-editor>
                                <!-- <textarea name="personDetail" id="" cols="30" rows="10" v-model="personDetail" class="form-control"></textarea> -->
                            </div>
                        </div>
                    </div>
                </div>
               <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-12 col-sm-12">
                                <button v-if="withPhoto === 'with_photo'" type="button" class="green_btn submit_btn" data-toggle="modal" data-target="#myModalForPhoto" style="margin-right:0px; margin-left:5px;"><span>Choose Photo</span></button>
                                <button type="button" class="green_btn submit_btn" data-toggle="modal" data-target="#chooseSignature"  style="margin-right:0px;"><span>Choose Signature</span></button>
                                <button type="button" class="green_btn submit_btn" data-toggle="modal" data-target="#myModal" style="margin-right:0px;"><span>Choose Logo</span></button>
                            </div>
                            <!-- <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="submit" name=""  value="Preview" class="green_btn submit_btn" style="margin-right: 0px;">
                            </div> -->
                        </div>
                    </div>
                </div>
                </div>
                <!-- end div -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="checkbox" v-if="withPhoto === 'with_pdf'">
                                <label style="margin-bottom:0px; padding-left:0px;"><!--<input type="checkbox" :checked="showHidePdf" value="" @click="showHidePdf = !showHidePdf">--><b>Upload PDF Artwork</b> </label> 
                                <label style="padding:0px;width:100%;">Check here if you are uploading your own artwork. Note: High resolution PDF only.</label>
                                <input v-on:change="onImageChange" ref="fileInput" type="file"  v-validate="'ext:pdf'" name="pdf" id="" style="margin-bottom:20px;">
                                <span v-show="errors.has('pdf')" class="color-red">{{ errors.first('pdf') }}</span>
                            </div>
                        </div>
                        <div class="form-group">

                        <div class="col-xs-9 col-md-9 col-sm-9 pull-left ">
                            <div class="preview_img_div book_cover3 book3_innerfc" v-if="withPhoto !== 'with_pdf'">
                                <div class="inner_fccover2">
                                    <div class="col-sm-9 col-xs-9 col-md-9 book3_ifc_left">
                                        <div class="row">
                                            <div>
                                                <img src="magazine/images/ifc_book3_hz.jpg" alt="" title="">
                                            </div>
                                            <div class="inner_front_cover">
                                                <div class="inner_fcover">
                                                    <div>
                                                        <p v-html="personDetail"></p>
                                                        <div>
                                                            <div class="book2_signature">
                                                                <img :src="signatureImage" alt="" title="">
                                                                <button v-if="signatureImage" type="button" @click="signatureImage = ''" class="close alert-danger">&times;</button>
                                                                <p class="other_sign">{{signatureHolderName}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inner_fc_bottom">
                                                    <div class="row">
                                                        <div class="col-sm-4 col-xs-4 col-md-4 ">
                                                            <div class="inner_fc_bottom_img">
                                                                <img :src="logoImage ? logoImage : 'magazine/images/cover_logo.png'"  alt="" title="" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 col-md-4 ">
                                                            <h3>{{address ? address + ',' : isSaved ? '' :'address' }}</h3>
                                                            <h3>{{ city ? city + ',' : '' }} {{state ? state + ',' : isSaved ? '' :'state' }} {{zipCode ? zipCode : isSaved ? '' : 'xxxx'}}</h3><br class="responsive_br">
                                                            <h3>{{address2 ? address2 + ',' : isSaved ? '' :'address2' }}</h3>
                                                            <h3>{{ city ? city + ',' : '' }} {{state ? state + ',' : isSaved ? '' :'state' }} {{zipCode ? zipCode : isSaved ? '' : 'xxxx'}}</h3><br class="responsive_br">
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 col-md-4 ">
                                                            <h3>{{directNumber ? directNumber : isSaved ? '' :'xxxxxxxxxxx or' }} {{directNumber && officeNumber ? 'or' : ''}} </h3>
                                                            <h3>{{officeNumber ? officeNumber : isSaved ? '' : 'xxxxxxxxxxx' }}</h3><br class="responsive_br">
                                                            <h3>{{website ? website : isSaved ? '' : 'www.example.org' }}</h3>
                                                            <h3>{{email ? email + ',' : isSaved ? '' : 'example@example.com' }}</h3>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-xs-3 col-md-3 book3_ifc_right">
                                        <img src="magazine/images/ifc_book3.jpg" alt="" title="" >
                                    </div>
                                </div>
                            </div>
                            <div v-if="withPhoto === 'with_pdf'">
                                <embed :src="showHidePdfPageImage" type="application/pdf"  width="100%" height="700">
                            </div>
                        </div>
                        <div class="col-xs-3 col-md-3 col-sm-3 approve_btn pull-right">
                            <button type="button" name="" @click="saveInsideFrontCover(1)" value="Preview" class="green_btn submit_btn" style="margin-right: 0px;" ><span>Save</span></button>
                            <button type="button" class="green_btn submit_btn"  @click="saveInsideFrontCover(2)" style="margin-right: 0px;" ><span>Approve & Go </span></button>
                        </div>
                    </div>
                </div>
            </div> 
                <div class="form-group">
                    <!-- this.$router.push('/cover1/insideBackCover') -->
                    <!-- <button type="button" class="green_btn submit_btn" style="margin-right: 0px;" @click="saveInsideFrontCover(2)"><span>Approve Step 2. Go to Step 3</span></button>-->
                    <!-- <router-link to="insideBackCover" class="green_btn submit_btn" style="margin-right: 0px;"><span  @click="saveInsideFrontCover">Approve Step 2. Go to Step 3</span></router-link> -->
                </div>
                    <!-- <p class="magin_bottom_70">Once they click on preview, the magazine shows up...can we have it show here? OR do we have to send to another screen? Either is fine.</p> -->
            </form>
        </div>


    <!-- model for choose photo  -->
    <div class="modal fade" id="myModalForPhoto" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <othersPopupComponent></othersPopupComponent>
            </div>
        </div>


    <!-- model for choose logo -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <logoPopupComponent></logoPopupComponent>
            </div>
        </div>


    <!-- model for choose Signature  -->
    <div class="modal fade" id="chooseSignature" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <signaturePopupComponent></signaturePopupComponent>
        </div>
    </div>
            
            
    </div>
</template>

<script>
import { VueEditor, Quill } from "vue2-editor";
import signaturePopupComponent from '../common/signaturePopupComponent.vue';
import othersPopupComponent from '../common/othersPopupComponent.vue';
import logoPopupComponent from '../common/logoPopupComponent.vue';
import { mapState, mapMutations, mapActions } from 'vuex';
    export default {
        components: {
            othersPopupComponent,
            logoPopupComponent,
            signaturePopupComponent,
            VueEditor,
        },
        computed: {
            ...mapState([
                'insideFrontCover',
            ]),
        },
        data () {
            return {
                title: 'Travel the world',
                bookId: this.$session.get('bookCoverId') ? this.$session.get('bookCoverId') : 1,
                withPhoto: 'with_no_photo',
                nameOrCompanyName: '',
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
                withPhotoImage: '',
                withPhotoImageId: '',
                officeNumber: '',
                contactName1: '',
                contactName2: '',
                contactName3: '',
                contactTitle1: '',
                contactTitle2: '',
                contactTitle3: '',
                directNumber: '',
                isSaved: false,
                signatureHolderTitle: '',
                signatureHolderName: '',
                signatureImage: '',
                signatureImageId: '',
                showHidePdf: false,
                showHidePdfPage: 'image',
                showHidePdfPageImage: '',
                companyTagLine: '',
                personDetail: '<p>If ever there was a moment when time equals luxury, it`s now. Given today`s increasingly fast-paced culture, time to ourselves and with those we cherish most is paramount. Travel is the ultimate connector. It expands horizons and reveals new physical and emotional landscapes. We daydream from our desktops, iPhones, and on our morning commute about where to journey next.  </p><p>As such, let our global expertise be your travel muse. We research the globe for where to go next and leverage personal relationships with top in-destination guides and experts. Our exclusive benefits and connections around the world ensure seamless service and dare-to-leave-me hotels, resorts, and ships. Enjoy complimentary breakfast and additional benefits in more than 1000 hotels and resorts around the globe, plus, receive additional exclusive amenities when reserving select suite accommodations</p><p>In this new, re-launched issue of Ultimate Experiences, tour the islands of Tahiti, get behind the lens with famous photographer Steve McCurry, discover the hidden gems of Los Cabos, Mexico, and  </p>',
                
                

            }
        },
        mounted () {
            this.setActiveClass()
            this.fetchBooks();
            this.fetchLogoImages();
            // get state and city
            //  axios.get(this.$url + 'api/stateAndCity', {
            //     headers: {
            //         Authorization: this.$session.get('accessToken')
            //     }
            // })
            // .then(response => {
            //     // set Response data to form data
            //     console.log(response.data, 'sdfsdfsdfsdfsdfsd')
            //     this.stateData = response.data.state;
            //     this.loadedCityData = response.data.city;
            //     // console.log(this.stateData, this.cityData)
            // })
        },
        methods: {
            ...mapActions([
                'EMPTY_INSIDE_FRONTCOVER',
            ]),
            ...mapMutations([
                'SET_ACTIVE_CLASS',
                'PUSH_IN_INSIDE_FRONT_COVER',
                'EMPTY_MESSAGE_LIST',
                'PUSH_MESSAGE',
            ]),
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                // check file extension
                var str = files[0].name;
                var res = str.split(".");
                if (!files.length)
                    return;
                if (res[1] === 'pdf') {
                    this.createImage(files[0]);
                } else {
                    this.$store.state.errorMessage.push({message: 'The pdf field must be a valid file.'})
                }
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
                var data = new FormData()
                var file = this.$refs.fileInput.files[0]
                data.append('my_file', file)
                data.append('image', imageData)
                data.append('imageType', 'pdf')
                axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
                axios.post('api/uploadPdf',data)
                .then(response => {                
                    this.showHidePdfPage = 'pdf'
                    // this.libraryImages.push(response.data.data)
                    this.showHidePdfPageImage = response.data.data.image
                    this.$store.state.successMessage.push({message: 'Pdf Uploaded!'})
                })
                .catch(errorResponse => {
                    this.$store.state.errorMessage.push({message: errorResponse.response.data.message})
                })
            },
			setActiveClass() {
				// call to the store ation method
				this.SET_ACTIVE_CLASS(2)				
            },
            changeSignaure (imageUrl, imageId) {
                // set selected signature
                this.signatureImage = imageUrl
                this.signatureImageId = imageId
            },
            fetchBooks () {
                axios.get(this.$url + 'api/usersBook/' + this.$session.get('bookCoverId'), {
                    headers: {
                        Authorization: this.$session.get('accessToken')
                    }
                })
                .then(response => {
                    // set Response data to form data
                    // console.log(response.data.data.inside_front_cover.book_id, 'dsfsdf')
                    if (response.data.data.inside_front_cover) {
                        this.setFormData(response.data.data.inside_front_cover);
                        this.isSaved = true;
                    }
                    // this.insideFrontCover.push(response.data.data.inside_front_cover)
                    
                })
            },
            fetchLogoImages () {
                axios.get(this.$url + 'api/myLibrary', {
                    headers: {
                        Authorization: this.$session.get('accessToken')
                    }
                })
                .then (response => {
                    this.libraryImages = response.data.data;
                    // console.log(response.data)
                })
                .catch (errorResponse => {
                    console.log(errorResponse, 'error')
                })
            },
            saveInsideFrontCover (type) {
                this.EMPTY_MESSAGE_LIST();
                // save inside Front Cover data to database
                axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
                var data = {
                    withPhoto: this.withPhoto,
                    nameOrCompanyName: this.nameOrCompanyName,
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
                    columnName: 'inside_front_cover',
                    logoImage: this.logoImage,
                    logoImageId: this.logoImageId,
                    withPhotoImage: this.withPhotoImage,
                    withPhotoImageId: this.withPhotoImageId,
                    officeNumber: this.officeNumber,
                    contactName1: this.contactName1,
                    contactName2: this.contactName2,
                    contactName3: this.contactName3,
                    contactTitle1: this.contactTitle1,
                    contactTitle2: this.contactTitle2,
                    contactTitle3: this.contactTitle3,
                    directNumber: this.directNumber,
                    nameOrCompanyName: this.nameOrCompanyName,
                    signatureHolderTitle: this.signatureHolderTitle,
                    signatureHolderName: this.signatureHolderName,
                    signatureImage: this.signatureImage,
                    signatureImageId: this.signatureImageId,
                    showHidePdf: this.showHidePdf,
                    showHidePdfPage: this.showHidePdfPage,
                    showHidePdfPageImage: this.showHidePdfPageImage,
                    personDetail: this.personDetail,
                    companyTagLine: this.companyTagLine,
                }
                axios.post(this.$url + 'api/usersBook', data)
                .then(response => {
                   if (response.data.success === true) {
                        // empty insideFrontCover
                        // this.EMPTY_INSIDE_FRONTCOVER();
                        // push data in the insideFrontCover
                        // this.insideFrontCover.push(data)
                        // push data in the store variable
                        this.PUSH_IN_INSIDE_FRONT_COVER(data)
                        // console.log(this.insideFrontCover, 'savce')
                        // redirect to the next page
                        if (type === 2) {
                            this.PUSH_MESSAGE('Inside Front Cover Saved and aproved!');
                            this.$router.push('/cover3/insideBackCover')    
                        } else {
                            this.PUSH_MESSAGE('Inside Front Cover Saved!');
                        }
                        // this.$store.state.successMessage.push({message: 'Inside Front Cover Saved!'})
                    }
                })
                .catch(errorResponse => {
                    this.$store.state.errorMessage.push({message: 'Internal server error!'})
                    // console.log(errorResponse.response)
                })
            },
            // change logo image
            changeLogo (imageURL, imageId) {
                // for logo
                this.logoImage = imageURL
                this.logoImageId = imageId
            },
            // change Photo Image
            option2ImageChange (imageURL, imageId) {
                // for photo
                this.withPhotoImage = imageURL
                this.withPhotoImageId = imageId
            },
            // set Form Data from database
            setFormData (responseData) {                
                this.PUSH_IN_INSIDE_FRONT_COVER(responseData)                
                this.$store.state.insideFrontCover.push(responseData)
                this.withPhoto = responseData.withPhoto;
                this.agency1 = !responseData ? this.$session.get('magazineProfile').agency1 : responseData.agency1;
                this.agency2 = !responseData ? this.$session.get('magazineProfile').agency2 : responseData.agency2;
                // this.tagLine2 = !responseData ? this.$session.get('magazineProfile').tagLine2 : responseData.tagLine2;
                // this.tagLine3 = !responseData ? this.$session.get('magazineProfile').tagLine3 : responseData.tagLine3;
                this.address = !responseData ? this.$session.get('magazineProfile').address : responseData.address;
                // this.address2 = !responseData ? this.$session.get('magazineProfile').address2 : responseData.address2;
                this.city = !responseData ? this.$session.get('magazineProfile').city : responseData.city;
                this.state = !responseData ? this.$session.get('magazineProfile').state : responseData.state;
                this.zipCode = !responseData ? this.$session.get('magazineProfile').zipCode : responseData.zipCode;
                this.phone = !responseData ? this.$session.get('magazineProfile').phoneNumber : responseData.phone;
                this.tollFreeNumber = !responseData ? this.$session.get('magazineProfile').tollFreeNumber : responseData.tollFreeNumber;
                this.email = !responseData ? this.$session.get('magazineProfile').email : responseData. email;
                this.website = !responseData ? this.$session.get('magazineProfile').website : responseData.website;
                this.memberCSTNumber = !responseData ? this.$session.get('magazineProfile').memberCSTNumber : responseData.memberCSTNumber;
                this.logoImage = responseData.logoImage;
                this.logoImageId = responseData.logoImageId;
                this.withPhotoImage = responseData.withPhotoImage
                this.withPhotoImageId = responseData.withPhotoImageId
                this.officeNumber = responseData.officeNumber
                this.contactName1 = responseData.contactName1
                this.contactName2 = responseData.contactName2
                this.contactName3 = responseData.contactName3
                this.contactTitle1 = responseData.contactTitle1
                this.contactTitle2 = responseData.contactTitle2
                this.contactTitle3 = responseData.contactTitle3
                this.directNumber = responseData.directNumber
                this.nameOrCompanyName = responseData.nameOrCompanyName
                this.signatureHolderTitle = responseData.signatureHolderTitle
                this.signatureHolderName = responseData.signatureHolderName
                this.signatureImage = responseData.signatureImage
                this.signatureImageId = responseData.signatureImageId
                this.showHidePdfPageImage = responseData.showHidePdfPageImage
                this.showHidePdfPage = responseData.showHidePdfPage
                this.personDetail = responseData.personDetail
                this.companyTagLine = responseData.companyTagLine
                if (responseData.showHidePdfPage === 'pdf') {
                    this.showHidePdf = true
                }
            }
        }
    }
</script>
