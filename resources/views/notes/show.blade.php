@extends('layouts.account.index')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel panel-locked">
                <div class="bg-for-panel">
                    <div class="col-lg-6 col-xs-6 col-sm-6 ">

                    </div>
                </div>

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="container">
                            <div data-size="A4">
                                {!! $note->text !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection