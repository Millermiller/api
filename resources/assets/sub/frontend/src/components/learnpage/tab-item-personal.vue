<template>
    <el-row :class="['list-item', 'pointer', 'open', {'selected': item.selected}]">

        <el-col :span="24">
            <p class="asset-title" style="height: 57px;">{{item.title}}</p>
        </el-col>

        <el-row>
            <el-col :span="9" :md="8">
                <span :class="['text-muted', 'small']">
                     <i :class="['ion', 'ion-speedometer', 'ion-small']"></i>
                </span>
                <span
                        :class="[
                    'small',
                    {
                      success: item.result.result > 80,
                      warning: (item.result.result > 50 && item.result.result < 80),
                      danger: item.result.result < 50
                    }
                ]">
                    {{item.result.result}}%
                </span>
                <span :class="['text-muted', 'small']" style="padding-left: 15px;">
                     <i :class="['ion', 'ion-ios-browsers-outline', 'ion-small']"></i>
                    {{item.count}}
                </span>
            </el-col>
            <el-col :span="15" :md="16" class="text-right">
                <template>
                    <span :class="[isActive ? 'text-primary' : 'text-muted', 'pointer', 'small']"
                          @click="cardspage()">
                        <i :class="['ion', 'ion-edit', 'ion-small']"/>
                        изменить
                    </span>
                    <span :class="['text-primary', 'small']">|</span>
                    <span :class="['text-primary', 'pointer', 'small', {'muted': item.count < 1}]" @click="loadTest()">
                        <i :class="['ion', 'ion-ios-redo', 'ion-small']"/>
                        учить
                    </span>
                    <span :class="['text-primary', 'small']">|</span>
                    <span :class="['text-primary', 'pointer', 'small', {'muted': item.count < 1}]" @click="test()">
                         <i :class="['ion', 'ion-ios-checkmark-outline', 'ion-small']"/>
                        тест
                    </span>
                </template>
            </el-col>
        </el-row>
    </el-row>
</template>

<script type="text/babel">
    export default{
        props:['item', 'type', 'index'],
        data(){
            return{
                words: [],
                sentences: [],
                personal: []
            }
        },
        computed: {
            isActive(){
                return this.$store.getters.isActive || this.item.type === 3
            }
        },
        methods: {
            loadTest(){
                if(this.item.count < 1){
                    return false
                }

                if( window.innerWidth <= 910){
                    this.$eventHub.$emit('closeMenu')
                }
                this.$store.commit('setSelection', {asset: this.item, index: this.index})
                this.$router.push('/learn/' + this.item.id);
            },
            cardspage(){
                if (this.isActive) {
                    this.$store.dispatch('loadAsset', {asset: this.item, index: this.index})
                    this.$store.commit('setActiveAssetEdit', true)
                    this.$router.push('/cards')
                }
            },
            test(){
                if(this.item.count < 1){
                    return false
                }

                if( window.innerWidth <= 910){
                    this.$eventHub.$emit('closeMenu')
                }
                //  this.$store.commit('setSelection', {asset: this.item, index: this.index})
                this.$router.push('/test/' + this.item.id);
            },
        }
    }
</script>
