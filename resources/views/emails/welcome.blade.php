@component('mail::message')
Halló, {{$data['login']}}

<p>Благодарим за регистрацию на сайте scandinaver.org</p>
<br>
<span style="font-weight: bold;">Ваши данные для входа:</span>
<p>логин: {{$data['login']}}</p>
<p>пароль: {{$data['password']}}</p>



Thanks,<br>
{{ config('app.name') }}
@endcomponent
