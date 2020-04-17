<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Помилка | Password Manager
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
<div class="page-wrapper alt">
    <!-- BEGIN Page Content -->
    <!-- the #js-page-content id is needed for some plugins to initialize -->
    <main id="js-page-content" role="main" class="page-content">
        <div class="h-alt-f d-flex flex-column align-items-center justify-content-center text-center">
            <h1 class="page-error color-fusion-500">
                ERROR <span class="text-gradient">404</span>
                <small class="fw-500">
                    Щось пішло не так!
                </small>
            </h1>
            <h3 class="fw-500 mb-5">
                Сторінку не знайдено. Повернутись на <a href="/">Головну</a> ?
            </h3>
        </div>
    </main>
    <!-- END Page Content -->
    <!-- BEGIN Page Footer -->
    <footer class="page-footer" role="contentinfo">

    </footer>
    <!-- END Page Footer -->
</div>

<script src="{{asset('js/vendors.bundle.js')}}"></script>
<script src="{{asset('js/app.bundle.js')}}"></script>
<script>
    $("#js-login-btn").click(function(event)
    {

        // Fetch form to apply custom Bootstrap validation
        var form = $("#js-login")

        if (form[0].checkValidity() === false)
        {
            event.preventDefault()
            event.stopPropagation()
        }

        form.addClass('was-validated');
        // Perform ajax submit here...
    });

</script>
</body>
</html>
