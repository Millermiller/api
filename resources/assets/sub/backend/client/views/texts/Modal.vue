<template>
    <b-modal :active.sync="visible" @close="close">
        <div class="box" style="width: 1100px">
            <div class="columns">
                <div class="column">
                    <p class="control">
                        <input class="input" type="text" v-model="form.title" placeholder="Название">
                    </p>
                </div>
            </div>
            <div class="columns">
                <div class="column is-6">
                    <p class="control content">
                        <textarea class="textarea" placeholder="оригинал" v-model="form.origtext"
                                  style="height: 500px;"></textarea>
                    </p>
                </div>
                <div class="column is-6">
                    <p class="control content">
                        <textarea class="textarea" placeholder="перевод" v-model="form.translate"
                                  style="height: 500px;"></textarea>
                    </p>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <button class="button is-succes" @click="$emit('save', form)">Сохранить</button>
                </div>
            </div>
        </div>
    </b-modal>
</template>

<script>
    export default{
        props: ['visible'],
        data(){
            return {
                form: {
                    title: '',
                    origtext: '',
                    translate: ''
                }
            }
        },

        methods: {
            close () {
                this.$emit('close')
            }
        }
    }
</script>

<style>
    .modal-card, .modal-content {
        width: 1100px;
    }
</style>