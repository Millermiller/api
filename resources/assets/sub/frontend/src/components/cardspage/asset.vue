<template>
    <el-row @click.native="loadAsset"
            v-loading.body="loading"
         :class="['list-item', 'pointer', 'open',
         {'selected': asset.selected,'muted': (!isActive && asset.title !== 'Избранное') }
         ]">

        <el-row>
            <el-col :span="22"  style="height: 57px;">
                <span v-if="edited === false" class="asset-title h4" style="height: 57px;display:inline-block">{{assetname}}</span>
                <el-input v-if="edited === true" size="small" placeholder="Название словаря" v-model="assetname"  @click.native="showResponder($event)">
                    <el-button slot="append" type="danger" icon="el-icon-close" size="mini" @click.stop="closeedit" plain/>
                    <el-button slot="append" type="success" icon="el-icon-check" size="mini" @click.stop="applyedit" plain/>
                </el-input>
                <el-button
                        v-if="asset.title !== 'Избранное' && edited === false"
                           type="default"
                           icon="el-icon-edit"
                           size="mini"
                           @click.stop="openedit"
                           :disabled="!isActive"
                           plain/>
            </el-col>

            <el-col :span="2">
                <el-button
                        v-if="asset.title !== 'Избранное'"
                           type="default"
                           icon="el-icon-delete"
                           size="mini"
                           @click.stop="confirm(asset)"
                           :disabled="!isActive"
                           plain/>
            </el-col>
        </el-row>
            <el-row>
                <el-col :span="9">
                    <span :class="['text-muted', 'small']">
                         <i :class="['ion', 'ion-speedometer', 'ion-small']"/>
                    </span>
                    <span :class="[ 'small',
                                {
                                    success: asset.result > 80,
                                    warning: (asset.result > 50 && asset.result < 80),
                                    danger: asset.result < 50
                                }
                            ]"
                    >
                    {{asset.result}}%
                </span>
                     <span :class="['text-muted', 'small']" style="padding-left: 15px;">
                     <i :class="['ion', 'ion-ios-browsers-outline', 'ion-small']"/>
                    {{asset.count}}
                </span>
                </el-col>
                <el-col :span="9">

                </el-col>
            </el-row>

    </el-row>
</template>

<script>
    export default{
        props: ['asset', 'index'],
        data(){
            return {
                edited: false,
                assetname: '',
                loading: false
            }
        },
        computed: {
            isActive(){
                return this.$store.getters.isActive
            }
        },
        methods: {
            showResponder: function(e){
                e.preventDefault()
                e.stopPropagation()
            },
            confirm(asset) {
                if(this.isActive){
                    this.$confirm('Удалить словарь?', asset.title, {
                        confirmButtonText: 'Да',
                        cancelButtonText: 'Нет',
                        type: 'warning'
                    }).then(() => {
                        this.$eventHub.$emit('removeItem', {asset: this.asset, index: this.index})
                    }).catch(() => {
                        //
                    });
                }
            },
            loadAsset(){
                if(!this.isActive){
                    return false
                }
                else {
                    this.$eventHub.$emit('assetSelect', this.asset.id);
                    this.$store.commit('showDictionary')
                    this.$store.dispatch('loadAsset', {asset: this.asset, index: this.index})
                }
            },
            openedit(){
                this.edited = true;
            },
            closeedit(){
                this.edited = false
            },
            applyedit(){
                this.loading = true
                this.$http.put('/asset/' + this.asset.id, {title: this.assetname}).then(
                    (response) => {
                        if(response.status === 200){
                            this.$store.commit('patchPersonal', {asset: response.body, index: this.index})
                            if(this.asset.selected){
                                this.$store.commit('setActivePersonalAssetName', this.assetname)
                            }

                            this.edited = false
                            this.loading = false
                        }
                    },
                    (response) => {
                        console.log(response);
                    }
                )
            }
        },
        created(){
            this.assetname = this.asset.title
        },
    }
</script>