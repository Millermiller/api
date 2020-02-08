<template>
  <aside class="menu app-sidebar animated" :class="{ slideInLeft: show, slideOutLeft: !show }">
    <p class="menu-label">
      General
    </p>
    <ul class="menu-list">
      <li v-for="(item, index) in menu" :key="index">
        <router-link
          :to="item.path"
          :exact="true"
          :aria-expanded="isExpanded(item) ? 'true' : 'false'"
          :class="{'is-active':  item.name ==='Тексты' && $route.name === 'textedit'}"
          v-if="item.path"
          @click.native="toggle(index, item)">
          <span class="icon is-small"><i :class="['fa', item.meta.icon]"></i></span>
          {{ item.meta.label || item.name }}
          <span class="icon is-small is-angle" v-if="item.children && item.children.length">
            <i class="fa fa-angle-down"></i>
          </span>
        </router-link>
        <a :aria-expanded="isExpanded(item)" v-else @click="toggle(index, item)">
          <span class="icon is-small"><i :class="['fa', item.meta.icon]"></i></span>
          {{ item.meta.label || item.name }}
          <span class="icon is-small is-angle" v-if="item.children && item.children.length">
            <i class="fa fa-angle-down"></i>
          </span>
        </a>

        <expanding v-if="item.children && item.children.length">
          <ul v-show="isExpanded(item)">
            <li v-for="(subItem, index) in item.children" :key="index">
              <router-link :to="generatePath(item, subItem)">
                {{ subItem.meta && subItem.meta.label || subItem.name }}
              </router-link>
            </li>
          </ul>
        </expanding>
      </li>
    </ul>
  </aside>
</template>

<script lang="ts">
import Expanding from 'vue-bulma-expanding'
import Vue from 'vue'
import Component from 'vue-class-component'
import {Prop} from 'vue-property-decorator'

@Component({
  name: 'Sidebar',
  components: {
    Expanding
  },
})
export default class extends Vue {
  @Prop({ required: true })
  private show!: any

  private   isReady: boolean = false,


  mounted() {
    const route = this.$route
    if (route.name) {
      this.isReady = true
      this.shouldExpandMatchItem(route)
    }
  }


    isExpanded(item) {
      return item.meta.expanded
    }

    toggle(index, item) {
      this.expandMenu({
        index,
        expanded: !item.meta.expanded,
      })
    }

    shouldExpandMatchItem(route) {
      const { matched } = route
      const lastMatched = matched[matched.length - 1]
      let parent = lastMatched.parent || lastMatched
      const isParent = parent === lastMatched

      if (isParent) {
        const p = this.findParentFromMenu(route)
        if (p) {
          parent = p
        }
      }

      if ('expanded' in parent.meta && !isParent) {
        this.expandMenu({
          item: parent,
          expanded: true,
        })
      }
    }

    generatePath(item, subItem) {
      return `${item.component ? `${item.path}/` : ''}${subItem.path}`
    }

    findParentFromMenu(route) {
      const { menu } = this
      for (let i = 0, l = menu.length; i < l; i++) {
        const item = menu[i]
        const k = item.children && item.children.length
        if (k) {
          for (let j = 0; j < k; j++) {
            if (item.children[j].name === route.name) {
              return item
            }
          }
        }
      }
      return true
    }

  @Watch('$route')
  private onRouteChange(route: Route) {
    this.isReady = true
    this.shouldExpandMatchItem(route)
  }

}
</script>

<style lang="scss">
  .app-sidebar {
    position: fixed;
    top: 50px;
    left: 0;
    bottom: 0;
    padding: 20px 0 50px;
    width: 180px;
    min-width: 45px;
    max-height: 100vh;
    height: calc(100% - 50px);
    z-index: 1024 - 1;
    background: #FFF;
    box-shadow: 0 2px 3px rgba(17, 17, 17, 0.1), 0 0 0 1px rgba(17, 17, 17, 0.1);
    overflow-y: auto;
    overflow-x: hidden;

    .icon {
      vertical-align: baseline;

      &.is-angle {
        position: absolute;
        right: 10px;
        transition: transform .377s ease;
      }
    }

    .menu-label {
      padding-left: 5px;
    }

    .menu-list {
      li a {
        &[aria-expanded="true"] {
          .is-angle {
            transform: rotate(180deg);
          }
        }
      }

      li a + ul {
        margin: 0 10px 0 15px;
      }
    }

  }
</style>
