<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <form enctype="multipart/form-data" action="" method="post">
                        <input type="file" name="file" @change="bindFile"/>
                        <a class="button is-success" @click="upload">Загрузить</a>
                    </form>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <div class="block">
                        <div class="control is-horizontal">
                            <div class="control-label">
                                <label class="label">Добавить</label>

                            </div>
                            <div class="control is-grouped">
                                <p class="control is-expanded">
                                    <input class="input" type="text" v-model="orig" placeholder="icelandic">
                                </p>
                                <p class="control is-expanded">
                                    <input class="input" type="email" v-model="translate" placeholder="перевод">
                                </p>
                                <button class="button is-success" @click="add">Добавить</button>
                            </div>
                        </div>

                        <div class="field">
                            <b-switch v-model="issentence"
                                      true-value="1"
                                      false-value="0">
                                {{ switchStat }}
                            </b-switch>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                fileUploadFormData: new FormData(),
                orig: '',
                translate: '',
                issentence: false
            }
        },
        methods: {
            bindFile (e) {
                e.preventDefault();
                this.fileUploadFormData.append('file', e.target.files[0]);
            },
            upload () {
                this.$http.post('/admin/wordfile', this.fileUploadFormData).then((response) => {
                    if (response.body.success) {

                    }
                }, (response) => {
                    console.log(response)
                })
            },
            add () {
                this.$http.post('/admin/card',
                    {word: this.orig, translate: this.translate, issentence: this.issentence}
                ).then((response) => {
                    if (response.body.success) {
                        this.orig = this.translate = ''
                    }
                }, (response) => {
                    console.log(response)
                })
            }
        },
        computed: {
            switchStat () {
                return this.issentence ? 'Предложение' : 'Слово'
            }
        }
    }
</script>
