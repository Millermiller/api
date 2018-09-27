<template>
    <li class="columns">
        <p :class="['column', 'is-7', {'info': item.id == activeAssetId}]">
            {{item.level}}. {{item.title}} <span class="text-success">({{item.cards_count}})</span>
        </p>

        <p :class="['column control-block', 'is-5']">
            <a :class="['button', 'is-small']" @click="showSettingsModal">
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
        <modal :visible="settingsModal" :asset="item" @change="$emit('change')" @close="closeSettingsModal"></modal>
    </li>
</template>

<style>
    p.column.control-block {
        padding: .75rem 0;
    }
</style>

<script>
    import Modal from './Assetmodal.vue'

    export default{
        props: ['item'],
        data () {
            return {
                loaded: false,
                settingsModal: false
            }
        },
        components: {
            Modal
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
            showSettingsModal () {
                this.settingsModal = true
            },
            closeSettingsModal () {
                this.settingsModal = false
            },
        },
        computed: {
            activeAssetId () {
                return this.$store.getters.activeAssetId
            }
        }
    }
</script>
