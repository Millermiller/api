<template>
    <transition name="splash">
        <el-row class="errorcard">
            <el-col :span="20">
                <el-row type="flex" align="middle">
                    <h4 class="no-margin">{{item.word}}</h4>
                </el-row>
                <el-row type="flex" align="bottom" class="error-translate">
                    <p>{{item.value}}</p>
                </el-row>
            </el-col>
            <el-col :span="4">
                <i :class="['ion', 'ion-ios-close-empty', 'pointer']" @click="remove(index)"></i>
                <i :class="['ion pointer', item.favourite ? activeClass : defaultClass]" @click="favourite"></i>
            </el-col>
        </el-row>
    </transition>
</template>

<script>
    export default{
        props: ['item', 'index'],
        data(){
            return {
                activeClass: 'ion-ios-star',
                defaultClass: 'ion-ios-star-outline'
            }
        },
        methods: {
            remove(id){
                this.$emit('removeErrorItem', id);
            },
            favourite(){
                let self = this
                if (!this.item.favourite) {
                    this.$http.post('/favourite', {'word_id': this.item.id, 'translate_id': this.item.translate_id})
                        .then(
                            response => {
                                if (response.body.success) {
                                    self.item.favourite = true
                                    self.$notify.success({
                                        title: self.item.word,
                                        message: 'Добавлено в Избранное',
                                        duration: 2000
                                    });
                                    this.$store.commit('addCardToFavorite', response.body.card)
                                }
                                else {
                                    console.log(response.body)
                                }
                            },
                            error => {
                                console.log(error)
                            });

                }
                else {
                    this.$http.delete('/favourite/' + this.item.id)
                        .then(
                            response => {
                                if (response.body.success) {
                                    self.item.favourite = false
                                    self.$notify.success({
                                        title: self.item.word,
                                        message: 'Удалено из Избранного',
                                        duration: 2000
                                    });
                                    this.$store.dispatch('findAndRemoveFavorite', {key: 'word_id', value: this.item.id})
                                }
                                else {
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