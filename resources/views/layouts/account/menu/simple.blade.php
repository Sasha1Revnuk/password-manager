<li class="{{request()->route()->getName() == $link ? 'active' : ''}}">
    <a href="{{route($link)}}" title="{{$title}}">
        <i class="{{$menuIcon}}"></i><span class="nav-link-text">{{$title}}</span>
    </a>
</li>