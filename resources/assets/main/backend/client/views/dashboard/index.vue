<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <p class="title">{{users}}</p>
                    <p class="subtitle">Пользователей</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <p class="title"></p>
                    <p class="subtitle"></p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <p class="title"></p>
                    <p class="subtitle"></p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <p class="title"></p>
                    <p class="subtitle"></p>
                </article>
            </div>
        </div>

        <div class="tile is-ancestor">
            <div class="tile is-parent is-8">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <h4 class="title">Log</h4>
                    <div class="content">
                        <ul>
                            <log v-for="item in log" :item="item" v-on:deleteLog="deleteLog"></log>
                        </ul>
                    </div>
                </article>
            </div>
            <div class="tile is-parent is-4">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <h4 class="title">Messages</h4>
                    <div class="content">
                        <ul>
                            <message v-for="item in messages" :item="item" v-on:deleteMessage="deleteMessage"></message>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
</template>

<script>
    /* eslint-disable indent */
    import Vue from 'vue'
    import message from './message.vue'
    import log from './log.vue'

    export default {
        components: {
            message,
            log
        },
        data () {
            return {
                users: 0,
                log: {},
                messages: {},
                loading: false
            }
        },
        methods: {
            deleteLog (id) {
                this.$http.delete('/admin/log/' + id).then((response) => {
                    if (response.body.success) {
                        this.log = response.body.log
                        this.$snackbar.open('Удалено!')
                    } else {
                        this.$snackbar.open('Ошибка!')
                    }
                }, (response) => {
                    console.log(response)
                })
            },
            deleteMessage (id) {
                this.$http.delete('/admin/message/' + id).then((response) => {
                    if (response.body.success) {
                        this.messages = response.body.messages
                        this.$snackbar.open('Удалено!')
                    } else {
                        this.$snackbar.open('Ошибка!')
                    }
                }, (response) => {
                    console.log(response)
                })
            }
        },
        mounted () {
            this.loading = true
            this.$http.get('/admin/dashboard').then((response) => {
                this.users = response.body.users
                this.log = response.body.log
                this.messages = response.body.messages
                this.loading = false
            }, (response) => {
                console.log(response)
            })
        }
    }
</script>
