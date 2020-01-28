<template>
  <div :class="['navbar', 'navbar-static-top', 'navbar-fixed-left']" role="navigation" ref="menu">
    <a id="left-menu" @click="showLeftMenu">
      <button :class="['navbar-toggle', 'collapsed']">
        <span class="icon-bar"/>
        <span class="icon-bar"/>
        <span class="icon-bar"/>
      </button>
    </a>
    <el-menu :class="['el-menu-demo', 'main-menu', 'hidden-sm-and-down']" mode="horizontal">
      <router-link tag="li" :class="['el-menu-item', 'home']" to="/" exact>
        <i class="menu-icon icon ion-ios-home-outline"/>
      </router-link>
      <router-link tag="li" :class="['el-menu-item', 'learn']" to="/learn">
        Словари
      </router-link>
      <router-link tag="li" :class="['el-menu-item', 'test']" to="/test">
        Тесты
      </router-link>
      <router-link tag="li" :class="['el-menu-item', 'cards']" to="/cards">
        Мои словари
      </router-link>
      <router-link tag="li" :class="['el-menu-item', 'translates']" to="/translates">
        Тексты
      </router-link>

      <router-link tag="li" :class="['el-menu-item', 'puzzle']" to="/puzzle">
        Паззлы
      </router-link>

      <el-menu-item class="logout" index="3">
        <a @click="logout">выход</a>
      </el-menu-item>
      <li class="el-menu-item pull-right userblock">
        <div class="avatar-wrapper-small pull-left">
          <div class="avatar">
            <img :class="['avatar-small']" :src="user.avatar" alt="">
          </div>
        </div>
        <span>{{user.login}}</span>
      </li>
      <li class="el-menu-item pull-right">
        <el-select v-model="url" @change="gotosite" size="small" :placeholder="(sites.length) ? sites[0].label : ''">
          <el-option
            v-for="item in sites"
            :key="item.value"
            :label="item.label"
            :value="item">
            <img style="float: left" :src="item.flag" alt="">
            <span style="float: left">{{ item.label }}</span>
          </el-option>
        </el-select>
      </li>
      <hr :style="{ left: offset + 'px', width: width + 'px'  }">
    </el-menu>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { LoginService } from '@/services/LoginService';
import { store } from '@/store';

  @Component({
    name: 'Header',
  })
export default class extends Vue {
    offset: number = 30

    width: number = 40

    private observer?: MutationObserver

    url: any = {
      value: 'https://is.scandinaver.local',
      title: 'Исландский',
    }

    showLeftMenu = (): void => {
      this.$root.$emit('show')
    }

    logout(): void {
      LoginService.logout().then((response) => {
        store.commit('setAuth', false)
        this.$router.push({ path: '/login' })
      })
    }

    gotosite = (): void => {
      window.location = this.url.value
    }

    setUnderline(target: any) {
      const clickedElement = target
      this.offset = clickedElement.getBoundingClientRect().left
      this.width = clickedElement.getBoundingClientRect().width
    }

    onClassChange(classAttrValue: any, target: Node) {
      const classList = classAttrValue.split(' ')

      if (classList.includes('router-link-active')) {
        this.setUnderline(target)
      }
    }

    get user() {
      return this.$store.getters.user
    }

    get sites() {
      return this.$store.getters.sites
    }

    mounted() {
      this.url = this.$store.getters.currentsite

      this.observer = new MutationObserver((mutations) => {
        mutations.forEach((m) => {
          // @ts-ignore
          const newValue = m.target.getAttribute(m.attributeName)
          this.$nextTick(() => {
            this.onClassChange(newValue, m.target)
          })
        })
      })
      // @ts-ignore
      this.observer.observe(this.$refs.menu, {
        attributeFilter: ['class'],
        subtree: true,
      })
    }
}
</script>
