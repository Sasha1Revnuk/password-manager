@extends('layouts.account.index')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel panel-locked">
                <div class="bg-for-panel">
                    <div class="col-lg-6 col-xs-6 col-sm-6 ">
                        <h2 class="float-left">
                            <button class="btn btn-outline-success waves-effect waves-themed" id="addResource"><i class="fal fa-plus"
                                                                                                                  aria-hidden="true"></i> Додати обліковий запис</button>
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
                                <input autocomplete="off" type="text" id="urlsdfdsf" class="form-control" placeholder="Почніть вводити посилання">
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
                                        <th>Веб-сайт</th>
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
@endsection
@section('scripts')
    <script src="/acc/js/webs.js"></script>

@endsection