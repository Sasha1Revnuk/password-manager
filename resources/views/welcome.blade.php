<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

    <!--- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Password Manager</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{asset('web/css/default.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/layout.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/media-queries.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/prettyPhoto.css')}}">

    <!-- Script
    ================================================== -->
    <script src="{{asset('web/js/modernizr.js')}}"></script>

    <!-- Favicons
     ================================================== -->
    <link rel="shortcut icon" href="{{asset('web/favicon.png')}}" >

</head>

<body>

<div id="preloader">
    <div id="status">
        <img src="{{asset('web/images/preloader.gif')}}" height="64" width="64" alt="">
    </div>
</div>

<!-- Header
================================================== -->



<!-- Homepage Hero
================================================== -->
<section id="hero">

    <div class="row">

        <div class="twelve columns">
            <div class="hero-text">
                <h1 class="responsive-headline">Password Manager</h1>
                <p>Прекрасне рішення для зберігання своїх паролів. Перейдіть в особистий кабінет та розпочинайте роботу!</p>
            </div>
            @if(\Illuminate\Support\Facades\Auth::check())
                <div class="buttons">
                    <a class="button trial" href="{{route('webs', ['user' => \Illuminate\Support\Facades\Auth::id()])}}">Перейти в кабінет</a>
                </div>
            @else
                <div class="buttons">
                    <a class="button trial" href="/login">Авторизація</a>
                    <a class="button learn-more " href="/register">Реєстрація</a>
                </div>
            @endif


            <div class="hero-image">
                <img src="{{asset('web/images/hero-image1.png')}}" alt="" />
            </div>

        </div>

    </div>

</section> <!-- Homepage Hero end -->


<!-- Features Section
================================================== -->
<section id='features'>

    <div class="row feature design">

        <div class="six columns right">
            <h3>Вибірковий режим захисту паролей</h3>
            <p>Користувач сам керує режимом роботи додатку. Підберіть для себе вірний метод та користуйтесь ним. Метод підходить для різних облікових записів, тому в будь який час можна швидко змінити рішення.
            </p>
        </div>

        <div class="six columns feature-media left">
            <img src="{{asset('web/images/feature-image-1.png')}}" alt="" />
        </div>

    </div>

    <div class="row feature responsive">

        <div class="six columns left">
            <h3>Надійний захист</h3>

            <p>Окрім звичайного паролю, кожен користувач має свій секретний пароль. Він потрібний для виконання дій, які можуть нести небезпеку при необережному відношенні. Секретний пароль відновити не можна. Натомість є можливість замінити на новий. Проте всі зашифровані облікові записи будуть втрачані! Не загубіть секретний пароль. Його знаєте тільки Ви! Пароль буде надісланий на електронну пошту.
            </p>
        </div>

        <div class="six columns feature-media right">
            <img src="{{asset('web/images/feature-image-2.png')}}" alt="" />
        </div>

    </div>

    <div class="row feature cross-browser">

        <div class="six columns right">
            <h3>Зручний особистий кабінет</h3>

            <p>Просторий особистий кабінет без зайвого функціоналу. Легкість і зручність при використанні гарантовані!
            </p>
        </div>

        <div class="six columns feature-media left">
            <img src="{{asset('web/images/feature-image-3.png')}}" alt="" />
        </div>

    </div>

    <div class="row feature video">

        <div class="six columns left">
            <h3>Додаткові можливості</h3>

            <p>Окрім керування паролями, Ви отримуєте можливість зберігати особисті закладки веб-сайтів та створювати і керувати нотатки.
            </p>
        </div>

        <div class="six columns feature-media left">
            <img src="{{asset('web/images/feature-image-4.png')}}" alt="" />
        </div>

    </div>

</section> <!-- Homepage Hero end -->



<!-- Footer
================================================== -->
<footer>

    <div class="row text-center">
        <p class="copyright">&copy; 2020 Password Manager</p>

        <div id="go-top">
            <a class="smoothscroll" title="Back to Top" href="#hero"><i class="icon-up-open"></i></a>
        </div>

    </div> <!-- Row End -->

</footer> <!-- Footer End-->


<!-- Java Script
================================================== -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="{{asset('web/js/jquery-1.10.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/jquery-migrate-1.2.1.min.js')}}"></script>

<script src="{{asset('web/js/jquery.flexslider.js')}}"></script>
<script src="{{asset('web/js/waypoints.js')}}"></script>
<script src="{{asset('web/js/jquery.fittext.js')}}"></script>
<script src="{{asset('web/js/jquery.fitvids.js')}}"></script>
<script src="{{asset('web/js/imagelightbox.js')}}"></script>
<script src="{{asset('web/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('web/js/main.js')}}"></script>

</body>

</html>