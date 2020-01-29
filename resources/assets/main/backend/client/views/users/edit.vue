<template>
    <div class="tile is-ancestor  box">
        <div class="tile is-parent is-4 ">
            <article class="tile is-child ">
                <b-datepicker v-model="date" inline></b-datepicker>
                <button class="button  is-success" @click="save()">Сохранить</button>
                <button class="button  is-light" @click="back()">Назад</button>
            </article>
        </div>
        <div class="tile is-parent">
            <article class="tile is-child">
                <section>
                    <b-field label="Login">
                        <b-input v-model="user.login"></b-input>
                    </b-field>
                    <b-field label="E-mail">
                        <b-input v-model="user.email"></b-input>
                    </b-field>
                    <b-field label="Name">
                        <b-input v-model="user.name"></b-input>
                    </b-field>
                </section>
            </article>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                user: {
                    login: '',
                    email: '',
                    name: '',
                },
                date :new Date()
            }
        },
        mounted(){
            this.load(this.$route.params.id)
        },
        methods:{
            load(id){
                this.$http.get('/admin/users/'+id).then((response) => {
                    this.user = response.body
                    this.date = new Date(this.user.active_to)
                }, (response) => {
                    console.log(response)
                })
            },
            back(){
                this.$router.go(-1)
            },
            save(){
                this.user.active_to = this.date.toDateString()
                this.$http.put('/admin/users/'+this.user.id, this.user).then((response) => {
                    console.log(response)
                    if(response.status === 200)
                        this.$router.go(-1)
                    else
                        this.$snackbar.open('Ошибка!')
                }, (response) => {
                    console.log(response)
                })
            }
        }
    }
</script>