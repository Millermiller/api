<div class="tile is-parent">
    <article class="tile is-child box">
        <div v-if="loading" id="nprogress">
            <div class="spinner-icon"></div>
        </div>
        <p class="title">{{assets}}</p>
        <p class="subtitle">Словарей</p>
    </article>
</div>

<script>
    export default {
        name: "assets"
    }
</script>

<style scoped>

</style>
