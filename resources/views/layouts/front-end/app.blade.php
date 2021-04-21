<!doctype html>
<html lang="en">


<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>{{ config('app.name') }} @yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- fevicon -->
    <link rel="icon" href=" {{asset('assets/front-end/images/fevicon.png')}} " type="image/gif" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href=" {{asset('assets/front-end/css/bootstrap.min.css')}} ">
    <!-- style css -->
    <link rel="stylesheet" href=" {{asset('assets/front-end/css/style.css')}}">
    <!-- Responsive-->
    <link rel="stylesheet"  href="{{asset('assets/front-end/css/responsive.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/front-end/css/jquery.mCustomScrollbar.min.css')}}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    @stack('css')
</head>

<body>
<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="assets/front-end/images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
@include('.layouts.front-end.partials.header')
<!-- end header -->


@yield('content')
<!-- end our -->
    <!--  footer -->
@include('.layouts.front-end.partials.footer')

@section('js')


    <script src=" {{asset('assets/front-end/js/jquery.min.js')}}"></script>
    <script src=" {{asset('assets/front-end/js/popper.min.js')}}"></script>
    <script src=" {{asset('assets/front-end/js/bootstrap.bundle.min.js')}}"></script>
    <script src=" {{asset('assets/front-end/js/jquery-3.0.0.min.js')}}"></script>
    <script src=" {{asset('assets/front-end/js/plugin.js')}} "></script>
    <!-- sidebar -->
    <script src="{{asset('assets/front-end/js/jquery.mCustomScrollbar.concat.min.js')}} "></script>
    <script src="{{asset('assets/front-end/js/custom.js')}} "></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


@show
</body>

</html>
