<template>
    <div class="tile is-parent">
        <article class="tile is-child box">
            <div v-if="loading" id="nprogress">
                <div class="spinner-icon"></div>
            </div>
            <p class="title">{{words}}</p>
            <p class="subtitle">Слов</p>
        </article>
    </div>
</template>

<script>
    export default {
        name: "words",
        data(){
            return{
                count: 0,
                loading: false
            }
        },
        mounted () {
            this.loading = true
            this.$http.get('/admin/wordscount').then((response) => {
                this.count = response.body
                this.loading = false
            }, (response) => {
                console.log(response)
            })
        }
    }
</script>

<style scoped>

</style>
