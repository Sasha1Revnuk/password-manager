@php
$request = new \Illuminate\Http\Request();
@endphp
<nav id="js-primary-nav" class="primary-nav" role="navigation">
    <ul id="js-nav-menu" class="nav-menu">
        @include('layouts.account.panel-menu.simple', [
            'menuIcon' => 'fal fa-braille',
            'link' => 'quick',
            'params' => ['user' => \Illuminate\Support\Facades\Auth::id()],
            'title' => 'Швидкий доступ',
        ])

        @include('layouts.account.panel-menu.simple', [
            'menuIcon' => 'fal fa-globe',
            'link' => 'webs',
            'params' => ['user' => \Illuminate\Support\Facades\Auth::id()],
            'title' => 'Облікові записи',
        ])

        @include('layouts.account.panel-menu.simple', [
            'menuIcon' => 'fal fa-bookmark',
            'link' => 'marks',
            'params' => ['user' => \Illuminate\Support\Facades\Auth::id()],
            'title' => 'Закладки',
        ])

        @include('layouts.account.panel-menu.simple', [
            'menuIcon' => 'fal fa-pencil',
            'link' => 'notes',
            'params' => ['user' => \Illuminate\Support\Facades\Auth::id()],
            'title' => 'Нотатки',
        ])
    </ul>
</nav>