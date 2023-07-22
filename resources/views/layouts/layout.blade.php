<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
  <title>
    Argon Dashboard
  </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />

  <link id="pagestyle" href="{{asset('assets/css/argon-dashboard.min9c7f.css?v=2.0.5')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">

  <style>
    .async-hide {
      opacity: 0 !important
    }
  </style>
      <link rel="stylesheet" href="{{ asset('assets/datepicker/daterangepicker.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/dataTable/datatables.min.css')}}" type="text/css">
  <script src="{{asset('assets/js/analytics.js')}}"></script>
  @yield('style')

</head>

<body class="g-sidenav-show   bg-gray-100">

  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  @include('layouts.sidebar')

  <main class="main-content position-relative border-radius-lg ">
    @include('layouts.navbar')


    <div class="container-fluid py-4">
      @yield('content')
    </div>
  </main>
  @include('layouts.footer')

    <!-- DataTable -->
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="{{ asset('assets/dataTable/datatables.min.js')}}"></script>
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.bundle.min.js')}}"></script>
  {{-- <script src="{{asset('assets/js/core/jquery.slim.min.js')}}"></script> --}}
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>

  <script src="{{asset('assets/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/jkanban/jkanban.js')}}"></script>
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <script src="{{asset('assets/js/common.js')}}"></script>
  <script src="{{ asset('assets/datepicker/daterangepicker.js')}}"></script>

  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{ asset('assets/js/toastr.min.js')}}"></script>

  <script src="{{asset('assets/js/argon-dashboard.min9c7f.js?v=2.0.5')}}"></script>
@include('layouts.notification')
  @yield('script')

</body>

</html>
