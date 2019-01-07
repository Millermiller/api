<template>
    <div :class="['list-item', 'list-item-card', 'el-row']">
        <el-col :span="20">
            <p :class="['asset_title', {'text-success' : card.exist}]">{{card.word}}</p>
        </el-col>
        <el-col :span="4">
            <i class="ion ion-ios-plus-empty pointer" @click="add"></i>
        </el-col>
        <el-col :span="24">
            <p :class="['no-margin', 'card-value', {'text-success' : card.exist}]">{{card.value}}</p>
        </el-col>
        <el-col :span="24" v-if="card.creator">
            <p :class="['no-margin', 'danger', 'text-right', 'small']" >
                Добавлено: {{card.creator}}
                <template v-if="login === card.creator">
                    <el-tooltip v-if="card.public" class="text-muted" effect="light"  placement="top-start">
                        <div slot="content">Эта карточка видна всем пользователям</div>
                        <i :class="['ion-ios-people', 'ion-small']"></i>
                    </el-tooltip>
                    <el-tooltip v-else class="text-muted" effect="light"  placement="top-start">
                        <div slot="content">Эта карточка видна только вам</div>
                        <i :class="['ion-ios-person', 'ion-small']"></i>
                    </el-tooltip>
                </template>
            </p>
        </el-col>
    </div>
</template>

<script>
    export default{
        props:['card', 'index'],
        methods:{
            add(){
                let data = {
                    word_id: this.card.id,
                    translate_id: this.card.translate_id,
                    asset_id: this.$store.getters.activeAsset,
                    index: this.index,
                }
                this.$emit('add', data)
            }
        },
        computed:{
            login(){
                return this.$store.getters.login
            }
        }
    }
</script>