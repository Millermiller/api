<template lang="pug">
  el-col#accountblock.hidden-xs-only(:md=6 :sm=8)
    el-card.box-card.account-card(shadow='hover')
      .avatar-wrapper-big
        img.avatar-small(:src='user.avatar')
      p.text-center {{user.login}}
      p.text-center {{user.email}}
      p(:class='color(plan.id)') {{plan.name}}
      p.text-center(
        v-if="plan.name !== 'Basic'") активен до: {{active_to}}
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

  @Component({
    name: 'Account',
  })
export default class extends Vue {
    color = (value: number): string => {
      if (value === 1) {
        return 'text-center plan-title green-plan'
      }
      if (value === 2) {
        return 'text-center plan-title red-plan'
      }
      if (value === 3) {
        return 'text-center plan-title blue-plan'
      }
      throw new Error('Invalid value')
    }

    get user() {
      return this.$store.getters.user
    }

    get plan() {
      return this.$store.getters.plan
    }

    get active_to() {
      return this.$store.getters.active_to
    }
}
</script>
