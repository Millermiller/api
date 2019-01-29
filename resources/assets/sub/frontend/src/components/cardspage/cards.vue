<template>
    <el-col :span="8" :xs="24" id="cardsblock">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
               Карточки в словаре <span class="danger">{{name}}</span>
            </div>
            <section data-scrollbar  style="height: 65vh;">
                <transition-group name="cards" tag="div">
                    <card
                            v-for="(card, index) in cards"
                            :card="card"
                            :index="index"
                            :key="card.id"
                            v-on:remove="removeCard">
                    </card>
                </transition-group>
            </section>
        </el-card>
    </el-col>
</template>

<script>
    import Card from './card.vue'

    export default{
        components: {
            'card': Card
        },
        computed:{
            cards(){
                return this.$store.getters.cards
            },
            name(){
                return this.$store.getters.activeAssetName
            }
        },
        methods:{
            removeCard(data){
                this.$store.dispatch('removeCard', data)
            }
        }
    }
</script>