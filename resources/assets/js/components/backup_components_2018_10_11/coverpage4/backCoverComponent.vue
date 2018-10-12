<template>
    <div class="col-sm-8 col-md-8 col-xs-12 right_side">
        <div class="padding_left_right">    
            <form>
                <div class="form-group">
                    <p class="heading_title" style="margin-top: 0px;">Step 4. Back Cover</p>
                    <p class="magin_bottom_70">Include your information for back cover</p>
                </div>        
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="nameOrCompanyName" id="" class="form-control" placeholder="Name or Company Name" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="memberCSTNumber" id="" class="form-control" placeholder="ST #" >
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="address" id="" class="form-control" placeholder="Address" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="address2" id="" class="form-control" placeholder="Address" >
                            </div>
                        </div>
                    </div>
                </div> -->
                 <!-- New Changes -->
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" id="" v-model="address" class="form-control" placeholder="Address" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" id="" v-model="location" class="form-control" placeholder="Location" >
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" v-model="city" class="form-control" id="" placeholder="City" >
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
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <select class="form-control" v-model="state">
                                            <option value="">Select State</option>
                                            <option :value="state.short_code" v-for="(state, index) in this.$session.get('states')" :key="index">{{state.short_code}}</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" maxlength="13" v-model="zipCode" class="form-control" id="" placeholder="Zipcode" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-sm-6 full_width">
                                        <input type="text" name="" maxlength="17" v-model="locationPhone" class="form-control" id="" placeholder="Phone" >
                                    </div>
                                    <div class="col-xs-12 col-md-3 col-sm-3 col-sm-offset-1 col-xs-offset-5">   
                                        <button type="button" class="green_btn submit_btn" @click="addRow" style="width: 100%; margin-bottom:0px;">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- extra address code -->
                <div v-if="extraAddress.length > 0" v-for="(input, key) in extraAddress" :key="key">
                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" id="" v-model="input.address" class="form-control" placeholder="Address" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" id="" v-model="input.location" class="form-control" placeholder="Location" >
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-sm-6">
                                        <input type="text" name="" v-model="input.city" class="form-control" id="" placeholder="City" >
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
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 col-sm-6 full_width">
                                            <select class="form-control" v-model="input.state">
                                                <option value="">State</option>
                                                <option :value="state.short_code" v-for="(state, index) in anotherStateData" :key="index">{{state.short_code}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-md-6 col-sm-6">
                                            <input type="text" name="" maxlength="13" v-model="input.zip" class="form-control" id="" placeholder="Zipcode" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 col-sm-6 full_width">
                                            <input type="text" name="" maxlength="17" v-model="input.locationPhone" class="form-control" id="" placeholder="Phone" >
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-sm-3 col-sm-offset-1 col-xs-offset-5">   
                                            <button type="button" class="green_btn submit_btn" @click="deleteRow(key)" style="margin-bottom:0px;width: 100%;">-</button>
                                        </div>
                                        <!-- <button type="button" class="btn btn-primary" @click="addRow">+</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end New Changes -->
                <!-- <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="city" id="" class="form-control" placeholder="City" >
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-xs-12 col-md-4 col-sm-4">
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
                </div> -->
                <!-- Second Address -->
                <!-- <div v-if="isChecked">
                    <div class="form-group name_field">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <input type="text" name="" v-model="anotherNameOrCompanyName" id="" class="form-control" placeholder="Name or Company Name" >
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <div class="row">
                            <div>
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <input type="text" name="" v-model="anotherAddress" id="" class="form-control" placeholder="Address" >
                                </div>
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <input type="text" name="" v-model="anotherAddress2" id="" class="form-control" placeholder="Address" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div>
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <input type="text" name="" v-model="anotherCity" id="" class="form-control" placeholder="City" >
                                </div>
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4 col-sm-4">
                                            <select class="form-control" v-model="anotherState">
                                                <option value="">Select State</option>
                                                <option :value="state.short_code" v-for="(state, index) in this.$session.get('states')" :key="index">{{state.short_code}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-md-8 col-sm-8">
                                            <input type="text" name="" v-model="anotherZipCode" class="form-control" id="" placeholder="Zipcode" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="row">
                        <div>
                            <div class="col-xs-12 col-md-12 col-sm-12">
                                <!-- <input type="text" name="" v-model="memberCSTNumber" id="" class="form-control" placeholder="ST #" > -->
                                <div class=" footer_checkbox_button">
                                    <input type="checkbox" :checked="withFooterImage" value="" @click="withFooterImageFunction" id="footer">
                                    <label for="footer"> Upload Own Footer Contact</label>
                                </div>
                                <button type="button" name="" @click="storeBackCover(1)" value="Preview" class="green_btn submit_btn" style="margin-right: 0px;" ><span>Save</span></button>
                                <button v-if="withFooterImage" type="button" class="green_btn submit_btn" data-toggle="modal" data-target="#footerLogoComponent"  style="margin-right:0px;"><span>Choose Footer Image</span></button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group" id="my-node">
                    <div class="row">
                        <div class="col-xs-9 col-md-9 col-sm-9 main_preview pull-left ">
                            <div class="preview_img_div book_3_preview">
                                <div class="col-sm-12 col-xs-12 col-md-12" v-if="!footerCondition">
                                    <div class="col-sm-12 col-md-12 col-xs-12 pull-left left_sideback book_2 book1_backcover_height">
                                        <div class="bccover_logo">
                                            <img :src="logoImage ? logoImage : ''"  alt="" title="" >
                                                <!--<img :src="logoImage ? logoImage : 'magazine/images/cover_logo.png'"  alt="" title="" >-->
                                        </div>
                                        <h3><b>{{ nameOrCompanyName ? nameOrCompanyName : '' }}</b></h3>
                                        <h3>{{ location ? location : isSaved ? '' :'Location'  }}</h3>
                                        <h3>{{ address ? address : isSaved ? '' : 'Address' }}</h3> 
                                        <!-- <h3>{{ address2 ? address2 : isSaved ? '' : '' }}</h3> -->
                                        <h3>{{ city ? city + ',' : isSaved ? '' : 'City' }} {{ state ? state : isSaved ? '' : 'State' }} {{ zipCode ? zipCode : isSaved ? '' : 'XXXX' }}</h3>
                                        <h3>{{ locationPhone ? locationPhone : isSaved ? '' :'xxx.xxx.xxxx'  }}</h3><br class="responsive_br">
                                            
                                        <!-- loop for Extra Address -->
                                            <div v-if="extraAddress.length > 0" v-for="(address, index) in extraAddress" :key="index">
                                                <h3>{{ address.location ? address.location : isSaved ? '' :'Location'  }}</h3>
                                                <h3>{{ address.address ? address.address : isSaved ? '' :'address'  }}</h3>
                                                <h3>{{ address.city ? address.city + ',' : isSaved ? '' :'City'  }}
                                                    {{address.state ? address.state : isSaved ? '' :'State' }}
                                                    {{address.zip ? address.zip : isSaved ? '' : 'xxxx'}}
                                                </h3>
                                                <h3>{{ address.locationPhone ? address.locationPhone  : isSaved ? '' :'Phone Number'  }}</h3>
                                                <!-- <h3>{{ address.location ? address.location : isSaved ? '' :'Location'  }}</h3> -->
                                                <br class="responsive_br">
                                            </div>
                                            <br class="responsive_br">
                                        <!-- loop end -->


                                        <h3>{{ phone ? phone : isSaved ? '' : 'XXXXXXXXXX' }} {{phone && tollFreeNumber ? '' : ''}}</h3>
                                        <h3>{{ tollFreeNumber ? tollFreeNumber : isSaved ? '' : 'XXXXXXXXXX' }}</h3><br class="responsive_br">
                                        <h3>{{ website ? website : isSaved ? '' : 'www.example.org' }}</h3>
                                        <h3 v-if="email">{{ email ? email : isSaved ? '' : 'example@email.com' }}</h3>
                                        <h3>{{ memberCSTNumber ? memberCSTNumber : isSaved ? '' : 'XXXX' }}</h3>
                                    </div>
                                </div>


                                <!-- For footer image -->

                                <div class="" v-if="footerCondition">
                                   <div class="pull-left left_sideback book1_backcover_height " style="margin:0px;">
                                       <img :src="footerImage" alt="" style="width:100%; height:100%;">
                                   </div>
                                </div>


                                <div class="bottom_backcover">
                                    <img src="magazine/images/backcover4.jpg" alt="" title="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 col-md-3 col-sm-3 approve_btn pull-right" style="padding: 0px;">
                            <div class="form-group">
                                <button type="button" class="green_btn submit_btn" style="margin-right: 0px;" @click="storeBackCover(2)"><span>Approve & Download PDF</span></button>
                                <!-- <button type="button" class="green_btn submit_btn" style="margin-right: 0px;" @click="storeBackCover(2)"><span>Finish & Approve All Pages</span></button> -->
                                <!-- <button type="button" class="green_btn submit_btn" style="margin-right: 0px;"  data-toggle="modal" data-target="#myModal"><span>Image</span></button> -->
                                <!-- <a  href="#" class="green_btn submit_btn" style="margin-right: 0px;">Finish & Approve All Pages</a> -->
                            </div>
                        </div>
                    </div>
                </div>

                
                <div id="show"></div>
                </form>
        </div>
    <!-- model for choose logo -->
    <!-- <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Choose Logo</h4>
                </div>
                <div class="modal-body">
                    <generatePDF></generatePDF>
                </div>
            </div>
        </div>
    </div> -->

            <!-- model for choose footer  -->
    <div class="modal fade" id="footerLogoComponent" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <footerLogoComponent></footerLogoComponent>
        </div>
    </div>
    
    </div>
</template>

<script>
// import * as jsPDF from 'jspdf'
// import domtoimage from 'dom-to-image';
// import html2canvas from 'html2canvas';
// import generatePDF from './generatePDF.vue';
// import { FingerprintSpinner } from 'epic-spinners'
import footerLogoComponent from '../common/footerLogoComponent.vue';
import { mapState, mapMutations, mapActions } from 'vuex';
    export default {
        components: {
            // generatePDF,
            // 'fingerprint-spinner': FingerprintSpinner,
            footerLogoComponent,
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
                nameOrCompanyName: '',
                officeNumber: '',
                directNumber : '', 
                isSaved : false,
                isChecked: false,
                anotherNameOrCompanyName: '',
                anotherAddress: '',
                anotherAddress2: '',
                anotherCity: '',
                anotherState: '',
                anotherZipCode: '',
                extraAddress: [],
                anotherAddress: [],
                anotherStateData: [],
                locationPhone: '',
                location: '',
                withFooterImage: false,
                footerImage: '',
                footerImageId: '',
                footerCondition: false,
            }
        },
        mounted () {
            this.setActiveClass();
            this.setData();
            // this.fetchLogoImages();
            // set states Data to the anotherStateDate
            this.anotherStateData = this.$session.get('states')
            axios.get(this.$url + 'api/usersBook/' + this.$session.get('bookCoverId'), {
                headers: {
                    Authorization: this.$session.get('accessToken')
                }
            })
            .then(response => {
                // set Response data to form data
                if (response.data.data) {
                    this.setFormData(response.data.data.inside_front_cover,response.data.data.back_cover);    
                }
                // this.insideFrontCover.push(response.data.data.inside_front_cover)
                
            })
            
        },
        methods: {
            ...mapActions([
                'EMPTY_INSIDE_BACKCOVER',
            ]),
            ...mapMutations([
                'SET_ACTIVE_CLASS',
                'PUSH_IN_INSIDE_FRONT_COVER',
                'EMPTY_MESSAGE_LIST',
                'PUSH_MESSAGE',
			]),
			setActiveClass() {
				// call to the store ation method
				this.SET_ACTIVE_CLASS(4)
            },
            createImage () {
                var doc = new jsPDF('p', 'pt', 'a4', true);

                doc.fromHTML($('#my-node').get(0), 15, 15, {
                    'width': 500
                    }, function (dispose) {
                        doc.save('thisMotion.pdf');
                    });
                // doc.save('sample-file.pdf');
                /*var node = document.getElementById('my-node');
                domtoimage.toPng(node).then(function (dataUrl) {
                    var img = new Image();
                    img.src = dataUrl;
                    document.getElementById("show").appendChild(img);
                }).catch(function (error) {
                    console.error('oops, something went wrong!', error);
                });*/
            },
            saveBook () {
                axios.post(this.$url + 'api/usersBook', {
                    user_id: this.$session.get('userId'),
                    book_id: this.bookId,
                    title: this.title,
                    columnName: 'back_cover',
                })
                .then(response => {
                    // console.log(response.data, 'index');
                })
                .catch (error => {
                    // console.log(error, 'kandarp')
                })
            },
            // change logo image
            changeLogo (imageURL, imageId) {
                this.logoImage = imageURL;
                this.logoImageId = imageId;                
            },
            fetchLogoImages () {
                axios.get(this.$url + 'api/myLibrary', {
                    headers: {
                        Authorization: this.$session.get('accessToken')
                    }
                })
                .then (response => {
                    this.libraryImages = response.data.data;
                    console.log(response.data)
                })
                .catch (errorResponse => {
                    console.log(errorResponse, 'error')
                })
            },
            storeBackCover (type) {
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
                    book_id: this.$session.get('bookCoverId') ? this.$session.get('bookCoverId') : 1,
                    columnName: 'back_cover',
                    logoImage: this.logoImage,
                    logoImageId: this.logoImageId,
                    nameOrCompanyName: this.nameOrCompanyName,
                    isChecked: this.isChecked,
                    anotherAddress: this.anotherAddress,
                    anotherAddress2: this.anotherAddress2,
                    anotherCity: this.anotherCity,
                    anotherState: this.anotherState,
                    anotherZipCode: this.anotherZipCode,
                    anotherNameOrCompanyName: this.anotherNameOrCompanyName,
                    extraAddress: this.extraAddress,
                    locationPhone: this.locationPhone,
                    location: this.location,
                    withFooterImage: this.withFooterImage,
                    footerImage: this.footerImage,
                    footerImageId: this.footerImageId,
                    footerCondition: this.footerCondition
                }
                axios.post(this.$url + 'api/usersBook', data)
                .then(response => {
                   if (response.data.success === true) {
                        // empty insideFrontCover
                        this.EMPTY_INSIDE_BACKCOVER();
                        // push data in the insideFrontCover
                        this.insideFrontCover.push(data)
                        // if type = 2 then generate pdf
                        if (type ===  2) {
                            this.$parent.runLoader(1)
                            axios.post(this.$url + 'api/generatePDF', {
                                bookId: this.bookId
                            })
                            .then(pdfResponse => {
                                var link = document.createElement('a');
                                link.href = this.$url + pdfResponse.data.data;
                                link.download = pdfResponse.data.name + '.pdf';
                                link.dispatchEvent(new MouseEvent('click'));
                                this.$parent.runLoader(2)
                                console.log(pdfResponse.data.data, 'response kandarp pandya')
                                this.PUSH_MESSAGE('Back Cover Updated!')
                            })
                            .catch(errorResp => {
                                this.$parent.runLoader(1)
                                console.log(errorResp.response.data)
                            })
                        } else {
                            this.PUSH_MESSAGE('Back Cover Updated!')
                        }
                        // console.log(this.insideFrontCover, 'savce')
                    }
                })
                .catch(errorResponse => {
                    // console.log(errorResponse.response)
                         this.PUSH_MESSAGE('Invernal server error')
                })
            },
            changeActive (param) {
                // alert(param)
            },
             // set Form Data from database
            setFormData (responseData, responseData2) {
                if (responseData2) {
                    this.isSaved = true;
                }
                // console.log(responseData, 'respo')
                this.officeNumber = responseData.officeNumber
                this.directNumber = responseData.directNumber
                this.nameOrCompanyName = responseData2.nameOrCompanyName;
                this.withPhoto = responseData2.withPhoto;
                this.agency1 = responseData2.agency1;
                this.agency2 = responseData2.agency2 ? responseData2.agency2 : this.$session.get('magazineProfile').agency2;
                // this.tagLine1 = responseData.tagLine1;
                // this.tagLine2 = responseData.tagLine2;
                // this.tagLine3 = responseData.tagLine3;
                this.address = responseData2.address;
                this.address2 = responseData2.address2;
                this.city = responseData2.city;
                this.state = responseData2.state;
                this.zipCode = responseData2.zipCode;
                this.phone = responseData2.phone;
                this.tollFreeNumber = responseData2.tollFreeNumber;
                this.email = responseData. email;
                this.website = responseData.website;
                this.memberCSTNumber = responseData.memberCSTNumber;
                this.logoImage = responseData.logoImage;
                this.isChecked = responseData2.isChecked;
                this.anotherAddress = responseData2.anotherAddress;
                this.anotherAddress2 = responseData2.anotherAddress2;
                this.anotherCity = responseData2.anotherCity;
                this.anotherState = responseData2.anotherState;
                this.anotherZipCode = responseData2.anotherZipCode;
                this.anotherNameOrCompanyName = responseData2.anotherNameOrCompanyName;
                this.extraAddress = responseData2.extraAddress ? responseData2.extraAddress : responseData.extraAddress
                this.location = responseData2.location ? responseData2.location : responseData.location
                this.locationPhone = responseData2.locationPhone ? responseData2.locationPhone : responseData.locationPhone
                this.withFooterImage = responseData2.withFooterImage ? responseData2.withFooterImage : false
                this.footerImage = responseData2.footerImage ? responseData2.footerImage : ''
                this.footerCondition = responseData2.footerCondition ? responseData2.footerCondition : false
                this.footerImageId = responseData2.footerImageId
            },
            setData () {
                // this.withPhoto = responseData.withPhoto;
                this.agency1 = this.$session.get('magazineProfile').agency1;
                this.agency2 = this.$session.get('magazineProfile').agency2;
                // this.tagLine1 = responseData.tagLine1;
                // this.tagLine2 = responseData.tagLine2;
                // this.tagLine3 = responseData.tagLine3;
                this.address = this.$session.get('magazineProfile').address;
                // this.address2 = responseData2.address2;
                this.city = this.$session.get('magazineProfile').city;
                this.state = this.$session.get('magazineProfile').state;
                this.zipCode = this.$session.get('magazineProfile').zipCode;
                this.phone = this.$session.get('magazineProfile').phoneNumber;
                this.tollFreeNumber = this.$session.get('magazineProfile').tollFreeNumber;
                this.email = this.$session.get('magazineProfile'). email;
                this.website = this.$session.get('magazineProfile').website;
                this.memberCSTNumber = this.$session.get('magazineProfile').memberCSTNumber;
            },
            addRow() {
                // add address fields
                if (this.extraAddress.length <= 2) {
                    this.extraAddress.push({
                        anotherCity: '',
                        anotherAddress: '',
                        anotherZip: '',
                        anotherState: '',
                        state: '',
                    })
                }
            },
            deleteRow(index) {
                // 
                this.extraAddress.splice(index,1)
            },
            footerImageChange (imageURL, imageId) {
                // for footet image                
                this.footerImage = imageURL
                this.footerImageId = imageId
                this.footerCondition = true
            },
            withFooterImageFunction () {
                 this.withFooterImage = !this.withFooterImage
                 if (this.withFooterImage) {
                    this.footerCondition = true
                 } else {
                     this.footerCondition = false
                 }
            }
        }
    }
</script>
