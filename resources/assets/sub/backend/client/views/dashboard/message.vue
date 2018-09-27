<template>
    <li class="columns">
        <p :class="['column', 'is-3', 'is-small']">{{item.name}}</p>

        <span v-if="item.readed" class="tag is-success  is-3" @click="openModalBasic">прочитано</span>
        <span v-if="!item.readed" class="tag is-success  is-3" @click="openModalBasic">не прочитано</span>

        <p :class="['column']">{{item.subject}}</p>
        <p :class="['column']">{{item.created_at}}</p>
        <a class="delete" @click="$emit('deleteMessage', item.id)"></a>
        <modal :visible="showModal" :item="item" @close="closeModalBasic"></modal>
    </li>
</template>

<script>
    import Modal from './modals/Modal'

    export default{
        props: ['item'],
        components: {
            Modal
        },
        data () {
            return {
                showModal: false,
                cardModal: null,
                imageModal: null
            }
        },
        methods: {
            openModalBasic () {
                console.log('show')
                this.showModal = true
            },
            closeModalBasic () {
                console.log('close')
                this.showModal = false
            }
        }
    }
</script>
