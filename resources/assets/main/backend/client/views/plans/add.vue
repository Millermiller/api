<template>
    <div class="tile is-ancestor  box">
        <div class="tile is-parent">
            <article class="tile is-child">
                <section>
                    <b-field label="name">
                        <b-input v-model="plan.name"></b-input>
                    </b-field>
                    <b-field label="period">
                        <b-input v-model="plan.period"></b-input>
                    </b-field>
                    <b-field label="cost">
                        <b-input v-model="plan.cost"></b-input>
                    </b-field>
                    <b-field label="cost_per_month">
                        <b-input v-model="plan.cost_per_month"></b-input>
                    </b-field>
                    <p class="control">
                        <button class="button  is-success" @click="save()">Сохранить</button>
                        <button class="button  is-light" @click="back()">Назад</button>
                    </p>
                </section>
            </article>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                plan: {
                    name: '',
                    period: '',
                    cost: 0,
                    cost_per_month: 0,
                },
            }
        },
        methods:{
            back(){
                this.$router.go(-1)
            },
            save(){
                this.$http.post('/admin/plan', this.plan).then((response) => {
                    if(response.status === 201)
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