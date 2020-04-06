<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        {{isset($meta['pageTitle']) ? $meta['pageTitle'] . ' - ' . 'Password Manager' : 'Password Manager'}}
    </title>
    <meta name="description" content="Marketing Dashboard">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="{{asset('acc/css/vendors.bundle.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('acc/css/app.bundle.css')}}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('acc/img/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('acc/img/favicon/favicon-32x32.png')}}">
    <link rel="mask-icon" href="{{asset('acc/img/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="{{asset('acc/css/datagrid/datatables/datatables.bundle.css')}}">
    <link rel="stylesheet" href="{{asset('acc/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('choosen/chosen.css')}}">
    <link rel="stylesheet" media="screen, print"href="{{asset('acc/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('acc/css/notifications/sweetalert2/sweetalert2.bundle.css')}}">
    <link rel="stylesheet" href="{{asset('acc/css/bootstrap-clockpicker.min.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('acc/css/formplugins/select2/select2.bundle.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('acc/css/formplugins/summernote/summernote.css')}}">

</head>
<body class="mod-bg-1 ">
<script>
    var classHolder = document.getElementsByTagName("BODY")[0],
        themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {},
        themeURL = themeSettings.themeURL || '',
        themeOptions = themeSettings.themeOptions || '';
</script>
<!-- BEGIN Page Wrapper -->
<div class="page-wrapper">
    <div class="page-inner">
        <!-- BEGIN Left Aside -->
        <aside class="page-sidebar">
            @include('layouts.account.page-logo')
            <!-- BEGIN PRIMARY NAVIGATION -->
                    @include('layouts.account.panel-menu')
        </aside>
        <!-- END Left Aside -->
        <div class="page-content-wrapper">
            <!-- BEGIN Page Header -->
            <header class="page-header" role="banner">
                <!-- DOC: nav menu layout change shortcut -->
                <div class="hidden-md-down dropdown-icon-menu position-relative">
                    <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                        <i class="ni ni-menu"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                <i class="ni ni-minify-nav"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                <i class="ni ni-lock-nav"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- DOC: mobile button appears during mobile width -->
                <div class="hidden-lg-up">
                    <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                        <i class="ni ni-menu"></i>
                    </a>
                </div>
                <div class="ml-auto d-flex">
                    <div>
                        <a href="#" data-toggle="dropdown" title="{{\Illuminate\Support\Facades\Auth::user()->full_name}}" class="header-icon d-flex align-items-center justify-content-center ml-2">
                            <i class="fal fa-user"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                            <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                    <div class="info-card-text">
                                        <div class="fs-lg text-truncate text-truncate-lg">{{\Illuminate\Support\Facades\Auth::user()->full_name}}</div>
                                        <span class="text-truncate text-truncate-md opacity-80">{{\Illuminate\Support\Facades\Auth::user()->email}}</span><br />
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item fw-500 pt-3 pb-3" href="/account/logout">
                                <span data-i18n="drpdwn.page-logout">Вихід</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END Page Header -->
            <!-- BEGIN Page Content -->
            <!-- the #js-page-content id is needed for some plugins to initialize -->
            <main id="js-page-content" role="main" class="page-content">
                @include('layouts.account.breadcrumb')
                <div class="subheader">
                    <h1 class="subheader-title">
                        {{$meta['pageTitle'], 'Password Manager'}}
                    </h1>
                </div>
                @yield('content')
            </main>
            <!-- this overlay is activated only when mobile menu is triggered -->
            <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
            <!-- BEGIN Page Footer -->
            <footer class="page-footer" role="contentinfo">
                <div class="d-flex align-items-center flex-1 text-muted"></div>
                <div>
                    <ul class="list-table m-0">
                        <li><a href="intel_introduction.html" class="text-secondary fw-700">About</a></li>
                        <li class="pl-3"><a href="info_app_licensing.html" class="text-secondary fw-700">License</a></li>
                        <li class="pl-3"><a href="info_app_docs.html" class="text-secondary fw-700">Documentation</a></li>
                    </ul>
                </div>
            </footer>
            <!-- END Page Footer -->
            <!-- BEGIN Shortcuts -->
            <!-- modal shortcut -->
            @include('layouts.account.modal-header')
        </div>
    </div>
</div>
<!-- END Page Wrapper -->
<!-- BEGIN Quick Menu -->
<!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
@include('layouts.account.right-navbar')
<!-- END Quick Menu -->
<script src="{{asset('acc/js/vendors.bundle.js')}}"></script>
<script src="{{asset('acc/js/app.bundle.js')}}"></script>
<script type="text/javascript">
    $('#js-page-content').smartPanel();

    if (window.Waves && myapp_config.rippleEffect) {
        Waves.attach('.nav-menu:not(.js-waves-off) a, .btn:not(.js-waves-off):not(.btn-switch), .js-waves-on', ['waves-themed']);
        Waves.init();
    }
</script>

<script src="{{asset('acc/js/datagrid/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('choosen/chosen.jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('acc/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('acc/js/notifications/sweetalert2/sweetalert2.bundle.js')}}"></script>
<script src="{{asset('acc/js/bootstrap-clockpicker.min.js')}}"></script>
<script src="{{asset('acc/js/formplugins/bootstrap-datepicker.ua.js')}}"></script>
<script src="{{asset('acc/js/formplugins/inputmask/inputmask.bundle.js')}}"></script>
<script src="{{asset('acc/js/formplugins/select2/select2.bundle.js')}}"></script>
<script src="{{asset('acc/js/formplugins/summernote/summernote.js')}}"></script>

@yield('scripts')

<?php use Illuminate\Support\Facades\Auth;

if(auth()->guard()->check()): ?>
<script>
    window.apiToken = "<?php echo e(Auth::user()->api_token); ?>";
    window.authHeaders = {
        Authorization: 'Bearer ' + apiToken
    }
    window.formUrlEncoded =  {
        'Content-Type': 'application/x-www-form-urlencoded'
    }
    window.applicationJson =  {
        'Content-Type': 'application/json'
    }
    window.acceptJson = {
        "Accept": "application/json,text/*;q=0.99"
    }
</script>
<?php endif; ?>
</body>
</html>
