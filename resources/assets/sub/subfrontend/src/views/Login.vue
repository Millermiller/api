<template>
  <div class="loginpage">
    <div class="form-wrapper">
      <el-card v-loading.body="loading">
        <div slot="header" class="clearfix">

        </div>
        <el-form ref="loginform" :model="form" :rules="rules">
          <small v-if="error" style="color:#ff4949">{{error}}</small>
          <el-form-item prop="login">
            <el-input v-model="form.login" placeholder="Login" auto-complete="on"/>
          </el-form-item>

          <el-form-item prop="password">
            <el-input v-model="form.password" type="password" placeholder="Password"
                      auto-complete="on"/>
          </el-form-item>

          <el-form-item>
            <el-button type="primary" @click="submit('loginform')">Вход</el-button>
          </el-form-item>

        </el-form>
      </el-card>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import commonAPI from '@/api/commonAPI'
import ILoginForm from '@/api/ILoginForm'
import userAPI from '@/api/userAPI'

  @Component
export default class Login extends Vue {
    form: ILoginForm = {
      login: '',
      password: '',
    }

    rules: {} = {
      login: [
        { required: true, message: 'Введите логин или email', trigger: 'sumbit' },
      ],
      password: [
        { required: true, message: 'Введите пароль', trigger: 'sumbit' },
      ],
    }

    error: boolean = false

    loading: boolean = false

    created() {
      this.loading = true
      commonAPI.check()
      commonAPI.check().then((response) => {
        if (response.data.auth === true) {
          this.$router.push({ name: 'main' })
        } else {
          this.loading = false
        }
      }, (response) => {
        console.log(response)
      })
    }

    submit(formName: string) {
      const v = this
      // @ts-ignore
      this.$refs[formName].validate((valid) => {
        if (valid) {
          v.loading = true
          userAPI.login(v.form).then(
            (data) => {
              // nothing
            },
          ).catch((data) => {
            v.error = data
            v.loading = false
          })
        }
      })
    }
}
</script>
