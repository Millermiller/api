<template>
    <div>
        <div>
            <i v-show="! item.image" class="icon fa fa-picture-o"></i>
            <img style="width: 400px;margin: 20px;" v-show="item.image" :src="item.image">
        </div>

        <div>
            <label>
                <input @change="previewThumbnail" name="thumbnail" type="file" style="display: none">
                <span class="file-cta">
                        <span class="file-icon">
                            <i class="fa fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Выберите файл
                        </span>
                    </span>
            </label>
            <button @click="upload" class="button">upload</button>
        </div>
    </div>
</template>

<script>
    export default{
        props: ['item'],
        data(){
            return {
                imageSrc: '',
                fileUploadFormData: new FormData(),
            }
        },
        methods: {
            previewThumbnail: function (event) {
                let input = event.target;

                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    this.fileUploadFormData.append('file', input.files[0]);
                    let vm = this;

                    reader.onload = function (e) {
                        vm.item.image = e.target.result;
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            },
            upload () {
                this.$http.post('/admin/text/image/' + this.item.id, this.fileUploadFormData).then((response) => {
                    if (response.body.success) {
                        this.$snackbar.open('Обновлено!')
                    }
                    else {
                        this.$snackbar.open('Ошибка!')
                    }
                }, (response) => {
                    this.$snackbar.open('Ошибка!')
                })
            }
        }
    }
</script>