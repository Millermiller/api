<template>
    <el-col :span="8" :xs="24" id="cardsblock" v-loading.body="loading">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <span class="h3" style="line-height: 38px;">Карточки в словаре</span>
                <el-tag v-if="name" type="info">{{name}}</el-tag>
            </div>
            <section data-scrollbar  style="height: 65vh;" v-loading.body="loadingbody">
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
        data(){
            return{
                loadingbody: false
            }
        },
        components: {
            'card': Card
        },
        created() {
            this.$eventHub.$on('deleteCardFromAsset', this.removeCard);
        },
        methods: {
            removeCard(data){
                this.loadingbody = true
                this.$http.delete('/card/' + data.card.id).then(
                    (response) => {
                        if(response.status === 204){
                            this.$notify.success({
                                title: 'Карточка удалена',
                                message: data.card.word.word,
                                duration: 4000
                            });
                            this.cards.splice(data.index, 1)
                            this.$store.commit('removeCard', data.card)
                            this.loadingbody = false
                        }
                    },
                    (response) => {
                        console.log(response.body)
                    }
                )
            },
        },
        beforeDestroy(){
            this.$eventHub.$off('deleteCardFromAsset');
        }
    }
</script>