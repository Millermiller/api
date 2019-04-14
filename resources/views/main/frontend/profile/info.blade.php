@extends('main.frontend.profile.index')
@section('profile')
    <div class="col-md-6 col-md-offset-1 col-xs-12">
        <div class="row">
            <div class="col-md-12">
                <div class="userinfo">
                    <table class="table  pages userlist">
                        <tr>
                            <td>Подписка:</td>
                            <td>
                                @if($user->premium)
                                    premium еще {{ \Carbon\Carbon::today()->diffInDays($user->active_to)}} {{Lang::choice('день|дня|дней', \Carbon\Carbon::today()->diffInDays($user->active_to), [], 'ru')}}
                                    <a href="{{ route('frontend::payment') }}">продлить</a>
                                @else
                                    базовая <a href="{{ route('frontend::payment') }}">улучшить</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Зарегистрирован:</td>
                            <td>
                                {{$user->created_at->format('d.m.Y  в H:i')}}
                            </td>

                        </tr>
                        <tr>
                            <td>Дней в сервисе:</td>
                            <td>
                                <span class="badge badge-success">
                                    <?php echo round((date(time())-strtotime($user->created_at)) / 86400)?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Словарей открыто:</td>
                            <td><span class="badge badge-success">{{$user->assets_opened}}</span></td>
                        </tr>
                        <tr>
                            <td>Словарей создано:</td>
                            <td><span class="badge badge-success">{{$user->assets_created}}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop