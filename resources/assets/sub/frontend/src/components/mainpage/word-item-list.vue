<template>
    <el-row
            :class="[
                    'list-item',
                    {
                         'open': item.active,
                         'tested': item.canopen,
                         'not-available': !item.available
                    }
           ]"
    >

        <el-col :span="24">
            <p class="asset-title">{{item.title}}</p>
            <p class="asset-description">описание</p>
        </el-col>

        <el-row>
            <el-col :span="6">
                <span :class="['small', 'text-muted']">уровень: {{item.level}}</span>
            </el-col>
            <el-col :span="9" :md="8">
                <span :class="['small', 'text-muted']">
                     <i :class="['ion', 'ion-speedometer', 'ion-small']"></i>
                </span>
                <span

                        :class="[
                  'small',
                    {
                      success: item.result > 80,
                      warning: (item.result > 50 && item.result < 80),
                      danger: item.result < 50
                    }
                ]">
                    {{item.result}}%
                </span>
                <span :class="['small', 'text-muted']" style="padding-left: 15px;">
                     <i :class="['ion', 'ion-ios-browsers-outline', 'ion-small']"></i>
                    {{item.count}}
                </span>
            </el-col>
            <el-col :span="9" :md="10">
                <template v-if="item.active">
                    <span :class="['text-primary', 'pointer', 'small']" @click="learn()">
                        <i :class="['ion', 'ion-ios-redo', 'ion-small']"></i>
                        перейти
                    </span>
                    <span :class="['text-primary', 'small']">|</span>
                    <span :class="['text-primary', 'pointer', 'small']" @click="test()">
                         <i :class="['ion', 'ion-ios-checkmark-outline', 'ion-small']"></i>
                        тест
                    </span>
                </template>
                <template v-else>
                    <span :class="['small', 'text-muted']">закрыто</span>
                </template>
            </el-col>
        </el-row>
        <i @click="showModal" class="ion-locked" v-if="!item.available"></i>
    </el-row>
</template>

<script>

    export default{
        props: ['item', 'index'],
        data(){
            return {}
        },
        methods: {
            learn: function () {
               // this.$store.commit('setSelection', {asset: this.item, index: this.index})
                this.$router.push('/learn/' + this.item.id);
            },
            test(){
               // this.$store.commit('setSelection', {asset: this.item, index: this.index})
                this.$router.push('/test/' + this.item.id);
            },
            showModal(){
                this.$emit('modal')
            }
        }
    }
</script>
