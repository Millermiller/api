<template>
    <el-col :lg="{span: 12, offset: 2}" :xs="{span: 24, offset: 0}">
        <el-card v-loading.body="loading" id="slider-intro">
            <swiper :options="swiperOption" ref="mySwiperA">

                <swiper-slide v-for="(card, index) in cards" :key="index">
                    <slide :item="card"></slide>
                </swiper-slide>
                <div class="swiper-pagination" slot="pagination"></div>
                <div class="swiper-button-prev" slot="button-prev"></div>
                <div class="swiper-button-next" slot="button-next"></div>
            </swiper>
        </el-card>
    </el-col>
</template>

<script type="text/babel">

    import slide from './slide.vue'

    export default{
        metaInfo () {
            return {
                title: this.title ? 'Обучение | ' + this.title : 'Обучение',
            }
        },
        data(){
            return {
                title: '',
                cards: [],
                swiperOption: {
                    pagination: {
                        el: '.swiper-pagination',
                        type: 'progressbar'
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                  //  nextButton: '.swiper-button-next',
                  //  prevButton: '.swiper-button-prev',
                    spaceBetween: 30,
                    //loop: true,
                    grabCursor: true,

                    //   effect: 'coverflow',
                   centeredSlides: true,
                    slidesPerView: 1.5,
                //    coverflow: {
                //        rotate: 0,
                //        stretch: 90,
                //        depth: 200,
                //        modifier: 1,
                //        slideShadows: false
                //    }
                },
                loading: false
            }
        },
        components: {'slide': slide},
        methods: {
            getAsset(id){
                this.loading = true;
                this.$http.get('/asset/' + id).then((response) => {
                    if(response.body.success === false){
                        this.$notify.error({
                            title: 'Ошибка',
                            message: response.body.message,
                            duration: 4000
                        });
                    }
                    else{
                        this.$store.commit('setSelection', parseInt(id))
                        this.cards = response.body.cards
                        this.$store.dispatch('setActiveAssetType', response.body.type)
                        this.swiper.slideTo(0)
                        this.loading = false
                        this.title = response.body.title
                    }
                }, (response) => {
                    console.log(response);
                });
            }
        },
        created: function () {
            if(this.$route.params.id > 0)
                this.getAsset(this.$route.params.id)
            else{
                this.cards.push({word: 'Выберите словарь', nocontrols: true})
            }
        },
        watch: {
            '$route'(to, from) {
                if(this.$route.params.id)
                    this.getAsset(this.$route.params.id)
            }
        },
        computed: {
            swiper() {
                return this.$refs.mySwiperA.swiper
            }
        },
    }
</script>
