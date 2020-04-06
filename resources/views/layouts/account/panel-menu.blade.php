@php
$request = new \Illuminate\Http\Request();
@endphp
<nav id="js-primary-nav" class="primary-nav" role="navigation">
    <ul id="js-nav-menu" class="nav-menu">
        @include('layouts.account.panel-menu.simple', [
            'menuIcon' => 'fal fa-braille',
            'link' => 'controlPanel.main',
            'params' => ['object' => $object],
            'title' => 'Інформативна частина',
        ])

        @include('layouts.account.panel-menu.simple', [
            'menuIcon' => 'fal fa-bars',
            'link' => 'controlPanel.sections',
            'params' => ['object' => $object],
            'title' => 'Секції',
        ])

        @include('layouts.account.panel-menu.simple', [
            'menuIcon' => 'fal fa-map',
            'link' => 'controlPanel.tariffPlans',
            'params' => ['object' => $object],
            'title' => 'Тарифні плани',
        ])

        @include('layouts.account.panel-menu.simple', [
            'menuIcon' => 'fal fa-id-card',
            'link' => 'controlPanel.coaches',
            'params' => ['object' => $object],
            'title' => 'Тренери',
        ])

        @include('layouts.account.panel-menu.simple', [
            'menuIcon' => 'fal fa-smile',
            'link' => 'controlPanel.visitors',
            'params' => ['object' => $object],
            'title' => 'Відвідувачі',
        ])

        @include('layouts.account.panel-menu.multiple', [
            'title' => 'Акції',
            'menuIcon' => 'kt-menu__link-icon fal fa-percent',
            'items' => [
                'Для програм' => 'controlPanel.promotions',
                'Для абонементів' => 'controlPanel.abonementPromotions',
            ],
            'params' => ['object' => $object],
        ])

        @include('layouts.account.panel-menu.multiple', [
            'title' => 'Програми',
            'menuIcon' => 'kt-menu__link-icon fal fa-file',
            'items' => [
                'Файли' => 'controlPanel.programs',
                'Категорії' => 'controlPanel.programCategories',
                'Продажі' => 'controlPanel.programSales',
            ],
            'params' => ['object' => $object],
        ])

        @include('layouts.account.panel-menu.simple', [
            'menuIcon' => 'fal fa-address-book',
            'link' => 'controlPanel.abonements',
            'params' => ['object' => $object],
            'title' => 'Абонементи',
        ])
    </ul>
</nav>