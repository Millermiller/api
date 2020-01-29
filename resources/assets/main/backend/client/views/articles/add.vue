<template>
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <b-field label="Название">
                    <b-input v-model="post.title" required></b-input>
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
                    title:'',
                    anonse:'',
                    content:'',
                    category_id: '',
                    status:'',
                },
                config: {
                    events: {
                        'froalaEditor.initialized': function () {
                            console.log('initialized')
                        }
                    },
                },
                categories: [],
                seotitle: '',
                seodescription: '',
                keywords: '',
            }
        },
        methods: {
            save(){
                if(this.post.content === ''){
                    this.$snackbar.open('Введите текст')
                    return false;
                }
                if(this.post.title === ''){
                    this.$snackbar.open('Введите название')
                    return false;
                }

                this.$http.post('/admin/articles/' + this.post.id, this.post).then((response) => {
                    if(response.status === 201)
                        this.$router.go(-1)
                    else
                        this.$snackbar.open('Ошибка!')
                }, (response) => {
                    console.log(response)
                })
            }
        },

        mounted() {
            this.$http.get('/admin/categories').then((response) => {
                this.categories = response.body
            }, (response) => {
                console.log(response)
            })
        }
    }
</script>