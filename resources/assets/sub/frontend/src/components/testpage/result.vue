<template>
    <el-col :span="8" :class="['hidden-sm-and-down']">
        <el-card :class="['box-card', 'result-card']">
            <div slot="header" class="clearfix" id="infoblock">
                <el-row :gutter="20">
                    <el-col :span="8" class="diagram">
                        <el-progress type="circle" :percentage="percent" :width="100"></el-progress>
                    </el-col>
                    <el-col :span="16" class="asset-info">
                        <template v-if="asset.title">
                            <p v-if="!asset.favorite">{{asset.level}} уровень</p>
                            <p> вопросов: {{quantity}}</p>
                            <p>Лучший результат: {{result}}%</p>
                        </template>
                    </el-col>
                </el-row>
            </div>
            <section data-scrollbar style="height: 55vh; overflow: hidden" id="errorsblock">
                <transition-group name="splash" tag="div">
                    <erroritem
                            v-for="(error, index) in errors"
                            :item="error"
                            :index="index"
                            :key="error.id"
                            class="splash-item"
                            v-on:removeErrorItem="removeErrorItem"></erroritem>
                </transition-group>
            </section>
        </el-card>
    </el-col>
</template>

<script>
    import erroritem from './erroritem.vue'
    import Scrollbar from 'smooth-scrollbar';
    export default{
        data(){
            return{
                result: 0
            }
        },
        components:{
            'erroritem': erroritem
        },
        computed:{
            percent(){
                return this.$store.getters.percent
            },
            quantity(){
                return this.$store.getters.quantity
            },
            errors(){
                return this.$store.getters.errors
            },
            asset(){
                return this.$store.getters.asset
            }
        },
        watch: {
            '$route'(to, from) {
                if(this.$route.params.id)
                    this.getInfo(this.$route.params.id)
            }
        },
        methods:{
            getInfo(id){
                this.$http.get('/assetInfo/' + id).then(
                    (responce) => {
                        this.$store.commit('setAsset', responce.body)
                        this.result = responce.body.result.result
                    },

                    (error) => {
                        console.log(error)
                    }
                )
            },
            removeErrorItem(id){
                this.$store.commit('removeError', id)
            }
        },
        created: function () {
            if (this.$route.params.id > 0)
                this.getInfo(this.$route.params.id)
        },
        mounted(){
            Scrollbar.initAll({
                alwaysShowTracks: true,
                overscrollEffect: 'bounce'
            });
        }
    }
</script>