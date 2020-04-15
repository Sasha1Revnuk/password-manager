@extends('layouts.account.index')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-container show">
                            <div class="panel-content" id="webs" data-user="{{\Illuminate\Support\Facades\Auth::id()}}">
                                {{----}}
                                <form method="post" action="{{route('updateWebResource', ['user'=>$user->id, 'web' => $web->id, 'resource' => $resource->id])}}">
                                    @csrf
                                    @if(session('message'))
                                        @include('layouts.account.alerts.message', ['alert' => session('message')])
                                    @endif
                                    @if(session('error'))
                                        @include('layouts.account.alerts.danger', ['alert' => session('error')])
                                    @endif
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            @include('layouts.account.alerts.danger', ['alert' => $error])
                                        @endforeach
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <h3>Налаштування генератора пароля</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-3"><div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input bigLetters" id="bigLetters">
                                                <label class="custom-control-label" for="bigLetters">A-Z</label>
                                            </div></div>
                                        <div class="form-group col-lg-3"><div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input symbols" id="symbols">
                                                <label class="custom-control-label" for="symbols">!"#$%...</label>
                                            </div></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-2 ">
                                            <input type="text" readonly="" class="form-control-plaintext" id="example-static" value="Довжина (мін.:8)">                        </div>
                                        <div class="form-group col-lg-1">
                                            <input class="form-control passwordLength" id="" type="number" name="number" min="8">
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <h3>Обліковий запис</h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @if($resource->method === \App\Enumerators\UserEnumerator::METHOD_SECRET)
                                            <div class="form-group col-lg-12">
                                                <input type="password" name="secretCheckedPassword" required id="secretCheckedPassword" class="form-control" placeholder="Секретний пароль для підтвердження редагування" title="Секретний пароль для підтвердження редагування">
                                            </div>
                                        @endif
                                        <div class="form-group col-lg-12">
                                            <input type="text" name="login" required id="loginModalEdit" class="form-control" placeholder="Логін" value="{{old('login', $resource->login)}}">
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label class="form-label" for="example-static">Діючий пароль</label>

                                            <div class="input-group flex-nowrap">

                                                <input id="myPasswordModalEdit" readonly value="{{$password}}" name="myPassword" type="password" class="form-control-plaintext" placeholder="Пароль" aria-label="Пароль">
                                                <div class="input-group-append">
                                                    <button class="input-group-text waves-effect changeTypeMyPassword" id="changeTypeMyPassword" title="Показати пароль" data-input="#myPasswordModalEdit" data-method="{{$resource->method}}" data-id="{{$resource->id}}" data-i="#myPasswordI"><i class="fal fa-toggle-off fs-xl" id="myPasswordI"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <div class="input-group flex-nowrap">
                                                <hr />
                                                <input id="passwordModalEdit" required name="password" type="password" class="form-control passwordModalEdit" placeholder="Новий пароль" aria-label="Новий пароль" aria-describedby="passwordModal">
                                                <div class="input-group-append">
                                                    <button class="input-group-text waves-effect changeTypePassword" title="Показати пароль" data-input="#passwordModalEdit" data-i="#passwordI"><i class="fal fa-toggle-off fs-xl" id="passwordI"></i></button>
                                                </div>
                                                <div class="input-group-append">
                                                    <button class="input-group-text waves-effect generatePassword" title="Генерувати пароль"><i class="fal fa-key fs-xl" id="passwordI"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <div class="alert  alert-dismissible fade show " id="passstrength"  role="alert">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-1">
                                                        <span class="h6 m-0 fw-700 passstrengthSpan"></span>
                                                        <div class="progress mt-1 progress-xs">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning-600 passstrengthPolosa"  role="progressbar"  aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <h3>Метод шифрування</h3>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="form-group col-lg-12">
                                            <div class="frame-wrap">
                                                <ul class="nav nav-pills nav-justified" role="tablist">

                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="pill" href="#nav_pills_default-1">Секретним паролем</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#nav_pills_default-2">Системно (без пароля)</a>
                                                    </li>

                                                </ul>
                                                <div class="tab-content py-3 text-left ">
                                                    <div class="tab-pane fade show active" id="nav_pills_default-1" role="tabpanel">
                                                        <p>Безпечний метод</p>
                                                        <p>Для зашифрування та розшифрування паролей потрібно ввести секретний пароль</p>
                                                        <p><strong>Увага!</strong> При втраті і відновленні секретного пароля, всі облікові записи, що були зашифровані цим паролем, будуть знищені</p>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" class="custom-control-input" value="1" id="secretCC" name="shifr" @if($resource->method === \App\Enumerators\UserEnumerator::METHOD_SECRET) checked @endif>
                                                            <label class="custom-control-label" for="secretCC">Вибрати</label>
                                                        </div>
                                                        @if($resource->method != \App\Enumerators\UserEnumerator::METHOD_SECRET)
                                                            <div class="form-group mt-3">
                                                                <input name="secret" type="password" class="form-control passwordModalEdit" placeholder="Секретний пароль" aria-label="Секретний пароль">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="tab-pane fade" id="nav_pills_default-2" role="tabpanel">
                                                        <p>Відповідальність за безпеку лежить виключно на Вас</p>
                                                        <p>Для зашифрування та розшифрування паролей не потрібно вводити секретний пароль. Дані будуть зашифровані системними ресурсами</p>
                                                        <p><strong>Увага!</strong> При успішному викрадені бази даних зловмисниками, ключ до розшифрування облікових записів буде також у зловмисників</p>
                                                        <p>100% -ва безпека не гарантована!</p>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" class="custom-control-input" id="system" value="2" name="shifr" @if($resource->method === \App\Enumerators\UserEnumerator::METHOD_KEY) checked @endif >
                                                            <label class="custom-control-label" for="system">Вибрати</label>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-themed float-right">Редагувати</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('scripts')
    <script src="/acc/js/editPassword.js"></script>

@endsection