
@foreach($errors->all() as $message)
    {{--@php--}}
        {{--dd($message);--}}
    {{--@endphp--}}
<span class="" role="alert">

    <strong>{{ $message }}</strong>
</span>
@endforeach