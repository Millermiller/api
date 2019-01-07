<template>
    <div class="slide">
        <p class="word">{{item.word}}</p>

        <template v-if="!item.nocontrols">

            <div :class="['translate-area', 'pointer']"  @click="showTranslate">
                <template v-if="show">
                    <p class="slide-value">{{item.value}}</p>
                    <div class="example-area">
                        <template v-for="example in item.examples">
                            <p v-html="example.text" class="example-text"></p>
                            <p v-html="example.value" class="example-value"></p>
                        </template>
                    </div>
                    <p v-if="item.creator" :class="['danger', 'text-right', 'small', 'creator']">
                        Добавлено: {{item.login}}
                    </p>
                </template>
                <i v-else class="ion-help"></i>
            </div>

            <audio :src="item.audio" preload="none" ref="player"></audio>

            <i :class="['ion favourite-button pointer', item.favourite ? activeClass : defaultClass]" @click="favourite"></i>

            <i :class="['ion-ios-volume-high', 'ion', 'pointer']"  @click="play"></i>
        </template>
    </div>
</template>

<script>
    export default{
        props:['item'],

        data(){
            return{
                activeClass: 'ion-ios-star',
                defaultClass: 'ion-ios-star-outline',
                show: false
            }
        },
        watch: {
            $route() {
              this.show = false
            }
        },
        methods:{
            showTranslate(){
                this.show = (!this.show)
            },
            play(){
                this.$refs.player.play()
            },
            favourite(){
                let self = this
                if(!this.item.favourite) {
                    this.$http.post('/favourite', {'word_id': this.item.id, 'translate_id': this.item.translate_id})
                        .then(
                            response =>{
                                if(response.body.success){
                                    self.item.favourite = true
                                    self.$notify.success({
                                        title: self.item.word,
                                        message: 'Добавлено в Избранное',
                                        duration: 2000
                                    });
                                    this.$store.commit('addCardToFavorite', response.body.card)
                                }
                                else{
                                    console.log(response.body)
                                }
                            },
                            error => {
                                console.log(error)
                            });

                }
                else{
                    this.$http.delete('/favourite/' + this.item.id)
                        .then(
                            response =>{
                                if(response.body.success){
                                    self.item.favourite = false
                                    self.$notify.success({
                                        title: self.item.word,
                                        message: 'Удалено из Избранного',
                                        duration: 2000
                                    });
                                    this.$store.dispatch('findAndRemoveFavorite', {key: 'word_id', value: this.item.id})
                                }
                                else{
                                    console.log(response.body)
                                }
                            },
                            error => {
                                console.log(error)
                            });
                }
            }
        }
    }
</script>