<template>
    <li :class="['columns', 'log', item.type, {'today': item.hours < 10}]">
        <p :class="['column', 'is-3', 'is-small']">{{item.created_at}}</p>
        <p :class="['column']">{{item.message}}</p>
        <a class="delete" @click="$emit('deleteLog', item.id)"></a>
    </li>
</template>

<script>
    export default{
      props: ['item']
    }
</script>
