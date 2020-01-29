<template>
    <div class="box">
        <p class="control content">
            <textarea class="textarea" placeholder="Textarea" v-model="form.content"></textarea>
        </p>
        <button class="button is-success" @click="save">Сохранить</button>
        <button class="button is-warning" @click="clear">Очистить</button>
    </div>
</template>

<script>
    export default{
        props: ['item'],
        data () {
            return {
                form: {
                    content: ''
                }
            }
        },
        watch: {
            item: function (val) {
                this.form.content = val.description
            }
        },
        methods: {
            save(){
                this.$http.post('/admin/text/description/' + this.item.id, this.form).then((response) => {
                    if (response.body.success) {
                        this.$snackbar.open('Обновлено!')
                        this.$emit('reload')
                    } else {
                        this.$snackbar.open('Ошибка!')
                    }
                }, (response) => {
                    this.$snackbar.open('Ошибка!')
                })
            },
            clear(){
                this.form.content = ''
            }
        }
    }
</script>