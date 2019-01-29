<template>
    <el-col :span="8" :xs="24" id="puzzlewidget">
        <el-card shadow="hover" :class="['widget-block', 'pointer']"  @click.native="words()">
            <p :class="['widget-title']">Паззлы</p>
            <p :class="['widget-description']">{{active}}/{{all}}</p>
            <el-progress type="circle" :percentage="percent"></el-progress>
        </el-card>
    </el-col>
</template>

<script type="text/babel">
    export default {
        data(){
            return {
                puzzles: []
            }
        },
        computed:{
            percent(){
                return Math.round(100 * this.active / this.all);
            },
            active(){
                let count = 0

                this.puzzles.forEach(function(element, index, array){
                    if(element.success)
                        count++
                })

                return count
            },
            all(){
                return (this.puzzles.length) ? this.puzzles.length : 1
            }
        },
        created(){
            this.$http.get('/puzzle').then((response) => {
                this.puzzles = response.body
            }, (response) => {
                console.log(response)
            })
        },
        methods:{
            words(){
                this.$router.push('/puzzle')
            }
        }
    }
</script>