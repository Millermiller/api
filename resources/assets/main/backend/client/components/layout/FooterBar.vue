<template>
    <footer class="footer">
        <div class="container">
            <div class="content has-text-centered">

            </div>
        </div>
    </footer>
</template>

<script>
    export default {

        data () {
            return this.$store.state.pkg
        }

    }
</script>

<style lang="scss">

    .footer {
        margin-left: 180px;

        .social a {
            border-bottom: none !important;
        }

        .fa.fa-heart {
            color: red;
        }
    }
</style>
