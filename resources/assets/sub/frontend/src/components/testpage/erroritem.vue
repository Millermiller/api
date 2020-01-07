<template>
    <transition name="splash">
        <el-row class="errorcard">
            <el-col :span="20">
                <el-row type="flex" align="middle">
                    <h4 class="no-margin">{{item.word.word}}</h4>
                </el-row>
                <el-row type="flex" align="bottom" class="error-translate">
                    <p>{{item.translate.value}}</p>
                </el-row>
            </el-col>
            <el-col :span="4">
                <i :class="['ion', 'ion-ios-close-empty', 'pointer']" @click="remove(index)"/>
                <i :class="['ion pointer', item.favourite ? activeClass : defaultClass]" @click="favourite"/>
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
                this.$eventHub.$emit('removeErrorItem', id);
            },
            favourite(){
                let self = this
                if (!this.item.favourite) {
                    this.$http.post('/favourite/' + this.item.word.id + '/' + this.item.translate_id)
                        .then(
                            response => {
                                if (response.status === 201) {
                                    self.item.favourite = true
                                    self.$notify.success({
                                        title: self.item.word.word,
                                        message: 'Добавлено в Избранное',
                                        duration: 2000
                                    });
                                    this.$store.commit('addCardToFavorite')
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
                    this.$http.delete('/favourite/' + this.item.word.id)
                        .then(
                            response => {
                                if (response.status === 204) {
                                    self.item.favourite = false
                                    self.$notify.success({
                                        title: self.item.word.word,
                                        message: 'Удалено из Избранного',
                                        duration: 2000
                                    });
                                    this.$store.commit('removeCardFromFavorite')
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