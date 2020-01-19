<template>
    <div class="columns">
        <div class="column">
            <span class="asset_title">{{card.word.word}}</span>
        </div>
        <div class="column">
            <p v-if="card.translate" class="is-pulled-left has-text-dark">{{card.translate.value}}</p>
            <span v-if="card.word.variants > 1" class="is-pulled-right has-text-light">({{card.word.variants}})</span>
        </div>
        <div class="column">
            <audio ref="audio" :src="card.word.audio" preload="auto"></audio>
            <a :class="['button', 'is-small', {'danger': !card.word.audio}]" @click="play">
                <span class="icon">
                      <i class="fa fa-volume-up"></i>
                </span>
            </a>
            <a :class="['button', 'is-small']" @click="showSettingsModal">
                <span class="icon">
                      <i class="fa fa-pencil"></i>
                </span>
            </a>
            <a :class="['button', 'is-danger', 'is-small']" @click="$emit('remove', {card:card, index:index})">
                <span class="icon">
                      <i class="fa fa-trash-o"></i>
                </span>
            </a>
        </div>
        <modal :visible="settingsModal" :card="card" :index="index" @close="closeSettingsModal"></modal>
    </div>
</template>

<script>
    import Modal from './Modal.vue'

    export default{
        props: ['card', 'index'],
        components: {
            Modal
        },
        data () {
            return {
                settingsModal: false
            }
        },
        methods: {
            showSettingsModal () {
                this.settingsModal = true
            },
            closeSettingsModal () {
                this.settingsModal = false
            },
            play () {
                this.$refs.audio.play()
            }
        }
    }
</script>
