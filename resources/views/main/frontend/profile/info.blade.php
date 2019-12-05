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
                                @if($user->isPremium())
                                    premium еще {{ \Carbon\Carbon::today()->diffInDays($user->getActiveTo())}} {{Lang::choice('день|дня|дней', \Carbon\Carbon::today()->diffInDays($user->getActiveTo()), [], 'ru')}}
                                    <a href="{{ route('frontend::payment') }}">продлить</a>
                                @else
                                    базовая <a href="{{ route('frontend::payment') }}">улучшить</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Зарегистрирован:</td>
                            <td>
                                {{$user->getCreatedAt()->format('d.m.Y  в H:i')}}
                            </td>

                        </tr>
                        <tr>
                            <td>Дней в сервисе:</td>
                            <td>
                                <span class="badge badge-success">
                                    <?php echo round((date(time())-strtotime($user->getCreatedAt())) / 86400)?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Словарей открыто:</td>
                            <td><span class="badge badge-success">{{$user->getAssetsOpened()}}</span></td>
                        </tr>
                        <tr>
                            <td>Словарей создано:</td>
                            <td><span class="badge badge-success">{{$user->getAssetsCreated()}}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop