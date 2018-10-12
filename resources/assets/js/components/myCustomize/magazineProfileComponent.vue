<template>
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 home_content">
        <div class="form_profile">
        <h3>{{ agentName }} of {{ agency1 ? agency1 : 'Travel' }}</h3>
        <form class="profile_form">
            <div class=" col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <div class=" col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" v-model="agentName" placeholder="Agent Name">
                    </div>
                    <div class=" col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" v-model="agency1" placeholder="Company Name">
                    </div>
                    <div class=" col-sm-4 col-md-4 col-xs-12 last_div">
                        <input type="email" class="form-control" v-model="email" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class=" col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" v-model="address" placeholder="Address">
                    </div>
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" disabled="true" v-model="printMarketingVersion" placeholder="Print Marketing Version">
                    </div>
                    <div class="  col-sm-4 col-md-4 col-xs-12 last_div">
                        <input type="url" class="form-control" v-model="website" placeholder="Website">
                    </div>
                </div>
            </div>
            <div class=" col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" v-model="city" placeholder="City">
                    </div>
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <div class="row">
                            <div class=" col-sm-6 col-md-4 col-xs-6">
                                <select class="form-control" v-model="state">
                                    <option value="">Select State</option>
                                    <option :value="states.short_code" v-for="(states, index) in this.$session.get('states')" :key="index">{{states.short_code}}</option>
                                </select>
                            </div>
                            <div class=" col-sm-6 col-md-8 col-xs-6">
                                <input type="type" class="form-control zip_code" v-model="zip" placeholder="Zip Code">
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-4 col-md-4 col-xs-12 last_div">
                        <input type="type" v-model="memberCSTNumber" class="form-control" placeholder="CST#">
                    </div>
                </div>
            </div>
            <div class=" col-sm-12 col-md-12 col-xs-12 ">
                <div class="form-group">
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" v-model="phoneNumber" placeholder="Phone Number">
                    </div>
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" v-model="tollFreeNumber" placeholder="Toll Free Number">
                    </div>
                    <div class="  col-sm-4 col-md-4 col-xs-12 last_div">
                        <input type="text" class="form-control" v-model="faxNumber" placeholder="Fax Number">
                    </div>
                </div>
                <div class="form-group">
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" v-model="profileTypeId" placeholder="Profile Type Id">
                    </div>
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" v-model="agencyId" placeholder="Agency Id">
                    </div>
                    <div class="  col-sm-4 col-md-4 col-xs-12 last_div">
                        <input type="text" class="form-control" v-model="branchId" placeholder="Branch Id">
                    </div>
                </div>

                <div class="form-group">
                    <!-- <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" v-model="directNumber" placeholder="Direct Number">
                    </div>
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div">
                        <input type="text" class="form-control" v-model="officeNumber" placeholder="Office Number">
                    </div> -->
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div" style="    text-align: left;">
                        <input type="checkbox" id="showPassword" :checked="showPassword" @click="showPassword = !showPassword" placeholder="Direct Number">
                        <label for="showPassword">Click here to change password</label>
                    </div>
                    <div class="  col-sm-4 col-md-4 col-xs-12 first_second_div" v-if="showPassword">
                        <input data-vv-name="password"  name="password" v-validate="'required'" ref="password" class="form-control" type="password" v-model="password" placeholder="Password">
                        <span v-show="errors.has('password')" class="color-red">{{ errors.first('password') }}</span>
                    </div>
                    <div class="  col-sm-4 col-md-4 col-xs-12 last_div" v-if="showPassword">
                        <input data-vv-name="confirm_password"  v-validate="'confirmed:password|required'" class="form-control" name="confirm_password" type="password" placeholder="Confirm Password">
                        <span v-show="errors.has('confirm_password')" class="color-red">{{ errors.first('confirm_password') }}</span>
                    </div>
                </div>


                <div class="form-group">
                    
                    
                </div>
            </div>
            <div class=" col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <div class=" col-sm-4 col-md-4 col-xs-12 pull-right">
                        <input type="button" class="submit_btn" :disabled="errors.has('confirm_password')"  value="Save" @click="saveMagazineProfile">
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex';
export default {
    data () {
        return {
            agentName: '',
            agency1: '',
            agency2: '',
            address: '',
            address2: '',
            city: '',
            cityData: [],
            loadedCityData: [],
            stateData: '',
            state: '',
            faxNumber: '',
            zipCode: '',
            zip: '',
            phoneNumber: '',
            tollFreeNumber: '',
            email: '',
            website: '',
            memberCSTNumber: '',
            directNumber: '',
            officeNumber: '',
            showPassword: false,
            password: '',
            profileTypeId: '',
            agencyId: '',
            branchId: '',
            printMarketingVersion: '',

        }
    },
    mounted () {
        // this.getStates();
        // this.getMagazineProfile();
        // console.log(this.$session.get('magazineProfile'))
        this.setMagazineProfile();
    },
    methods: {
        ...mapMutations([
            'SET_ACTIVE_CLASS',
            'PUSH_IN_INSIDE_FRONT_COVER',
            'EMPTY_MESSAGE_LIST',
            'PUSH_MESSAGE',
            'PUSH_ERROR_MESSAGE',
        ]),
        saveMagazineProfile () {
            this.EMPTY_MESSAGE_LIST()
            this.$validator.validateAll().then(result => {
                if (result) {
                    axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
                    var data = {
                        name: this.agentName,
                        // roles: this.$session.get('magazineProfile').role_id,
                        agency1: this.agency1,
                        agency2: this.agency2,
                        address: this.address,
                        address2: this.address2,
                        city: this.city,
                        state: this.state,
                        zip: this.zip,
                        phoneNumber: this. phoneNumber,
                        tollFreeNumber: this.tollFreeNumber,
                        email: this.email,
                        website: this.website,
                        memberCSTNumber: this.memberCSTNumber,
                        faxNumber: this.faxNumber,
                        officeNumber: this.officeNumber,
                        directNumber: this.directNumber,
                        showPassword: this.showPassword,
                        password: this.password,
                        profileTypeId: this.profileTypeId,
                        agencyId: this.agencyId,
                        branchId: this.branchId,
                        printMarketingVersion: this.printMarketingVersion,
                    };
                    axios.post(this.$url + 'api/magazineProfile', data)
                    .then (response => {
                        this.$session.set('magazineProfile', response.data.data)
                        this.$session.set('userName', this.agentName)
                        this.$session.set('userCompanyName', this.agency1)
                        this.PUSH_MESSAGE('Profile Updated!')
                    })
                    .catch (errorResponse => {
                        this.$store.state.errorMessage.push({message: errorResponse.response.data.message})                
                    })
                } else {
                    this.EMPTY_MESSAGE_LIST()
                    this.PUSH_ERROR_MESSAGE('Fill required data.')
                }
            })
        },
        
        // getMagazineProfile () {
        //     axios.get(this.$url + 'api/getMagazineProfile', {
        //         headers: {
        //             Authorization: this.$session.get('accessToken')
        //         }
        //     })
        //     .then(response => {
        //         console.log(response.data)
        //         this.stateData = response.data.state
        //         console.log(this.$session.get('magazineProfile'))
        //     })
        // }
        setMagazineProfile () {
            console.log(this.$session.get('magazineProfile'), 'magazine')
            this.agentName = this.$session.get('magazineProfile').name
            this.agency1 = this.$session.get('magazineProfile').agency
            this.agency2 = this.$session.get('magazineProfile').agency2
            this.address = this.$session.get('magazineProfile').address
            this.address2 = this.$session.get('magazineProfile').address_2
            this.city = this.$session.get('magazineProfile').city
            this.state = this.$session.get('magazineProfile').state
            this.zip = this.$session.get('magazineProfile').zip
            this.phoneNumber = this.$session.get('magazineProfile').phone
            this.directNumber = this.$session.get('magazineProfile').direct_number
            this.tollFreeNumber = this.$session.get('magazineProfile').toll_free_number
            this.email = this.$session.get('magazineProfile').email
            this.website = this.$session.get('magazineProfile').website
            this.memberCSTNumber = this.$session.get('magazineProfile').member_cst_number
            this.faxNumber = this.$session.get('magazineProfile').fax_number
            this.officeNumber = this.$session.get('magazineProfile').office_number
            this.profileTypeId = this.$session.get('magazineProfile').profile_type_id
            this.agencyId = this.$session.get('magazineProfile').agency_id
            this.branchId = this.$session.get('magazineProfile').branch_id
             this.printMarketingVersion = this.$session.get('magazineProfile').print_marketing_version
        }
    }
}
</script>

