<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Активація аккаунту | Password Manager
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="{{asset('acc/css/vendors.bundle.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('acc/css/app.bundle.css')}}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon/favicon-32x32.png')}}">
    <link rel="mask-icon" href="{{asset('img/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <!-- Optional: page related CSS-->
    <link rel="stylesheet" media="screen, print" href="{{asset('css/fa-brands.css')}}">
</head>
<body>
<div class="page-wrapper">
    <div class="page-inner bg-brand-gradient">
        <div class="page-content-wrapper bg-transparent m-0">
            <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                <div class="d-flex align-items-center container p-0">
                    <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                        <a href="/" class="page-logo-link press-scale-down d-flex align-items-center">
                            <img src="{{asset('acc/img/logo.png')}}" alt="ym Control" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">Password Manager</span>
                        </a>
                    </div>
                    <a href="{{route('login')}}" class="btn-link text-white ml-auto">
                        Авторизація
                    </a>
                </div>
            </div>
            <div class="flex-1" >
                <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                    <div class="row">
                        <div class="col-xl-12">
                            <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                Дякуюємо за реєстрацію
                                <small class="h3 fw-300 mt-3 mb-5 text-white opacity-70 hidden-sm-down">
                                    Ми відправили Вам повідомлення для подальшої активації аккаунту @if($secret == 1)та повідомлення з Вашим секретним паролем@endif
                                    <br /><a href="/sendhtmlemail/{{request('user')->id}}" class="btn btn-success mt-3">Надіслати ще раз</a>
                                </small>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/vendors.bundle.js')}}"></script>
<script src="{{asset('js/app.bundle.js')}}"></script>
</body>
</html>
