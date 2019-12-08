<template>
    <el-col :span="8" :xs="24" id="cardsblock" v-loading.body="loading">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <span class="h3" style="line-height: 38px;">Карточки в словаре</span>
                <el-tag v-if="name" type="info">{{name}}</el-tag>
            </div>
            <section data-scrollbar  style="height: 65vh;">
                <transition-group name="cards" tag="div">
                    <card
                            v-for="(card, index) in cards"
                            :card="card"
                            :index="index"
                            :key="card.id">
                    </card>
                </transition-group>
            </section>
        </el-card>
    </el-col>
</template>

<script>
    import Card from './card.vue'

    export default{
        props: ['name', 'cards', 'loading'],
        components: {
            'card': Card
        }
    }
</script>