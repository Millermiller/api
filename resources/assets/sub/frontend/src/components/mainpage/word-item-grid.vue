<template>
    <div
            :class="[
                    'step',
                    {
                         'open': item.active,
                         'tested': item.canopen,
                         'not-available': !item.available
                    }
           ]"
            @click="redirect(item)">
        <span class="asset_level">{{item.level}}</span>
        <span
                v-if="item.result"
                :class="[
                  'asset_result',
                    {
                      success: item.result > 80,
                      warning: (item.result > 50 && item.result < 80),
                      danger: item.result < 50
                    }
                ]">
            {{item.result}}%
        </span>
        <i @click="showModal" class="ion-locked" v-if="!item.available"></i>
    </div>
</template>

<script>

    export default{
        props: ['item'],
        data(){
            return {}
        },
        methods: {
            redirect: function (item) {
                if (!item.available)
                    return false;
                if (item.active)
                    this.$router.push('/learn/' + item.id);
                if (item.canopen)
                    this.$router.push('/test/' + item.testlink);
            },
            showModal(){
                this.$emit('modal')
            }
        }
    }
</script>
