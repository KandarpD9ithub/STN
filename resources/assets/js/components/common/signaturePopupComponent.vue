<template>
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Choose Signature</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div v-if="libraryImages.length > 0" v-for="(lib, index) in libraryImages" :key="index">
                    <div class="col-sm-3 col-md-3 col-xs-6" v-if="lib.image_type === 'signature'">
                        <div class="inner_img">
                            <img :src="lib.image" alt="" title="" @click="$parent.changeSignaure(lib.image, lib.id)"  class="btn btn-default" data-dismiss="modal">
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="modal-footer">
            <!-- <input type="file" v-on:change="onImageChange" name="" id="" class="file_select"> -->
            <input v-validate="'ext:jpg,jpeg,gif,png'" data-vv-as="image" name="image_field" type="file" v-on:change="onImageChange" id="fileName">
            <span v-show="errors.has('image_field')" class="color-red">{{ errors.first('image_field') }}</span>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex';
export default {
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
        uploadImage(imageData){
            // upload image to database and folder
            axios.defaults.headers.common['Authorization'] = this.$session.get('accessToken')
            axios.post('api/myLibrary',{
                image: imageData,
                imageType: 'signature',
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
    }
}
</script>

<style>

</style>
