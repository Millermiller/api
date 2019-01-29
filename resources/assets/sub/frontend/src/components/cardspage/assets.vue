<template>
    <el-col :span="8" :xs="24" id="assetsblock">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <span style="line-height: 24px;">Мои словари</span>
                <i :class="['ion', 'ion-ios-plus-empty', 'pull-right', 'pointer']" @click="add"></i>
            </div>
            <section data-scrollbar style="height: 65vh;overflow: visible !important;">
                <transition-group name="splash" tag="div">
                    <asset
                            v-for="(asset, index) in assets"
                            :asset="asset"
                            :index="index"
                            :key="asset.id"
                            v-on:removeItem="remove"
                            v-on:modal="modal"
                    ></asset>
                </transition-group>
            </section>
        </el-card>
        <el-dialog title="Использование пользовательских словарей недоступно базовым аккаунтам" :visible.sync="dialogVisible">
            <span>
                <a href="scandinaver.local" target="_blank">Оплатите подписку</a> чтобы получить полный доступ
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogVisible = false">Закрыть</el-button>
            </span>
        </el-dialog>
    </el-col>
</template>

<script>
    import Asset from './asset.vue'
    import Scrollbar from 'smooth-scrollbar'
    export default{
        data(){
            return{
                dialogVisible: false
            }
        },
        methods:{
            add(){
                if(!this.$store.getters.isActive){
                    this.dialogVisible = true
                }
                else{
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
                if(!this.$store.getters.isActive)
                    this.dialogVisible = true
                else
                    this.$store.dispatch('removePersonalAsset', data)
            },
            modal(){
                this.dialogVisible = true
            }
        },
        components: {
            'asset': Asset
        },
        computed:{
            assets(){
                return this.$store.getters.personal;
            }
        },
        mounted(){
            Scrollbar.initAll({
                alwaysShowTracks: true,
                overscrollEffect: 'bounce'
            });
        }
    }
</script>