@extends('main.frontend.layouts.index')
@section('content')
    <section class="container panel" style="margin-top: 50px;margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center color-{{$plan->name}}">{{$plan->name}}</h1>
                <h2 class="text-center">{{$plan->cost}}<span class="rub">i</span></h2>
                <h3 class="text-center">{{$plan->period}}:</h3>

                <div class="flex-wrapper flex-center">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="ion-checkmark-round"></i>
                                Полный доступ к наборам "Слова" и "Предложения"
                            </li>
                            <li class="list-group-item">
                                <i class="ion-checkmark-round"></i>
                                Полный доступ к текстам
                            </li>
                            <li class="list-group-item">
                                <i class="ion-checkmark-round"></i>
                                Возможность создавать свои наборы
                            </li>
                            <li class="list-group-item">
                                <i class="ion-checkmark-round"></i>
                                Возможность добавлять свои словарные карточки
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <p>
                    <button class="btn color-{{$plan->name}} text-lowercase" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Что случится с моими словарями после окончания срока действия тарифа?
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="">
                        <p>Ничего, словари останутся доступны для использования на сайте и в мобильном приложении, но Вы не сможете редактировать/удалить их.</p>
                    </div>
                </div>
                <p>
                    <button class="btn color-{{$plan->name}} text-lowercase" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                       После оплаты все словари и тексты станут открытыми?
                    </button>
                </p>
                <div class="collapse" id="collapseExample2">
                    <div class="">
                        <p>Нет :) Тесты нужно будет проходить в любом случае</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml" style="margin-top: 20px;">

                    <input type="hidden" name="receiver" value="{{config('app.yreceiver')}}">
                    <input type="hidden" name="formcomment" value="Оплата на сайте scandinaver.org">
                    <input type="hidden" name="short-dest" value="Оплата на сайте scandinaver.org">
                    <input type="hidden" name="label" value="{{Auth::user()->id}}|{{$plan->id}}">
                    <input type="hidden" name="quickpay-form" value="shop">
                    <input type="hidden" name="targets" value="Покупка тарифа {{$plan->name}} на сайте scandinaver.org">
                    <input type="hidden" name="sum" value="2" data-type="number">
                    <input type="hidden" name="successURL" value="{{config('app.yandex_successUrl')}}" data-type="number">

                    <div class="radio" style="display: inline-block">
                        <label>
                            <input type="radio" name="paymentType"  value="PC" checked>
                            <p class="radiolabel">Яндекс.Деньги</p>
                        </label>
                    </div>
                    <div class="radio" style="display: inline-block">
                        <label>
                            <input type="radio" name="paymentType"  value="AC">
                            <p class="radiolabel">Банковская карта</p>
                        </label>
                    </div>

                    <div>
                        <a href="{{route('frontend::payment')}}" class="btn color-{{$plan->name}}">Назад</a>
                        <input type="submit" class="btn btn-raised color-{{$plan->name}}" value="Перейти к оплате">
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop