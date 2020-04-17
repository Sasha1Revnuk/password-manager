@extends('layouts.account.index')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-container show">
                            <div class="panel-content">
                                <form id="form" action="{{route('addNote', ['user' => \Illuminate\Support\Facades\Auth::id()])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            @include('layouts.account.alerts.danger', ['alert' => $error])

                                        @endforeach
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <input type="text" name="name" placeholder="Назва" class="form-control @error('name') is-invalid @enderror">
                                                        @error('name')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <textarea  name="text" id="text"></textarea>
                                                        @error('text')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                                        <button type="submit" class="btn  btn-primary waves-effect waves-themed">Додати</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="{{ asset('/acc/js/ckeditor/ckeditor.js') }}"></script>
    <script>CKEDITOR.replace( 'text' );</script>
@endsection