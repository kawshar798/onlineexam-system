<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('assets/admin/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/admin/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/fonts/fontawesome/css/fontawesome-all.css')}} ">
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/charts/morris-bundle/morris.css')}} ">
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}} ">


    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendor/datatables/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendor/datatables/css/buttons.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendor/datatables/css/select.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendor/datatables/css/fixedHeader.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <title>{{ config('app.name') }} @yield('title')</title>

    @stack('css')
</head>

<body>
<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->

        @include('.layouts.admin.partials.header')
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->

    @include('.layouts.admin.partials.sidebar')
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-influence">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->

            @include('.layouts.admin.partials.page_header')
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->


                <!-- content  -->
     @yield('content')
                <!-- ============================================================== -->
                <!-- end content  -->
                <!-- ============================================================== -->


            </div>
        </div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
       @include('.layouts.admin.partials.footer')
        <!-- ============================================================== -->
        <!-- end footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- end main wrapper  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->

@section('js')
    <!-- jquery 3.3.1 -->
    <script src=" {{asset('assets/admin/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- bootstap bundle js -->
    <script src="{{asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.js')}} "></script>
    <!-- slimscroll js -->
    <script src="{{asset('assets/admin/vendor/slimscroll/jquery.slimscroll.js')}} "></script>
    <!-- main js -->
    <script src="{{asset('assets/admin/libs/js/main-js.js')}} "></script>
    <!-- morris-chart js -->
    <script src="{{asset('assets/admin/vendor/charts/morris-bundle/raphael.min.js')}} "></script>
    <script src="{{asset('assets/admin/vendor/charts/morris-bundle/morris.js')}} "></script>
    <script src="{{asset('assets/admin/vendor/charts/morris-bundle/morrisjs.html')}} "></script>
    <!-- chart js -->
    <script src="{{asset('assets/admin/vendor/charts/charts-bundle/Chart.bundle.js')}} "></script>
    <script src="{{asset('assets/admin/vendor/charts/charts-bundle/chartjs.js')}}"></script>
    <!-- dashboard js -->
    <script src="{{asset('assets/admin/libs/js/dashboard-influencer.js')}} "></script>





    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/admin/vendor/datatables/js/dataTables.bootstrap4.min.js')}} "></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('assets/admin/vendor/datatables/js/buttons.bootstrap4.min.js')}} "></script>
    <script src="{{asset('assets/admin/vendor/datatables/js/data-table.js')}} "></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script>
        @if(Session::has('messege'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('messege') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('messege') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('messege') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('messege') }}");
                break;
        }

        @endif
            console.log($errors);
        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error('{{ $error }}','Error',{
            closeButton:true,
            progressBar:true,
        });
        @endforeach
        @endif
    </script>

@show
</body>

</html>
