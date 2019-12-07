<template>
    <div class="slide">
        <p class="word">{{item.word.word}}</p>

        <template v-if="!item.nocontrols">

            <div :class="['translate-area', 'pointer']"  @click="showTranslate">
                <template v-if="show">
                    <p class="slide-value">{{item.translate.value}}</p>
                    <div class="example-area">
                        <template v-for="example in item.examples">
                            <p v-html="example.text" class="example-text"></p>
                            <p v-html="example.value" class="example-value"></p>
                        </template>
                    </div>
                    <el-row v-if="item.word.creator" :class="['danger', 'text-right', 'small', 'creator']">
                        <el-popover
                                placement="top-start"
                                width="250"
                                trigger="hover">
                            <el-row>
                                <el-col :span="6">
                                    <div class="avatar-wrapper-small pull-left">
                                        <div class="avatar">
                                            <img :class="['avatar-small']" :src="item.word.user.avatar" alt="">
                                        </div>
                                    </div>
                                </el-col>
                                <el-col :span="18">
                                    <p :class="['text-danger']" >{{item.word.user.login}}</p>
                                    <p>Создано карточек: {{item.word.user.cardsCreated}}</p>
                                </el-col>
                            </el-row>
                            <span slot="reference" :class="['no-margin', 'danger', 'pull-right', 'small']" >Добавлено: {{item.word.user.login}}</span>
                        </el-popover>
                    </el-row>
                </template>
                <i v-else class="ion-help"></i>
            </div>

            <audio :src="item.word.audio" preload="none" ref="player"></audio>

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
                    this.$http.post('/favourite', {'word_id': this.item.word.id, 'translate_id': this.item.translate.id})
                        .then(
                            response =>{
                                if(response.status === 201){
                                    self.item.favourite = true
                                    self.$notify.success({
                                        title: self.item.word.word,
                                        message: 'Добавлено в Избранное',
                                        duration: 2000
                                    });
                                    this.$store.commit('addCardToFavorite')
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
                    this.$http.delete('/favourite/' + this.item.word.id)
                        .then(
                            response =>{
                                if(response.body.success){
                                    self.item.favourite = false
                                    self.$notify.success({
                                        title: self.item.word.word,
                                        message: 'Удалено из Избранного',
                                        duration: 2000
                                    });
                                    this.$store.commit('removeCardFromFavorite')
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