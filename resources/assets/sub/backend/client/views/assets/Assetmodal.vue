<template>
    <b-modal :active.sync="visible" @close="close">
        <div class="box">
            <div class="translate-section">
                <p>
                    Asset id={{asset.id}} basic={{asset.basic}} type={{asset.type}} level={{asset.level}} favorite={{asset.favorite}}</p>
                <p class="control has-addons">
                    <input class="input" type="text" placeholder="text" v-model="text" :value="asset.title"
                           style="width: 490px;">
                    <a class="button is-success" @click="updateTitle">Сохранить</a>
                    <a class="button is-warning" @click="close">Отмена</a>
                </p>
            </div>
        </div>
    </b-modal>
</template>

<script>
    export default {
        data () {
            return {
                fileUploadFormData: new FormData(),
                text: '',
                values: []
            }
        },
        props: ['visible', 'asset'],
        methods: {
            bindFile (e) {
                e.preventDefault();
                this.fileUploadFormData.append('audiofile', e.target.files[0]);
                this.fileUploadFormData.append('id', this.card.word.id);
            },
            close () {
                this.$emit('close')
            },
            updateTitle () {
                this.$http.post('/admin/asset/' + this.asset.id, {text: this.text}).then((response) => {
                    if (response.body.success) {
                        this.$emit('change')
                        this.$snackbar.open('Обновлено')
                    }
                    else{
                        this.$snackbar.open('Ошибка')
                    }
                    this.close()
                }, (response) => {
                    console.log(response)
                })
            }
        },
        mounted () {
            this.text = (this.asset.title) ? this.asset.title : ''
        }
    }
</script>