@component('mail::message')

<p>Получено сообщение формы обратной связи:</p>
<br>

<p>id: {{$data->id}}</p>
<p>имя: {{$data->name}}</p>
<p>сообщение: {{$data->message}}</p>
<p>дата: {{$data->created_at->format('d.m.Y  в H:i')}}</p>

@endcomponent
