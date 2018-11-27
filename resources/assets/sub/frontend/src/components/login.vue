<template>
    <div class="loginpage">
        <div class="form-wrapper">
            <el-card v-loading.body="loading">
                <div slot="header" class="clearfix">
                    <span style="line-height: 36px;">icelandic.scandinaver.org</span>
                </div>
                <el-form ref="loginform" :model="form" :rules="rules">
                    <small v-if="error" style="color:#ff4949">{{error}}</small>
                    <el-form-item prop="login">
                        <el-input v-model="form.login" placeholder="Login" auto-complete="on"></el-input>
                    </el-form-item>

                    <el-form-item prop="password">
                        <el-input v-model="form.password" type="password" placeholder="Password"
                                  auto-complete="on"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="submit('loginform')">Вход</el-button>
                    </el-form-item>

                </el-form>
            </el-card>
        </div>
    </div>
</template>

<script>
    import auth from '../auth'

    export default{
        data(){
            return {
                form: {
                    login: '',
                    password: ''
                },
                rules: {
                    login: [
                        {required: true, message: 'Введите логин или email', trigger: 'sumbit'},
                    ],
                    password: [
                        {required: true, message: 'Введите пароль', trigger: 'sumbit'},
                    ]
                },
                error: false,
                loading: false
            }
        },
        created(){
            this.loading = true

            this.$http.get('/check').then((response) => {
                if(response.body.auth === true){
                    this.$router.push({name: 'main'})
                }
                else{
                    this.loading = false
                }
            }, (response) => {
                console.log(response);
            });
        },
        methods: {
            submit(formName){

                let v = this;
                let login = v.form.login
                let password = v.form.password
                let error = v.error

                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        v.loading = true;
                        auth.login(this, {'login': login, 'password': password}, '/').then(
                            function (data) {
                                //nothing
                            }
                        ).catch(function (data) {
                            v.error = data.message
                            v.loading = false;
                        });
                    }
                });
            }
        }
    }
</script>