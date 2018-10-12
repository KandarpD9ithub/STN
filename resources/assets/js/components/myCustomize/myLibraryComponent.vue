<template>
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 home_content">
        <div class="inner_container">
            <div class="col-sm-4 col-md-4 col-xs-12 left_side ">
                <p>Begin by uploading your photo, logo and signature to appear on your covers.</p>
                <p><b>Requirements : </b></p>
                <p><b>Photos : </b>High resolution sRGB 300dpi JPEG</p>
                <p><b>Logos and Signatures : </b>High resolution vector PNG files only. Files must have a transparent background.</p>
                <a href="#" class="download_link">DOWNLOAD REQUIREMENTS DOCUMENT</a>
            </div>
            <div class="col-sm-8 col-md-8 col-xs-12 right_side border_left">
                <div class="padding_left_right">
                    <span>Select photo orientation</span>
                    <form>
                        <div class="form-group">
                            <label class="radio-inline">
                                <input type="radio" @click="imageType='vertical'" name="optradio" checked="true"> Vertical
                            </label>
                            <label class="radio-inline">
                                <input type="radio" @click="imageType='horizontal'" name="optradio"> Horizontal
                            </label>
                            <label class="radio-inline">
                                <input type="radio" @click="imageType='logo'" name="optradio"> Logo
                            </label>
                            <label class="radio-inline">
                                <input type="radio" @click="imageType='signature'" name="optradio"> Signature
                            </label>
                            <label class="radio-inline">
                                <input type="radio" @click="imageType='others'" name="optradio"> Others
                            </label>
                        </div>
                        <div class="form-group" v-if="imageType!==''">
                            <input type="file" v-on:change="onImageChange" name="image" id="fileName" class="file_select"  v-validate="'ext:jpeg,jpg,png,gif'">
                            <span v-show="errors.has('image')" class="color-red">{{ errors.first('image') }}</span>
                        </div>
                        <div class="form-group">
                            <div v-if="libraryImages.length > 0" v-for="(lib, index) in libraryImages" :key="index">

                                 <!-- For Vertical -->
                                <div class="col-sm-3 col-md-3 col-xs-6"  v-if="lib.image_type === 'vertical' && lib.image_type === imageType">
                                    <div class="inner_img">
                                        <img :src="lib.image" alt="" title="">
                                    </div>
                                    <button @click="deleteImage(lib.id, index)" class="btn btn-danger delete_btn" type="button">X</button>
                                </div>
                                <!-- For Horizontal -->
                                <div class="col-sm-3 col-md-3 col-xs-6"  v-if="lib.image_type === 'horizontal' && lib.image_type === imageType">
                                    <div class="inner_img">
                                        <img :src="lib.image" alt="" title="">
                                    </div>
                                    <button @click="deleteImage(lib.id, index)" class="btn btn-danger delete_btn" type="button">X</button>
                                </div>

                                <!-- for Logo -->
                                <div class="col-sm-3 col-md-3 col-xs-6 logo_hight"  v-if="lib.image_type === 'logo' && lib.image_type === imageType">
                                    <div class="inner_img">
                                        <img :src="lib.image" alt="" title="">
                                    </div>
                                    <button @click="deleteImage(lib.id, index)" class="btn btn-danger delete_btn" type="button">X</button>
                                </div>
                                <!-- For Signature -->
                                <div class="col-sm-3 col-md-3 col-xs-6 logo_hight"  v-if="lib.image_type === 'signature' && lib.image_type === imageType">
                                    <div class="inner_img">
                                        <img :src="lib.image" alt="" title="">
                                    </div>
                                    <button @click="deleteImage(lib.id, index)" class="btn btn-danger delete_btn" type="button">X</button>
                                </div>
                                <!-- For Others -->
                                <div class="col-sm-3 col-md-3 col-xs-6"  v-if="lib.image_type === 'others' && lib.image_type === imageType">
                                    <div class="inner_img">
                                        <img :src="lib.image" alt="" title="">
                                    </div>
                                    <button @click="deleteImage(lib.id, index)" class="btn btn-danger delete_btn" type="button">X</button>
                                </div>
                               
                            </div>
                            <!-- <div class="col-sm-3 col-md-3 col-xs-6">
                                <div class="inner_img">
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-xs-6">
                                <div class="inner_img">
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-xs-6">
                                <div class="inner_img">
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-xs-6">
                                <div class="inner_img">
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-xs-6">
                                <div class="inner_img">
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-xs-6">
                                <div class="inner_img">
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-xs-6">
                                <div class="inner_img">
                                </div>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <!-- <input type="submit" name=""  value="Save" class="green_btn submit_btn"> -->
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { mapState, mapMutations, mapActions } from 'vuex';  
export default {
    data () {
        return {
            libraryImages: [],
            imageType: 'vertical',
            image: '',
        }
    },
    mounted () {
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
    methods: {
         ...mapActions([
            'EMPTY_INSIDE_BACKCOVER',
        ]),
        ...mapMutations([
            'SET_ACTIVE_CLASS',
            'PUSH_IN_INSIDE_FRONT_COVER',
            'EMPTY_MESSAGE_LIST',
            'PUSH_MESSAGE',
            'PUSH_ERROR_MESSAGE',
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
            // console.log(imageData, 'post')
            this.EMPTY_MESSAGE_LIST()
            axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
            axios.post('api/myLibrary',{
                image: imageData,
                imageType: this.imageType,
            })
            .then(response => {                
                this.libraryImages.push(response.data.data)
                this.PUSH_MESSAGE('Image Uploaded!')
                document.getElementById('fileName').value = "";
            })
            .catch(errorResponse => {
                this.$store.state.errorMessage.push({message: errorResponse.response.data.message})
            })
        },
        deleteImage (imageId, index) {
            this.EMPTY_MESSAGE_LIST()
            var result = confirm("Are you sure you want to delete?");
            if (result) {
            //Logic to delete the item
                axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
                axios.delete('api/myLibrary/' +imageId)
                .then(response => {                
                    this.libraryImages.splice(index, 1);
                    
                    this.PUSH_MESSAGE('Image Deleted!')
                })
                .catch(errorResponse => {
                    this.PUSH_ERROR_MESSAGE('Internal server error')
                })
            }
        }
    }
}
</script>
