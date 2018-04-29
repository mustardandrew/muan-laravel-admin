<template>

    <div class="control">

        <div class="images-wrapper">
            <div v-if="copySource" class="images-block">
                <div class="image-preview">(Now)</div>
                <img class="thumbnail" :src="copySource" alt="" height="100">
                <i class="fas fa-times image-close" title="Remove" @click="removeNowImage"></i>
            </div>
            <div v-if="copySource && imageData" class="between-images">
                &rarr;
            </div>
            <div v-if="imageData" class="images-block">
                <div class="image-preview">(New)</div>
                <img :src="imageData" height="100">
                <i class="fas fa-times image-close" title="remove" @click="removeNewImage"></i>
            </div>
        </div>

        <input type="file"
               accept="image/*"
               class="upload_field"
               :name="name"
               :id="name"
               @change="onFileSelected"
               :placeholder="title" />
        <label class="button button--dark button-upload" :for="name">
            <i class="far fa-image"></i>
            {{ title }}
            <span v-if="selectedFile" class="file-info">
                (name: {{ selectedFile.name }}, size: {{ fileSize }})
            </span>
        </label>
        <span v-if="error" class="control__help control__help--error">
            {{ error }}
        </span>
    </div>

</template>

<script>
    export default {
        props: ['source', 'name', 'title', 'removeRoute', 'error'],
        data() {
            return {
                imageData: "",
                copySource: this.source,
                selectedFile: null
            };
        },
        computed: {
            fileSize() {
                if (! this.selectedFile) {
                    return '';
                }

                return sizeForHumans(this.selectedFile.size);
            }
        },
        methods : {
            onFileSelected(event) {
                let input = event.target;
                if (input.files && input.files[0]) {
                    this.selectedFile = input.files[0];

                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageData = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            },
            async removeNowImage(event) {
                if (! this.removeRoute) {
                    return;
                }

                try {
                    let { data } = await window.axios.post(this.removeRoute);
                    this.copySource = "";
                } catch (error) {
                    console.log(error);
                }
            },
            removeNewImage(event) {
                this.imageData = "";
                this.selectedFile = null;
                document.getElementById(this.name).value = "";
            }
        }
    }
</script>
