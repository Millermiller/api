<div class="row white">
    <div class="block">
        <div class="col-xs-12 col-sm-6 col-md-3">
            <ul class="pricing p-yel">
                <li class="invisible">
                    <big> !</big>
                    <span>бессрочно</span>
                </li>
                <li>Доступных наборов "слова"</li>
                <li>Доступных наборов "предложения"</li>
                <li>Доступных текстов для перевода</li>
                <li>Словарные паззлы</li>
                <li>Создание персональных наборов</li>
                <li>Мобильное приложение</li>
                <li>
                    <h3 class="invisible">0<span class="rub">i</span></h3>
                    <span class="invisible">0<span class="rub">i</span> / месяц</span>
                </li>
                @if(Auth::check())
                    <li class="invisible">
                        <button class="btn btn-danger">Выбрать</button>
                    </li>
                @endif
            </ul>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3">
            <ul class="pricing p-green">
                <li>
                    <big>Basic</big>
                    <span>бессрочно</span>
                </li>
                <li>
                    <span class="color-success">10</span>
                </li>
                <li>
                    <span class="color-success">5</span>
                </li>
                <li>
                    <span class="color-success">3</span>
                </li>
                <li>
                    <svg viewBox="0 45 200 100" height="16">
                        <path fill="none" d="M100,100 C200,0 200,200 100,100  C0,0 0,200 100,100z"
                              stroke-width="10" stroke="#4c7737"></path>
                    </svg>
                </li>
                <li><i class="ion ion-close color-success"></i></li>
                <li><i class="ion ion-checkmark color-success"></i></li>

                <li>
                    <h3>0<span class="rub">i</span></h3>
                    <span>0<span class="rub">i</span> / месяц</span>
                </li>
                @if(Auth::check())
                    <li class="no-border">
                        <button class="btn btn-danger invisible">Выбрать</button>
                    </li>
                @endif
            </ul>
        </div>


        <div class="col-xs-12 col-sm-6 col-md-3">
            <ul class="pricing p-red">
                <li>
                    <big>Medium</big>
                    <span>1 месяц</span>
                </li>
                <li>
                    <svg viewBox="0 45 200 100" height="16">
                        <path fill="none" d="M100,100 C200,0 200,200 100,100  C0,0 0,200 100,100z"
                              stroke-width="10" stroke="#e13c4c"></path>
                    </svg>
                </li>
                <li>
                    <svg viewBox="0 45 200 100" height="16">
                        <path fill="none" d="M100,100 C200,0 200,200 100,100  C0,0 0,200 100,100z"
                              stroke-width="10" stroke="#e13c4c"></path>
                    </svg>
                </li>
                <li>
                    <svg viewBox="0 45 200 100" height="16">
                        <path fill="none" d="M100,100 C200,0 200,200 100,100  C0,0 0,200 100,100z"
                              stroke-width="10" stroke="#e13c4c"></path>
                    </svg>
                </li>
                <li>
                    <svg viewBox="0 45 200 100" height="16">
                        <path fill="none" d="M100,100 C200,0 200,200 100,100  C0,0 0,200 100,100z"
                              stroke-width="10" stroke="#e13c4c"></path>
                    </svg>
                </li>
                <li><i class="ion ion-checkmark color-warning"></i></li>
                <li><i class="ion ion-checkmark color-warning"></i></li>
                <li>
                    <h3>200<span class="rub">i</span></h3>
                    <span>200 <span class="rub">i</span> / месяц</span>
                </li>
                @if(Auth::check())
                    <li>
                        <a href="{{route('frontend::plan', ['name' => 'medium'])}}" class="btn btn-danger">Выбрать</a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3">
            <ul class="pricing p-blue">
                <li>
                    <big>Large</big>
                    <span>3 месяца</span>
                </li>
                <li>
                    <svg viewBox="0 45 200 100" height="16">
                        <path fill="none" d="M100,100 C200,0 200,200 100,100  C0,0 0,200 100,100z"
                              stroke-width="10" stroke="#3f4bb8"></path>
                    </svg>
                </li>
                <li>
                    <svg viewBox="0 45 200 100" height="16">
                        <path fill="none" d="M100,100 C200,0 200,200 100,100  C0,0 0,200 100,100z"
                              stroke-width="10" stroke="#3f4bb8"></path>
                    </svg>
                </li>
                <li>
                    <svg viewBox="0 45 200 100" height="16">
                        <path fill="none" d="M100,100 C200,0 200,200 100,100  C0,0 0,200 100,100z"
                              stroke-width="10" stroke="#3f4bb8"></path>
                    </svg>
                </li>
                <li>
                    <svg viewBox="0 45 200 100" height="16">
                        <path fill="none" d="M100,100 C200,0 200,200 100,100  C0,0 0,200 100,100z"
                              stroke-width="10" stroke="#3f4bb8"></path>
                    </svg>
                </li>
                <li>
                    <i class="ion ion-checkmark color-info"></i>
                </li>
                <li><i class="ion ion-checkmark color-info"></i></li>
                <li>
                    <h3>450<span class="rub">i</span></h3>
                    <span>150 <span class="rub">i</span> / месяц</span>
                </li>
                @if(Auth::check())
                    <li>
                        <a href="{{route('frontend::plan', ['name' => 'large'])}}" class="btn btn-danger">Выбрать</a>
                    </li>
                @endif
            </ul>
        </div>
    </div><!-- /block -->
</div>