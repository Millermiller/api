<template>
    <el-col :span="8" :xs="24" id="assetsblock">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <el-row type="flex" justify="space-between">
                    <span class="h3">Мои словари</span>
                    <el-popover
                            placement="top-start"
                            width="200"
                            trigger="click"
                            :disabled="isActive"
                            popper-class="text-left"
                            content="Создание словарей недоступно базовым аккаунтам">
                        <el-button slot="reference" @click="add">Создать</el-button>
                    </el-popover>
                </el-row>
            </div>
            <section data-scrollbar style="height: 65vh;overflow: visible !important;" v-loading.body="loading">
                <transition-group name="splash" tag="div">
                    <asset
                            v-for="(asset, index) in assets"
                            :asset="asset"
                            :index="index"
                            :key="asset.id"/>
                </transition-group>
            </section>
        </el-card>
    </el-col>
</template>

<script>
    import Asset from './asset.vue'
    import Scrollbar from 'smooth-scrollbar'
    import Vue from "vue";
    export default{
        data(){
            return{
                loading: false
            }
        },
        created() {
            this.$eventHub.$on('removeItem', this.remove);
        },
        methods:{
            add(){
                if(this.isActive){
                    this.$prompt('Название:', 'Новый словарь', {
                        confirmButtonText: 'Создать',
                        cancelButtonText: 'Назад',
                        inputPattern: /^.+$/,
                        inputErrorMessage: 'Введите название'
                    }).then(input => {
                        this.loading = true
                        this.$store.dispatch('addPersonalAsset', input.value).then(response => {
                            this.$notify.success({
                                title: 'Словарь создан',
                                message: input.value,
                                duration: 4000
                            });
                            this.loading = false
                        }, error => {
                            this.$notify.error({
                                title: 'Ошибка',
                                duration: 4000
                            });
                        })
                    }).catch(() => {
                        //
                    });
                }
            },
            remove(data){
                this.loading = true
                Vue.http.delete('/asset/' + data.asset.id).then(
                    (response) => {
                        if(response.status === 204){
                            this.$notify.success({
                                title: 'Словарь удален',
                                message: data.asset.title,
                                duration: 4000
                            });
                        }
                        this.$store.dispatch('reloadPersonal').then(response => {this.loading = false}, error => {})
                    },
                    (response) => {
                        console.log(response.body)
                    }
                )
            }
        },
        components: {
            'asset': Asset
        },
        computed:{
            assets(){
                return this.$store.getters.personal;
            },
            isActive(){
                return this.$store.getters.isActive;
            }
        },
        mounted(){
            Scrollbar.initAll({
                alwaysShowTracks: true,
                overscrollEffect: 'bounce'
            });
        },
        beforeDestroy(){
            this.$eventHub.$off('removeItem');
        }
    }
</script>