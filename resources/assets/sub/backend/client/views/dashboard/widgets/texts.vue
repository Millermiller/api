<template>
    <div class="tile is-parent">
        <article class="tile is-child box">
            <div v-if="loading" id="nprogress">
                <div class="spinner-icon"></div>
            </div>
            <p class="title">{{texts}}</p>
            <p class="subtitle">Текстов</p>
        </article>
    </div>
</template>

<script>
    export default {
        name: "texts"
    }
</script>

<style scoped>

</style>
