<template>
  <el-row @click.native="loadAsset"
          v-loading.body="loading"
          :class="['list-item', 'pointer', 'open',
         {'selected': asset.selected,'muted': (!isActive && Asset.title !== 'Избранное') }
         ]">

    <el-row>
      <el-col :span="22" style="height: 57px">
        <span v-if="edited === false" class="asset-title h4"
              style="height: 57px;display:inline-block">{{assetname}}</span>
        <el-input v-if="edited === true" size="small" placeholder="Название словаря"
                  v-model="assetname" @click.native="showResponder($event)">
          <el-button slot="append" type="danger" icon="el-icon-close" size="mini"
                     @click.stop="closeedit" plain/>
          <el-button slot="append" type="success" icon="el-icon-check" size="mini"
                     @click.stop="applyedit" plain/>
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
        <span :class="['text-muted', 'small']" style="padding-left: 15px">
                     <i :class="['ion', 'ion-ios-browsers-outline', 'ion-small']"/>
                    {{asset.count}}
                </span>
      </el-col>
      <el-col :span="9">
      </el-col>
    </el-row>
  </el-row>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'
import { IAsset } from '@/models/Asset'
import assetAPI from '@/api/assetAPI'

  @Component({
    name: 'Asset',
  })
export default class extends Vue {
    @Prop({ required: true })
    private asset!: IAsset

    @Prop({ required: true })
    private index!: number

    edited: boolean

    assetname: string

    loading: boolean

    constructor() {
      super()
      this.loading = false
      this.edited = false
      this.assetname = ''
    }

    created() {
      this.assetname = this.asset.title
    }

    showResponder = (e: any) => {
      e.preventDefault()
      e.stopPropagation()
    }

    confirm(asset: any) {
      if (this.isActive) {
        this.$confirm('Удалить словарь?', asset.title, {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }).then(() => {
          this.$eventHub.$emit('removeItem', this.asset)
        }).catch(() => {
          //
        })
      }
    }

    loadAsset(): void {
      if (this.isActive) {
        this.$eventHub.$emit('assetSelect', this.asset.id)
        this.$store.commit('showDictionary')
        this.$store.dispatch('loadAsset', { asset: this.asset, index: this.index })
      }
    }

    openedit() {
      this.edited = true
    }

    closeedit() {
      this.edited = false
    }

    applyedit() {
      this.loading = true
      assetAPI.updateAsset(this.asset, this.assetname).then(
        (response) => {
          if (response.status === 200) {
            this.$store.commit('patchPersonal', { asset: response.data, index: this.index })
            if (this.asset.selected) {
              this.$store.commit('setActivePersonalAssetName', this.assetname)
            }
            this.edited = false
            this.loading = false
          }
        },
        (response) => {
          console.log(response)
        },
      )
    }

    get isActive() {
      return this.$store.getters.isActive
    }
}
</script>
