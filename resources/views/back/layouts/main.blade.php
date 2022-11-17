<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@nowyouwerkn">
    <meta name="twitter:creator" content="@nowyouwerkn">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Werken">
    <meta name="twitter:description" content="Werken WeCommerce">
    <meta name="twitter:image" content="">

    <!-- Facebook -->
    <meta property="og:url" content="http://www.werken.mx">
    <meta property="og:title" content="Werken">
    <meta property="og:description" content="Werken WeCommerce">

    <meta property="og:image" content="">
    <meta property="og:image:secure_url" content="">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Werken WeCommerce">
    <meta name="author" content="Werken">

    <!-- Favicon -->
    <title>nh - Vista Principal</title>

    <!-- vendor css -->
    <link href="{{ asset('lib/jqvmap/jqvmap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/glass.css') }}">
    @if(Auth::user()->color_mode == true)
    <link rel="stylesheet" href="{{ asset('assets/css/glass_light.css') }}">
    @endif


    @stack('stylesheets')
</head>
@if(Auth::user()->color_mode == true)
    <body class="light-mode">
@else
    <body>
@endif
    <div class="video-bg">
        <video width="320" height="240" autoplay loop muted>
        <source src="https://assets.codepen.io/3364143/7btrrd.mp4" type="video/mp4">
        Your browser does not support the video tag.
        </video>
    </div>
    <div class="dark-light">
        <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" /></svg>
   </div>

   <div class="app">
        @include('back.layouts.header')
        <div class="wrapper">

        @include('back.layouts.navbar')
        
        <div class="main-container">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
        <div class="overlay-app"></div>
        </div>
   </div>

    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <!-- choose one -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> 
    <script>
        feather.replace()
    </script>

    <script>
        $(function () {
        $(".menu-link").click(function () {
        $(".menu-link").removeClass("is-active");
        $(this).addClass("is-active");
        });
        });

        $(function () {
        $(".main-header-link").click(function () {
        $(".main-header-link").removeClass("is-active");
        $(this).addClass("is-active");
        });
        });

        const dropdowns = document.querySelectorAll(".dropdown");
        dropdowns.forEach((dropdown) => {
        dropdown.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdowns.forEach((c) => c.classList.remove("is-active"));
        dropdown.classList.add("is-active");
        });
        });

        $(".search-bar input")
        .focus(function () {
        $(".header").addClass("wide");
        })
        .blur(function () {
        $(".header").removeClass("wide");
        });

        $(document).click(function (e) {
        var container = $(".status-button");
        var dd = $(".dropdown");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
        dd.removeClass("is-active");
        }
        });

        $(function () {
        $(".dropdown").on("click", function (e) {
        $(".content-wrapper").addClass("overlay");
        e.stopPropagation();
        });
        $(document).on("click", function (e) {
        if ($(e.target).is(".dropdown") === false) {
        $(".content-wrapper").removeClass("overlay");
        }
        });
        });

        $(function () {
        $(".status-button:not(.open)").on("click", function (e) {
        $(".overlay-app").addClass("is-active");
        });
        $(".pop-up .close").click(function () {
        $(".overlay-app").removeClass("is-active");
        });
        });

        $(".status-button:not(.open)").click(function () {
        $(".pop-up").addClass("visible");
        });

        $(".pop-up .close").click(function () {
        $(".pop-up").removeClass("visible");
        });

        const toggleButton = document.querySelector('.dark-light');

        toggleButton.addEventListener('click', () => {
            document.body.classList.toggle('light-mode');
        });

    </script>
    @stack('scripts')
</body>
</html>
