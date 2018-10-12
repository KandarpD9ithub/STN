<template>
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Choose Image</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div v-if="libraryImages.length > 0 && lib.image_type !== 'logo' && lib.image_type !== 'signature'" v-for="(lib, index) in libraryImages" :key="index">
                    <div class="col-sm-3 col-md-3 col-xs-6">
                        <div class="inner_img">
                            <img :src="lib.image" alt="" title="" @click="$parent.option2ImageChange(lib.image, lib.id)"  class="btn btn-default" data-dismiss="modal">
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="modal-footer">
            <input v-validate="'ext:jpg,jpeg,gif,png'" data-vv-as="image" name="image_field" type="file" v-on:change="onImageChange" class="file_select" id="fileName">
            <span v-show="errors.has('image_field')" class="color-red">{{ errors.first('image_field') }}</span>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex';
export default {
    // props: ['libraryImages'],
    data () {
        return {
            image: '',
            libraryImages: [],
        }
    },
    mounted () {
        this.fetchLogoImages()
    },
    methods: {
        ...mapMutations([
				'SET_ACTIVE_CLASS',
                'PUSH_IN_INSIDE_FRONT_COVER',
                'EMPTY_MESSAGE_LIST',
            ]),
            fetchLogoImages () {
                axios.get(this.$url + 'api/myLibrary', {
                    headers: {
                        Authorization: this.$session.get('accessToken')
                    }
                })
                .then (response => {
                    this.libraryImages = response.data.data;
                })
                .catch (errorResponse => {
                    console.log(errorResponse, 'error')
                })
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
            // empty error and success message
                this.EMPTY_MESSAGE_LIST()
            // upload image to database and folder
            axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
            axios.post('api/myLibrary',{
                image: imageData,
                imageType: 'others',
            })
            .then(response => {
                this.libraryImages.push(response.data.data)
                this.$store.state.successMessage.push({message: 'Image Uploaded!'})
                document.getElementById('fileName').value = "";
            })
            .catch(errorResponse => {
                this.$store.state.successMessage.push({message: errorResponse.response.data.message})
            })
        },
        option2Image (image, imageId) {
             this.$parent.option2ImageChange(image, imageId);
        }
    }
}
</script>

<style>

</style>
