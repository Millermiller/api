@component('mail::message')

<p>Здравствуйте, {{$user->login}}!</p>
<p>Вы отправили запрос на восстановление пароля.</p>

@component('mail::button', ['url' => url(config('app.url').route('password.reset', $token, false))])
Сбросить пароль
@endcomponent

<p>Пожалуйста, проигнорируйте данное письмо, если оно попало к Вам по ошибке.</p>
<br>
{{ config('app.name') }}
@endcomponent
