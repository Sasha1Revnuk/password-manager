<nav id="js-primary-nav" class="primary-nav" role="navigation">
    <ul id="js-nav-menu" class="nav-menu">

        {{--<li class="active open">--}}
            {{--<a href="#" title="Application Intel" data-filter-tags="application intel">--}}
                {{--<i class="fal fa-info-circle"></i>--}}
                {{--<span class="nav-link-text" data-i18n="nav.application_intel">Application Intel</span>--}}
            {{--</a>--}}
            {{--<ul>--}}
                {{--<li>--}}
                    {{--<a href="intel_analytics_dashboard.html" title="Analytics Dashboard">--}}
                        {{--<span class="nav-link-text">Analytics Dashboard</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="active">--}}
                    {{--<a href="intel_marketing_dashboard.html" title="Marketing Dashboard" data-filter-tags="application intel marketing dashboard">--}}
                        {{--<span class="nav-link-text" data-i18n="nav.application_intel_marketing_dashboard">Marketing Dashboard</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="intel_introduction.html" title="Introduction" data-filter-tags="application intel introduction">--}}
                        {{--<span class="nav-link-text" data-i18n="nav.application_intel_introduction">Introduction</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="intel_privacy.html" title="Privacy" data-filter-tags="application intel privacy">--}}
                        {{--<span class="nav-link-text" data-i18n="nav.application_intel_privacy">Privacy</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="intel_build_notes.html" title="Build Notes" data-filter-tags="application intel build notes">--}}
                        {{--<span class="nav-link-text" data-i18n="nav.application_intel_build_notes">Build Notes</span>--}}
                        {{--<span class="">v4.0.1</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</li>--}}


        @include('layouts.account.menu.simple', [
            'menuIcon' => 'fal fa-desktop',
            'link' => 'indexAdmin',
            'title' => 'Головна',
        ])
        @include('layouts.account.menu.simple', [
            'menuIcon' => 'fal fa-home',
            'link' => 'objects',
            'title' => 'Об\'єкти',
        ])





        {{--Super admin--}}
        @if(\Illuminate\Support\Facades\Auth::user()->is_root)
        <li class="nav-title">Root меню</li>
        @include('layouts.account.menu.simple', [
            'menuIcon' => 'fal fa-gift',
            'link' => 'sportObjectsPromoCodes',
            'title' => 'Промокоди',
        ])
        @endif
    </ul>
</nav>