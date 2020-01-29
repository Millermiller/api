<template>
  <el-container>
    <a id="right-menu" @click="toggleRightMenu">
      <button :class="['navbar-toggle', 'collapsed']">
        <span class="icon-bar"/>
        <span class="icon-bar"/>
        <span class="icon-bar"/>
      </button>
    </a>
    <el-main>
      <el-row :gutter="20">
        <slider/>
        <transition name="custom-classes-transition"
                    enter-active-class="animated slideInRight"
                    leave-active-class="animated slideOutRight">
          <tabs/>
        </transition>
      </el-row>
    </el-main>
    <el-dialog title="Это закрытая часть сайта" :visible.sync="dialogVisible">
                    <span>
                        <a href="scandinaver.local" target="_blank">Оплатите подписку</a> чтобы получить полный доступ
                    </span>
      <span slot="footer" class="dialog-footer">
                        <el-button @click="dialogVisible = false">Закрыть</el-button>
                    </span>
    </el-dialog>
  </el-container>
</template>

<script lang="ts">
import Vue from 'vue';
import Component from 'vue-class-component';
import Tabs from '@/components/learnpage/Tabs.vue';
import Slider from '@/components/learnpage/Slider.vue';

  @Component({
    name: 'Learn',
    components: {
      Slider,
      Tabs,
    },
  })
export default class extends Vue {
    dialogVisible: boolean = false

    visible: boolean = false

    created() {
      // this.$eventHub.$on('closeMenu', this.closeMenu);
      this.$eventHub.$on('paidModal', this.modal);
    }

    modal() {
      this.dialogVisible = true
    }

    toggleRightMenu() {
      this.visible = !this.visible;
      this.$store.dispatch('toggleMenuOpen')
      this.$store.dispatch('toggleBackdrop')
    }

    mounted() {
      this.visible = window.innerWidth > 910
    }

    beforeDestroy() {
      // this.$store.dispatch('onCardsPageClose')
      this.$eventHub.$off('closeMenu');
      this.$eventHub.$off('paidModal');
    }
}
</script>
