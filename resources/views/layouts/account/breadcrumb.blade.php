<ol class="breadcrumb page-breadcrumb">
    @foreach($breadcrumb as $breadcrumbTitle => $breadcrumbLink)
        @if($breadcrumbLink)
            <li class="breadcrumb-item"><a href="{{$breadcrumbLink}}">{{$breadcrumbTitle}}</a></li>
        @else
            <li class="breadcrumb-item active">{{$breadcrumbTitle}}</li>
        @endif
    @endforeach
    @php
        $date = \Carbon\Carbon::today()->locale('uk');
        $finalDate = \App\Traits\FirstLetterStringUpper::letterUpper($date->getTranslatedDayName('dddd')) .
        ', '. \App\Traits\FirstLetterStringUpper::letterUpper($date->getTranslatedMonthName('MMMM')) .
        ' ' . $date->format('d, Y');
    @endphp
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span>{{$finalDate}}</span></li>
</ol>