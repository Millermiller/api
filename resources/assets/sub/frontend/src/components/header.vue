<template>
    <div :class="['navbar', 'navbar-static-top', 'navbar-fixed-left']" role="navigation" ref="menu">
        <a id="left-menu" @click="showLeftMenu">
            <button :class="['navbar-toggle', 'collapsed']">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </a>
        <el-menu :class="['el-menu-demo', 'main-menu', 'hidden-xs-only']" mode="horizontal" >
            <router-link tag="li" :class="['el-menu-item', 'home']" to="/" exact>
                <i class="menu-icon icon ion-ios-home-outline"></i>
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
                    <div class="avatar" :style="{background: avatar}"></div>
                </div>
                <span>{{username}}</span>
            </li>
            <li class="el-menu-item pull-right">
                <el-select v-model="url" @change="gotosite" size="small" >
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

<script type="text/babel">

    import auth from '../auth'

    export default{
        name: 'Header',
        data(){
            return{
                offset: 30,
                width: 40,
                sites: [{
                    value: 'https://icelandic.scandinaver.org',
                    flag: '/img/flag_left_is.png',
                    label: 'Исландский'
                },{
                    value: 'https://swedish.scandinaver.org',
                    flag: '/img/flag_left_sw.png',
                    label: 'Шведский'
                },{
                    value: 'https://norvegian.scandinaver.org',
                    flag: '/img/flag_left_no.png',
                    label: 'Норвежский'
                },{
                    value: 'https://finnish.scandinaver.org',
                    flag: '/img/flag_left_fi.png',
                    label: 'Финский'
                }],
                url: {
                    value: 'https://icelandic.scandinaver.org',
                    title: 'Исландский',
                    label: 'Beijing'
                }
            }
        },
        methods: {
            showLeftMenu(){
                this.$root.$emit('show')
            },
            logout(){
                auth.logout(this)
            },
            gotosite(){
               window.location = this.url.value
            },
            setUnderline(target){
                let clickedElement = target;
                this.offset = clickedElement.getBoundingClientRect().left
                this.width = clickedElement.getBoundingClientRect().width
            },
            onClassChange(classAttrValue, target) {
                const classList = classAttrValue.split(' ');

                if (classList.includes('router-link-active')) {
                    this.setUnderline(target)
                }
            }
        },
        computed: {
            avatar(){
                return 'url(' + this.$store.getters.avatar + ')  no-repeat scroll center / cover'
            },
            username(){
                return this.$store.getters.login
            }
        },
        mounted() {
            this.observer = new MutationObserver(mutations => {
                for (const m of mutations) {
                    const newValue = m.target.getAttribute(m.attributeName);
                    this.$nextTick(() => {
                        this.onClassChange(newValue, m.target);
                    });
                }
            });

            this.observer.observe(this.$refs.menu, {
                attributeFilter: ['class'],
                subtree: true,
            });
        },
    }
</script>