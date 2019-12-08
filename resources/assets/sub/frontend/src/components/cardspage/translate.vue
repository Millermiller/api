<template>
    <div :class="['list-item', 'list-item-card', 'el-row']">
        <el-col :span="20">
            <p :class="['asset_title', {'text-success' : card.exist}]">{{card.word.word}}</p>
        </el-col>
        <el-col :span="4">
            <i class="ion ion-ios-plus-empty pointer" @click="add"></i>
        </el-col>
        <el-col :span="24">
            <p :class="['no-margin', 'card-value', {'text-success' : card.exist}]">{{card.value}}</p>
        </el-col>
        <el-col :span="24" v-if="card.word.creator">
                <el-popover
                        placement="top-start"
                        width="250"
                        trigger="hover">
                    <el-row>
                        <el-col :span="6">
                            <div class="avatar-wrapper-small pull-left">
                                <div class="avatar">
                                    <img :class="['avatar-small']" :src="card.word.user.avatar" alt="">
                                </div>
                            </div>
                        </el-col>
                        <el-col :span="18">
                            <p :class="['text-danger']" >{{card.word.user.login}}</p>
                            <p>Создано карточек: {{card.word.user.cardsCreated}}</p>
                        </el-col>
                    </el-row>
                    <span slot="reference" :class="['no-margin', 'danger', 'pull-right', 'small']" >Добавлено: {{card.word.user.login}}</span>
                </el-popover>
                <template v-if="user.id === card.word.user.id">
                    <el-tooltip v-if="card.word.is_public" class="text-muted" effect="light"  placement="top-start">
                        <div slot="content">Эта карточка видна всем пользователям</div>
                        <i :class="['ion-ios-people', 'ion-small']"/>
                    </el-tooltip>
                    <el-tooltip v-else class="text-muted" effect="light"  placement="top-start">
                        <div slot="content">Эта карточка видна только вам</div>
                        <i :class="['ion-ios-person', 'ion-small']"/>
                    </el-tooltip>
                </template>
        </el-col>
    </div>
</template>

<script>
    export default{
        props:['card', 'index'],
        methods:{
            add(){
                let data = {
                    word_id: this.card.word.id,
                    translate_id: this.card.id,
                    asset_id: this.$store.getters.activeAsset,
                    index: this.index,
                }
                this.$eventHub.$emit('addCardToAsset', data)
            }
        },
        computed:{
            user(){
                return this.$store.getters.user
            }
        }
    }
</script>