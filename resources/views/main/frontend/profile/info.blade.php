@extends('main.frontend.profile.index')
@section('profile')
    <div class="col-md-6 col-md-offset-1 col-xs-12">
        <div class="row">
            <div class="col-md-12">
                <div class="userinfo">
                    <table class="table table-striped table-bordered table-hover pages userlist">
                        <tr>
                            <td>Подписка:</td>
                            <td>
                                @if($user->premium)
                                    premium еще <?= \Carbon\Carbon::today()->diffInDays($user->active_to);?> дней <a href="{{ route('frontend::payment') }}">продлить</a>
                                @else
                                    базовая <a href="{{ route('frontend::payment') }}">купить premium</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Зарегистрирован:</td>
                            <td>{{$user->created_at->format('d.m.Y  в H:i')}}</td>
                        </tr>
                        <tr>
                            <td>Дней в сервисе:</td>
                            <td><?php echo round((date(time())-strtotime($user->created_at)) / 86400)?></td>
                        </tr>
                        <tr>
                            <td>Наборов открыто:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Наборов создано:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Рейтинг:</td>
                            <td>0</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop