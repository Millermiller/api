<template>
    <div :class="['list-item', 'list-item-card', 'el-row']">
        <el-col :span="20">
            <p>{{card.word.word}}</p>
        </el-col>
        <el-col :span="4">
            <i :class="['ion', 'ion-ios-close-empty', 'pointer']"
               @click="$emit('remove', {card:card, index:index})"></i>
        </el-col>
        <el-col :span="24">
            <p :class="['no-margin', 'card-value']" >{{card.translate.value}}</p>
        </el-col>
        <el-col :span="24" v-if="card.word.creator">
            <p :class="['no-margin', 'danger', 'text-right', 'small']" >Добавлено: {{card.word.creator}}</p>
        </el-col>
    </div>
</template>

<script>
    export default{
        props:['card', 'index']
    }
</script>