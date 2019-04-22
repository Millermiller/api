<template>
    <div :class="['list-item', 'list-item-card', 'el-row']">
        <el-col :span="22">
            <p>{{card.word.word}}</p>
        </el-col>
        <el-col :span="2">
            <el-button
                       type="default"
                       icon="el-icon-delete"
                       size="mini"
                       @click.stop="$emit('remove', {card:card, index:index})"
                       plain></el-button>
        </el-col>
        <el-col :span="24">
            <p :class="['no-margin', 'card-value']" >{{card.translate.value}}</p>
        </el-col>
        <el-col :span="24" v-if="card.word.creator">
            <p :class="['no-margin', 'danger', 'text-right', 'small']" >Добавлено: {{card.word.login}}</p>
        </el-col>
    </div>
</template>

<script>
    export default{
        props:['card', 'index']
    }
</script>