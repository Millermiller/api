<template>
    <div class="tile is-parent">
        <article class="tile is-child box">
            <div v-if="loading" id="nprogress">
                <div class="spinner-icon"></div>
            </div>
            <p class="title">{{audiofiles}}</p>
            <p class="subtitle">Аудиозаписей</p>
        </article>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

@Component({
  name: 'Audio',
})
export default class extends Vue {

}
</script>
