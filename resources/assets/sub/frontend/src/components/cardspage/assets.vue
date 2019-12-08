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
            <section data-scrollbar style="height: 65vh;overflow: visible !important;">
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
    export default{
        data(){
            return{}
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
                        this.$store.dispatch('addPersonalAsset', input.value)
                    }).catch(() => {
                        //
                    });
                }
            },
            remove(data){
                this.$store.dispatch('removePersonalAsset', data)
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