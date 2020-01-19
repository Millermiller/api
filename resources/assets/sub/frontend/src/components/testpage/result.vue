<template>
    <el-col :span="8" :class="['hidden-sm-and-down']">
        <el-card :class="['box-card', 'result-card']">
            <div slot="header" class="clearfix" id="infoblock">
                <el-row :gutter="20">
                    <el-col :span="8" class="diagram">
                        <el-progress type="circle" :percentage="percent" :width="100"/>
                    </el-col>
                    <el-col :span="16" class="asset-info">
                        <template v-if="title">
                            <p v-if="level > 0">{{level}} уровень</p>
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
                            class="splash-item"/>
                </transition-group>
            </section>
        </el-card>
    </el-col>
</template>

<script>
    import erroritem from './erroritem.vue'
    import Scrollbar from 'smooth-scrollbar';
    export default{
        components:{
            'erroritem': erroritem
        },
        created: function () {
            this.$eventHub.$on('removeErrorItem', this.removeErrorItem);
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
            title(){
                return this.$store.getters.title
            },
            result(){
                return this.$store.getters.result
            },
            level(){
                return this.$store.getters.level
            }
        },
        methods:{
            removeErrorItem(id){
                this.$store.commit('removeError', id)
            }
        },
        mounted(){
            Scrollbar.initAll({
                alwaysShowTracks: true,
                overscrollEffect: 'bounce'
            });
        },
        beforeDestroy(){
            this.$eventHub.$off('removeErrorItem');
        }
    }
</script>