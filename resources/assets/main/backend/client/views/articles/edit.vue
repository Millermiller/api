<template>
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">

                <b-field label="Название">
                    <b-input v-model="post.title"></b-input>
                </b-field>

                <b-field label="Анонс">
                    <b-input v-model="post.anonse" type="textarea"></b-input>
                </b-field>

                <froala :tag="'textarea'" :config="config" v-model="post.content"></froala>

                <b-field label="Категория">
                    <b-select placeholder="Выберите категорию" v-model="post.category_id">
                        <option
                                v-for="category in categories"
                                :value="category.id"
                                :key="category.id">
                            {{ category.name }}
                        </option>
                    </b-select>
                </b-field>

                <div class="field">
                    <b-checkbox v-model="post.comment_status"
                                true-value="1"
                                false-value="0"> разрешить комментирование</b-checkbox>
                </div>

                <div class="field">
                    <b-checkbox v-model="post.status"
                                true-value="1"
                                false-value="0"> опубликован</b-checkbox>
                </div>

                <b-field label="seotitle">
                    <b-input v-model="post.seotitle"></b-input>
                </b-field>

                <b-field label="Анонс">
                    <b-input v-model="post.seodescription" type="textarea"></b-input>
                </b-field>

                <b-field label="keywords">
                    <b-input v-model="post.keywords" type="textarea"></b-input>
                </b-field>

                <p class="control">
                    <button class="button  is-success" @click="save()">Сохранить</button>
                    <button class="button  is-light" @click="back()">Назад</button>
                </p>
            </div>
        </div>
    </div>
</template>

<script>


    export default{
        data(){
            return {
                post: {
                    id: '',
                    category_id: '',
                    content: ''
                },
                config: {
                    imageUploadURL: '/admin/articles/upload',
                    events: {
                        'froalaEditor.initialized': function () {
                            console.log('initialized')
                        }
                    },
                },
                id: 0,
                meta_id: 0,
                categories: [],
                seotitle: '',
                seodescription: '',
                keywords: '',
            }
        },
        methods: {
            load(id){
                this.$http.get('/admin/articles/'+id).then((response) => {
                    this.post = response.body
                }, (response) => {
                    console.log(response)
                })
            },
            save(){
                if(this.post.content === ''){
                    this.$snackbar.open('Введите текст')
                    return false;
                }
                if(this.post.title === ''){
                    this.$snackbar.open('Введите название')
                    return false;
                }

                this.$http.put('/admin/articles/' + this.post.id, this.post).then((response) => {
                    console.log(response)
                    if(response.status === 200)
                        this.$router.go(-1)
                    else
                        this.$snackbar.open('Ошибка!')
                }, (response) => {
                    console.log(response)
                })
            },
            back(){
                this.$router.go(-1)
            },
            onEditorChange({ editor, html, text }) {
                console.log({ editor, html, text })
                this.post.content = html
            }
        },

        mounted() {
            this.load(this.$route.params.id)

            this.$http.get('/admin/categories').then((response) => {
                this.categories = response.body
            }, (response) => {
                console.log(response)
            })
        }
    }
</script>