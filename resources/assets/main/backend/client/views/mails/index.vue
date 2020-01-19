<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <button class="button is-info" @click="send" >Отправить</button>
                </article>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {

            }
        },
        methods:{
            send(){
                this.$http.post('/admin/send').then((response) => {
                    if(response.body.success){
                       alert('ok')
                    }
                    else{
                        alert('fail')
                    }
                }, (response) => {
                    alert('big fail')
                })
            }
        }
    }
</script>