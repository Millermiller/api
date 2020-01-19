@component('mail::message')

<p>Получено сообщение формы обратной связи:</p>
<br>

<p>id: {{$data->getId()}}</p>
<p>имя: {{$data->getName()}}</p>
<p>сообщение: {{$data->getMessage()}}</p>
<p>дата: {{$data->getCreatedAt()->format('d.m.Y  в H:i')}}</p>

@endcomponent
