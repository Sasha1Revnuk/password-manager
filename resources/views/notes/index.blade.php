@extends('layouts.account.index')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel panel-locked">
                <div class="bg-for-panel">
                    <div class="col-lg-6 col-xs-6 col-sm-6 ">
                        <h2 class="float-left">
                            <a href="{{route('addFormNote', ['user'=>\Illuminate\Support\Facades\Auth::id()])}}"  class="btn btn-outline-success waves-effect waves-themed" ><i class="fal fa-plus" aria-hidden="true"></i> Додати нотатки</a>
                        </h2>
                    </div>
                </div>

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="notes"
                                       class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline"
                                       role="grid"
                                        data-user="{{$user->id}}">
                                    <thead>
                                    <tr>
                                        <th>Назва</th>
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
    <script src="/acc/js/notes.js"></script>

@endsection