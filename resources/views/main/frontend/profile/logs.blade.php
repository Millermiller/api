@extends('main.frontend.profile.index')
@section('profile')
    <div class="col-md-6 col-md-offset-1 col-xs-12" style="height: 100%;">
        <div class="logs-wrapper">
            <div class="logs">
                @foreach($logs as $log)
                    <div class="log-item">
                        <div class="log-data">
                            <i class="ion  ion-ios-time-outline"></i>
                            {{$log->created_at->format('d.m.Y H:i')}}
                        </div>
                        <div class="log-description">
                            {{$log->description}}
                            @if($log->subject)
                                <span class="log-subject">{{$log->subject->title}}</span>
                            @endif
                        </div>
                        @if($log->getExtraProperty('lang'))
                            <div class="log-language">
                                <img src="/img/flag_left_{{$log->getExtraProperty('lang')}}.png" alt="">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            {{$logs->render()}}
        </div>
    </div>
@stop