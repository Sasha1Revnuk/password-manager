
<li class="{{ in_array(request()->route()->getName(), $items) ? 'active open' : '' }}">
    <a href="#" title="Application Intel" data-filter-tags="application intel">
        <i class="{{$menuIcon}}"></i>
        <span class="nav-link-text">{{$title}}</span>
    </a>
        <ul class="kt-menu__subnav">
            @foreach($items as $title => $link)
                <li class="{{request()->route()->getName() == $link ? 'active' : ''}}">
                    <a href="{{route($link)}}" title="{{$title}}">
                        <span class="nav-link-text">{{$title}}</span>
                    </a>
                </li>
            @endforeach
        </ul>
</li>