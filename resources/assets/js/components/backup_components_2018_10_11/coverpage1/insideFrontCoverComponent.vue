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
                        <option value="with_pdf">Upload Artwork</option>
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
                                    <input type="text" v-model="email" name="" id="" class="form-control" placeholder="Email" >
                                </div>
                                
                                <!-- <div class="col-xs-12 col-md-6 col-sm-6">
                                    <input type="text" name="" id="" v-model="address" class="form-control" placeholder="Address" >
                                </div> -->
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
                                    <input type="text" v-model="website" name="" id="" class="form-control" placeholder="URL" >
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
                                        <div class="col-xs-12 col-md-6 col-sm-6 full_width">
                                            <select class="form-control" v-model="state">
                                                <option value="">State</option>
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
                                        <div class="col-xs-12 col-md-3 col-sm-3 col-sm-offset-1">
                                            <button type="button" class="green_btn submit_btn" @click="addRow" style="width: 100%; margin-bottom:0px;">+</button>
                                        </div>
                                        <!-- <button type="button" class="btn btn-primary" @click="addRow">+</button> -->
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
                                            <div class="col-xs-12 col-md-3 col-sm-3 col-sm-offset-1">   
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


                    <div class="form-group">
                        <div class="row">
                            <div>
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <input type="text" name="" v-model="phone" maxlength="17" id="" class="form-control" placeholder="Local Phone Number" >
                                </div>
                                <div class="col-xs-12 col-md-6 col-sm-6">
                                    <input type="text" name="" v-model="tollFreeNumber" maxlength="17" id="" class="form-control" placeholder="Toll-Free Phone Number" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
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
                    </div> -->
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
                                    <button v-if="withFooterImage" type="button" class="green_btn submit_btn" data-toggle="modal" data-target="#footerLogoComponent"  style="margin-right:0px;"><span>Choose Footer Image</span></button>
                                    <div class=" footer_checkbox_button">
                                        <input type="checkbox" :checked="withFooterImage" value="" @click="withFooterImageFunction" id="footer">
                                        <label for="footer"> Upload Own Footer Contact</label>
                                    </div>
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
                                <label style="margin-bottom:0px; padding-left:0px;"><!--<input type="checkbox" :checked="showHidePdf" value="" @click="showHidePdf = !showHidePdf">--><b>Upload Artwork</b> </label> 
                                <label style="padding:0px;width:100%;">Check here if you are uploading your own artwork. Note: High resolution artwork Image only.</label>
                                <input v-on:change="onImageChange" ref="fileInput" type="file"  v-validate="'ext:jpg,png,gif,jpeg'" name="artwork" id="" style="margin-bottom:20px;">
                                <span v-show="errors.has('artwork')" class="color-red">{{ errors.first('artwork') }}</span>
                            </div>
                        </div>
                        <div class="col-xs-9 col-md-9 col-sm-9 pull-left">
                            <div class="preview_img_div" v-if="withPhoto !== 'with_pdf'">
                                <div class="inner_front_cover">
                                    <h2>ENJOY OUR EXPERT <br/> INSIGHTS SO YOU CAN <br/>TRAVEL WITH CONFIDENCE</h2>
                                    <div class="col-sm-12 col-md-12 col-xs-12 inner_fcover">
                                        <div class="col-sm-3 col-md-3 ol-xs-3">
                                            <div class="person_image">
                                                <img :src="withPhotoImage ? withPhoto === 'with_no_photo' ? 'magazine/images/person_photo.png' : withPhotoImage : 'magazine/images/person_photo.png'"  alt="" title="" >
                                            </div>
                                        </div>
                                        <div class="col-sm-9 col-md-9 col-xs-9">
                                            <p v-html="personDetail"></p>
                                            <div class="inner_fccover2 ">
                                                <div class="inner_front_cover" style="margin:0px; width:100%;">
                                                    <div class="book2_signature">
                                                        <img :src="signatureImage" alt="" title="">
                                                        <button v-if="signatureImage" type="button" @click="signatureImage = ''" class="close alert-danger">&times;</button>
                                                        <p class="other_sign" style="margin-bottom: 0px;">{{signatureHolderName}}</p><p>{{signatureHolderTitle}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="inner_fc_bottom" v-if="!footerCondition">
                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                        <div class="col-sm-4 col-xs-4 col-md-4 ">
                                            <div class="inner_fc_bottom_img">
                                                <!-- <img src="magazine/images/image1.jpg" alt="" title="" > -->
                                                <img :src="logoImage ? logoImage : ''"  alt="" title="" >
                                                <!--<img :src="logoImage ? logoImage : 'magazine/images/cover_logo.png'"  alt="" title="" >-->
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 col-md-4 ">
                                            <h3>{{ location ? location : isSaved ? '' :'Location'  }}</h3>
                                            <h3>{{address ? address : isSaved ? '' :'Address' }}</h3>
                                            <!--<h3>{{address2 ? address2 : isSaved ? '' :'Address2' }}</h3>-->
                                            <h3>{{ city ? city + ',' : isSaved ? '' :'City'  }} {{state ? state : isSaved ? '' :'State' }} {{zipCode ? zipCode : isSaved ? '' : 'xxxx'}}</h3>
                                            <h3>{{ locationPhone ? locationPhone : isSaved ? '' :'xxx.xxx.xxxx'  }}</h3><br class="responsive_br">
                                            <!-- loop for Extra Address -->
                                            <div v-if="extraAddress.length > 0 && index < 3" v-for="(address, index) in extraAddress" :key="index">
                                                <h3>{{ address.location ? address.location : isSaved ? '' :'Location'  }}</h3>
                                                <h3>{{ address.address ? address.address : isSaved ? '' :'address'  }}</h3>
                                                <h3>{{ address.city ? address.city + ',' : isSaved ? '' :'City'  }}
                                                    {{address.state ? address.state : isSaved ? '' :'State' }}
                                                    {{address.zip ? address.zip : isSaved ? '' : 'xxxx'}}
                                                </h3>
                                                <h3>{{ address.locationPhone ? address.locationPhone  : isSaved ? '' :'Phone Number'  }}</h3>
                                                <br class="responsive_br">
                                            </div>
                                            <br class="responsive_br">
                                            <!-- loop end -->
                                         </div>
                                        <div class="col-sm-4 col-xs-4 col-md-4 ">
                                            <!-- loop for Extra Address -->
                                            <div v-if="extraAddress.length > 3 && index > 2" v-for="(address, index) in extraAddress" :key="index">
                                                <h3>{{ address.location ? address.location : isSaved ? '' :'Location'  }}</h3>
                                                <h3>{{ address.address ? address.address  : isSaved ? '' :'address'  }}</h3>
                                                <h3>{{ address.city ? address.city + ',' : isSaved ? '' :'City'  }}
                                                    {{ address.state ? address.state : isSaved ? '' :'State' }}
                                                    {{address.zip ? address.zip : isSaved ? '' : 'xxxx'}}
                                                </h3>
                                                <h3>{{ address.locationPhone ? address.locationPhone  : isSaved ? '' :'Phone Number'  }}</h3>
                                                <br class="responsive_br">
                                            </div>
                                            <br class="responsive_br">
                                            <!-- loop end -->
                                            <h3>{{phone ? phone : isSaved ? '' :'XXXXXXXXXX' }} {{phone && tollFreeNumber ? '': ''}} <br class="responsive_br">  {{tollFreeNumber ? tollFreeNumber : isSaved ? '' : 'XXXXXXXXXX' }}</h3><br class="responsive_br">
                                            <h3>{{website ? website : isSaved ? '' : 'www.example.org' }}</h3>
                                            <h3>{{email ? email : isSaved ? '' : 'example@example.com' }}</h3>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 col-md-4 ">
                                            <h3>{{nameOrCompanyName ? nameOrCompanyName : isSaved ? '' : 'Company Name'}}</h3>
                                            <br class="responsive_br">
                                            <h3>{{contactName1 ? contactName1 : isSaved ? '' : 'Contact 1'}}</h3>
                                            <h3>{{ contactTitle1 ? contactTitle1 : isSaved ? '' : 'Title' }}</h3><br class="responsive_br">
                                            <h3>{{contactName2 ? contactName2 : isSaved ? '' : 'Contact 2'}}</h3>
                                            <h3>{{ contactTitle2 ? contactTitle2 : isSaved ? '' : 'Title' }}</h3><br class="responsive_br">
                                            <h3>{{contactName3 ? contactName3 : isSaved ? '' : 'Contact 3'}}</h3>
                                            <h3>{{ contactTitle3 ? contactTitle3 : isSaved ? '' : 'Title' }}</h3><br class="responsive_br">
                                            <h3>{{ memberCSTNumber ? memberCSTNumber : '' }}</h3>
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-12 col-md-12 col-xs-12">
                                        <div class="col-sm-7 col-xs-7 col-md-7 col-sm-offset-3 text-center">
                                            <h3> <br class="responsive_br">{{ memberCSTNumber ? 'ST# ' +  memberCSTNumber : '' }}</h3>
                                        </div>
                                    </div>-->
                                    <div class="col-sm-9 col-xs-9 col-md-9 pull-right text-left tag_linebelow" style="text-align:left;padding:0 0px;width: 70%;">
                                        <h3><br>{{companyTagLine ? companyTagLine : ''}}</h3>
                                    </div>
                                </div>


                                <!-- if Footer image selected -->

                                <div class="preview_footer_images inner_fc_bottom " v-if="footerCondition">
                                    <img :src="footerImage" alt="" style="width:100%;">
                                </div>


                            </div>
                            <div v-if="withPhoto === 'with_pdf'" id="my-node">
                                <img :src="showHidePdfPageImage" alt="" srcset="" width="100%">
                                <!-- <embed :src="showHidePdfPageImage" type="application/pdf"  width="100%" height="700"> -->
                            </div>
                            <!-- <div id="testImage"></div> -->
                        </div>
                        <div class="col-xs-3 col-md-3 col-sm-3 approve_btn pull-right">
                            <div>
                                <button type="button" name="" @click="saveInsideFrontCover(1)" value="Preview" class="green_btn submit_btn" style="margin-right: 0px;" ><span>Save</span></button>
                                <button type="button" class="green_btn submit_btn"  @click="saveInsideFrontCover(2)" style="margin-right: 0px;" ><span>Approve & Go </span></button>
                                <!-- <button type="button" class="btn btn-primary" @click="createimageDom">Create Image</button> -->
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
import { VueEditor, Quill } from "vue2-editor";
import signaturePopupComponent from '../common/signaturePopupComponent.vue';
import othersPopupComponent from '../common/othersPopupComponent.vue';
import logoPopupComponent from '../common/logoPopupComponent.vue';
import footerLogoComponent from '../common/footerLogoComponent.vue';
import domtoimage from "dom-to-image";
import { mapState, mapMutations, mapActions } from 'vuex';
    export default {
        components: {
            othersPopupComponent,
            logoPopupComponent,
            signaturePopupComponent,
            VueEditor,
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
                extraAddress: [],
                anotherCity: [],
                anotherState: [],
                anotherZip: [],
                anotherAddress: [],
                anotherStateData: [],
                locationPhone: '',
                location: '',
                personDetail: '<p>The moments that become memories aren’t always the one you expect.</p><p> It might be the time you rumbled over Aruba’s rugged roads in a 4x4, pulling over to splash in a natural pool. Or the day you decided to bypass the beaches in favor of exploring the emerald-green rice terraces of the Philippines. Perhaps it’s the feeling gratitude as you glance at your loved ones over a shared feast, just as the sun sets into the sea behind them.</p><p>Whether you’re commemorating a long-awaited occasion or simply seeing where the next bend in the road takes you, we’re here to make sure the smallest details turn out just right. We’ll even come up with our own fun surprises — like a bottle of bubbly, a spa treatment for two, and complimentary breakfast in more than 1,000 global hotels and resorts — so your memories will be nothing short of spectacular. </p><p> See where we can take you and then let’s begin celebrating.</p>',
                withFooterImage: false,
                footerImage: '',
                footerImageId: '',
                footerCondition: false,
                
                

            }
        },
        mounted () {
            this.setActiveClass()
            this.fetchBooks();
            this.fetchLogoImages();
            // set states Data to the anotherStateDate
            this.anotherStateData = this.$session.get('states')
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
                    extraAddress: this.extraAddress,
                    locationPhone: this.locationPhone,
                    location: this.location,
                    withFooterImage: this.withFooterImage,
                    footerImage: this.footerImage,
                    footerImageId: this.footerImageId,
                    footerCondition: this.footerCondition,
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
                            this.$router.push('/cover1/insideBackCover')    
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
                this.withPhoto = responseData.withPhoto ? responseData.withPhoto : 'with_no_photo';
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
                this.extraAddress = responseData.extraAddress ? responseData.extraAddress : []
                this.locationPhone = responseData.locationPhone
                this.location = responseData.location
                this.withFooterImage = responseData.withFooterImage ? responseData.withFooterImage : false
                this.footerImage = responseData.footerImage ? responseData.footerImage : ''
                this.footerCondition = responseData.footerCondition ? responseData.footerCondition : false
                this.footerImageId = responseData.footerImageId
                // this.withFooterImageFunction()
                if (responseData.showHidePdfPage === 'pdf') {
                    this.showHidePdf = true
                }
            },
            addRow() {
                // add address fields
                this.extraAddress.push({
                    anotherCity: '',
                    anotherAddress: '',
                    anotherZip: '',
                    anotherState: '',
                    state: '',
                })
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
