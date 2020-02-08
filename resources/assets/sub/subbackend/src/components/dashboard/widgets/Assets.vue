<div class="tile is-parent">
    <article class="tile is-child box">
        <div v-if="loading" id="nprogress">
            <div class="spinner-icon"></div>
        </div>
        <p class="title">{{assets}}</p>
        <p class="subtitle">Словарей</p>
    </article>
</div>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

@Component({
  name: 'Assets',
})
export default class extends Vue {

}
</script>
