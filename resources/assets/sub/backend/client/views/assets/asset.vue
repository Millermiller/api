<template>
    <li class="columns">
        <p :class="['column', 'is-7', {'info': item.id == activeAssetId}]">
            {{item.level}}. {{item.title}} <span class="text-success">({{item.cards_count}})</span>
        </p>

        <p :class="['column control-block', 'is-5']">
            <a :class="['button', 'is-small']" @click="$emit('edit', item)">
                <span class="icon">
                      <i class="fa fa-pencil"></i>
                </span>
            </a>

            <a :class="['button', 'is-small']" @click="load(item.id)">
                <span class="icon">
                      <i class="fa fa-eye"></i>
                </span>
            </a>

            <a :class="['button', 'is-small', {'is-loading': loaded }]" @click="forvo(item.id)">Forvo</a>

            <a :class="['button', 'is-danger', 'is-small']" @click="$emit('remove', item)">
                <span class="icon">
                      <i class="fa fa-trash-o"></i>
                </span>
            </a>
        </p>
    </li>
</template>

<style>
    p.column.control-block {
        padding: .75rem 0;
    }
</style>

<script>
    export default{
        props: ['item'],
        data () {
            return {
                loaded: false,
            }
        },
        methods: {
            load (id) {
                this.loaded = true
                this.$http.get('/admin/asset/' + id).then((response) => {
                    if (response.body.success) {
                        this.loaded = false
                        this.$store.commit('setActiveAsset', response.body.data)
                    } else {
                        this.$snackbar.open('Ошибка!')
                    }
                }, (response) => {
                    console.log(response)
                })
            },
            forvo (id) {
                if (!confirm('Загрузить аудио?')) return false

                this.loaded = true
                this.$http.post('/admin/forvo/' + id).then((response) => {
                    if (response.body.success) {
                        this.loaded = false
                        this.$snackbar.open('Завершено!' +  response.body.count + ' из ' + response.body.all)
                    } else {
                        this.$snackbar.open('Ошибка!')
                    }
                }, (response) => {
                    console.log(response)
                })
            },
        },
        computed: {
            activeAssetId () {
                return this.$store.getters.activeAssetId
            }
        }
    }
</script>
