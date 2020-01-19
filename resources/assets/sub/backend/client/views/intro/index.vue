<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <h4 class="title text-center">Intro.js</h4>
                    <b-field>
                        <p class="control">
                            <button class="button is-success" @click="add">Добавить</button>
                        </p>
                    </b-field>

                    <b-table
                            :data="intros"
                            paginated
                            narrowed=""
                            :loading="loading"
                            per-page="10"
                    >

                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" sortable numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="page" label="page" sortable>
                                {{ props.row.page }}
                            </b-table-column>

                            <b-table-column field="element" label="element" sortable>
                                {{ props.row.element }}
                            </b-table-column>

                            <b-table-column field="intro" label="intro" >
                                {{ props.row.intro }}
                            </b-table-column>

                            <b-table-column field="position" label="position" >
                                {{ props.row.position }}
                            </b-table-column>

                            <b-table-column field="sort" label="sort" >
                                {{ props.row.sort }}
                            </b-table-column>

                            <b-table-column custom-key="actions">
                                <button class="button  is-warning" @click="edit(props.row)">
                                    <b-icon icon="account-edit" size="is-small"></b-icon>
                                </button>
                                <button class="button  is-danger" @click="remove(props.row)">
                                    <b-icon icon="account-remove" size="is-small"></b-icon>
                                </button>
                            </b-table-column>
                        </template>
                    </b-table>
                </article>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                intros: []
            }
        },
        components: {

        },
        methods: {
            load(){
                this.$http.get('/admin/intro').then((response) => {
                    this.intros = response.body
                }, (response) => {
                    console.log(response)
                })
            },
            edit(row){
                this.$router.push({ name: 'Intro', params: { id: row.id}})
            },
            remove(row){
                if (confirm('удалить?')) {
                    this.$http.delete('/admin/intro/' + row.id).then((response) => {
                        this.load()
                    }, (response) => {
                        console.log(response)
                    })
                }
            },
            add(){
                this.$http.post('/admin/intro').then((response) => {
                    this.load()
                }, (response) => {
                    console.log(response)
                })
            }
        },
        mounted(){
            this.load()
        }
    }
</script>