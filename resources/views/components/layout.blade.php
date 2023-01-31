<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        {{env('APP_NAME')}}
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/assets/css/icons.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/assets/css/plugins.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
</head>

<body>
    @include('sweetalert::alert')
    @if (request()->has('keyword'))
        <x-search></x-search>
    @endif
    @auth
        @if (auth()->user()->email_verified_at == null)
            <x-send-verification></x-send-verification>
        @endif
    @endauth
    <x-header></x-header>

    @if ($errors)
        @foreach ($errors->all() as $item)
            <div class="alert alert-warning">
                * {{$item}}
            </div>
        @endforeach
    @endif

    {{$slot}}

    <x-footer></x-footer>


<!-- All JS is here
============================================ -->

    <script src="/assets/js/vendor/modernizr-3.11.7.min.js"></script>
    <script src="/assets/js/vendor/jquery-v3.6.0.min.js"></script>
    <script src="/assets/js/vendor/jquery-migrate-v3.3.2.min.js"></script>
    <script src="/assets/js/vendor/popper.min.js"></script>
    <script src="/assets/js/vendor/bootstrap.min.js"></script>
    <script src="/assets/js/plugins.js"></script>
    <!-- Ajax Mail -->
    <script src="/assets/js/ajax-mail.js"></script>
    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>


</body>

</html>
