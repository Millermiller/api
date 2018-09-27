<template>
    <div class="columns">
        <div class="column">
            <span class="asset_title">{{item.word}}</span>
        </div>
        <div class="column">
            <span class="asset_title">{{item.value}}</span>
        </div>
        <div class="column">
            <a :class="['button', 'is-success', 'is-small']" @click="add">
                <span class="icon">
                      <i class="fa fa-plus" style="color: #fff"></i>
                </span>
            </a>
            <a :class="['button', 'is-danger', 'is-small']"   @click="$emit('remove', {item: item, index: index})">
                <span class="icon">
                      <i class="fa fa-trash-o"></i>
                </span>
            </a>
        </div>
    </div>
</template>

<script>
  export default{
    props: ['item', 'index'],

    data () {
      return {

      }
    },

    methods: {
      add(){
        let data = {
          word_id: this.item.id,
          translate_id: this.item.translate_id,
          asset_id: this.$store.getters.activeAssetId,
          index: this.index,
        }
        this.$http.post('/card', data).then(
          (response) => {
            if(response.body.success){
              this.$store.commit('addCard', response.body.card)
                this.$emit('increment', this.index)
            }
          },
          (response) => {

          }
        )
      }
    }
  }
</script>