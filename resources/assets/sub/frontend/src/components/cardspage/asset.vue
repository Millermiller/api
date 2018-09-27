<template>
    <el-row @click.native="loadAsset"
         :class="['list-item', 'pointer', 'open',
         {'selected': asset.selected,'muted': (!isActive && asset.title != 'Избранное') }
         ]">
        <div>
            <el-col :span="20">
                <p class="asset-title" style="height: 57px;">{{asset.title}}</p>
            </el-col>

            <el-col :span="4">
                <i v-if="asset.title != 'Избранное'" class="ion ion-ios-close-empty pointer"
                   @click="confirm(asset)"></i>
            </el-col>

            <el-row>
                <el-col :span="9">
                    <span :class="['text-muted', 'small']">
                         <i :class="['ion', 'ion-speedometer', 'ion-small']"></i>
                    </span>
                    <span
                            :class="[
                  'small',
                    {
                      success: asset.result.result > 80,
                      warning: (asset.result.result > 50 && asset.result.result < 80),
                      danger: asset.result.result < 50
                    }
                ]">
                    {{asset.result.result}}%
                </span>
                     <span :class="['text-muted', 'small']" style="padding-left: 15px;">
                     <i :class="['ion', 'ion-ios-browsers-outline', 'ion-small']"></i>
                    {{asset.cards.length}}
                </span>
                </el-col>
                <el-col :span="9">

                </el-col>
            </el-row>
        </div>
    </el-row>
</template>

<script>
    export default{
        props: ['asset', 'index'],
        data(){
            return {}
        },
        computed: {
            isActive(){
                return this.$store.getters.isActive
            }
        },
        methods: {
            confirm(asset) {
                if (!this.isActive) {
                    this.$emit('modal')
                }
                else {
                    this.$confirm('Удалить словарь?', asset.title, {
                        confirmButtonText: 'Да',
                        cancelButtonText: 'Нет',
                        type: 'warning'
                    }).then(() => {
                        this.$emit('removeItem', {asset: this.asset, index: this.index})
                    }).catch(() => {
                        //
                    });
                }
            },
            loadAsset(){
                if (!this.isActive) {
                    return false
                }
                else {
                    this.$store.commit('showDictionary')
                    this.$store.dispatch('loadAsset', {asset: this.asset, index: this.index})
                }
            }
        },
    }
</script>