<template>
    <div class="box">
        <article class="media">
            <div class="media-left">
                <figure class="image is-64x64">
                    <img src="http://placehold.it/128x128" alt="Image">
                </figure>
            </div>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>{{item.name}}</strong>
                        <small>№{{item.user}}</small>
                        <span>{{item.subject}}</span>
                        <br>
                        {{item.message}}
                    </p>
                </div>
            </div>
        </article>
    </div>
</template>

<script>
    export default {
        props: ['visible', 'item'],
        methods: {
            close () {
                this.$emit('close')
            }
        },
        watch: {
            visible: function (val) {
                if (val) {
                    this.$http.post('admin/message/read/' + this.item.id).then((response) => {
                        if (response.body.success) {
                            this.item.readed = true
                        } else {
                            this.$snackbar.open('Ошибка!')
                        }
                    }, (response) => {
                        console.log(response)
                    })
                }
            }
        }
    }
</script>
