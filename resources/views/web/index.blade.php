@extends('layouts.account.index')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel panel-locked">
                <div class="bg-for-panel">
                    <div class="col-lg-6 col-xs-6 col-sm-6 ">
                        <h2 class="float-left">
                            <button data-toggle="modal" data-target="#addWebModal" type="button" class="btn btn-outline-success waves-effect waves-themed" id="addResource"><i class="fal fa-plus" aria-hidden="true"></i> Додати посилання</button>
                        </h2>
                        <h2 class="ml-3 float-left">
                            <button class="btn btn-outline-success waves-effect waves-themed" id="addGroup"><i class="fal fa-object-group"
                                                                                                               aria-hidden="true"></i> Додати групу</button>
                        </h2>
                    </div>
                </div>

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row filters">
                            <div class="form-group col-lg-2">
                                <input  readonly onfocus="this.removeAttribute('readonly')" type="text" id="url" class="form-control" placeholder="Почніть вводити посилання">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="webs"
                                       class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline"
                                       role="grid"
                                        data-user="{{$user->id}}">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ресурс</th>
                                        <th>Користувач</th>
                                        <th>Дії</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="addWebModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Додати посилання
                    </h4>
                    <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
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
                        <div class="form-group col-lg-5">
                            <input type="text" readonly="" class="form-control-plaintext" id="example-static" value="Довжина (мін.:8)">                        </div>
                        <div class="form-group col-lg-5">
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
                    <form class="col-lg-12 text-center" id="addModalForm">
                        <div class="form-group col-lg-12">
                            <input type="text" id="urlModalAdd" class="form-control" placeholder="Посилання">
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="text" id="loginModalAdd" class="form-control" placeholder="Логін">
                        </div>

                        <div class="form-group col-lg-12">
                            <div class="input-group flex-nowrap">
                                <hr />
                                <input id="passwordModalAdd" type="password" class="form-control passwordModalAdd" placeholder="Пароль" aria-label="Пароль" aria-describedby="passwordModal">
                                <div class="input-group-append">
                                    <button class="input-group-text waves-effect changeTypePassword" title="Показати пароль" data-input="#passwordModalAdd" data-i="#passwordI"><i class="fal fa-toggle-off fs-xl" id="passwordI"></i></button>
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
                                {{--<div class="alert" id="passstrength" role="alert">--}}
                                {{--</div>--}}
                            </div>
                        <hr />
                        <div class="row mb-4">
                            <div class="col-lg-12 text-center">
                                <h3>Метод шифрування</h3>
                            </div>
                        </div>
                        <div class="row">
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
                                                <input type="radio" class="custom-control-input" value="1" id="secret" name="shifr">
                                                <label class="custom-control-label" for="secret">Вибрати</label>
                                            </div>
                                            <div class="form-group mt-3">
                                                <input id="secretPasswordModalAdd" type="password" class="form-control passwordModalAdd" placeholder="Секретний пароль" aria-label="Секретний пароль">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav_pills_default-2" role="tabpanel">
                                            <p>Відповідальність за безпеку лежить виключно на Вас</p>
                                            <p>Для зашифрування та розшифрування паролей не потрібно вводити секретний пароль. Дані будуть зашифровані системними ресурсами</p>
                                            <p><strong>Увага!</strong> При успішному викрадені бази даних зловмисниками, ключ до розшифрування облікових записів буде також у зловмисників</p>
                                            <p>100% -ва безпека не гарантована!</p>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" value="2" id="system" name="</label>" >
                                                <label class="custom-control-label" for="system">Вибрати</label>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-themed closeModal" data-dismiss="modal">Закрити</button>
                    <button type="button" class="btn btn-primary waves-effect waves-themed" id="addToModal">Додати</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Редагувати групу
                    </h4>
                    <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h3>Редагувати групу</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <input type="text" id="groupName" class="form-control" placeholder="Назва групи">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-themed closeModal" data-dismiss="modal">Закрити</button>
                    <button type="button" class="btn btn-primary waves-effect waves-themed" id="editGroupModalButton">Редагувати</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addToGroup" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Додати в групу
                    </h4>
                    <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h3>Додати в групу</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <select id="groups" class="form-control"></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-themed closeModal" data-dismiss="modal">Закрити</button>
                    <button type="button" class="btn btn-primary waves-effect waves-themed" id="addToGroupButton">Додати</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="/acc/js/webs.js"></script>

@endsection