<template>
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">

                <b-field label="Название">
                    <b-input v-model="post.url"></b-input>
                </b-field>

                <b-field label="Название">
                    <b-input v-model="post.title"></b-input>
                </b-field>

                <b-field label="Анонс">
                    <b-input v-model="post.description" type="textarea"></b-input>
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
                page: {
                    url: '',
                    title: '',
                    description: '',
                    keywords: '',
                },
            }
        },
        methods: {
            save(){
                this.$http.post('/admin/meta/' + this.post.id, this.post).then((response) => {
                    if(response.status === 201)
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
        },
    }
</script>