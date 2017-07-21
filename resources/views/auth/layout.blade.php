<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" href="{{url('md/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{url('md/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{url('md/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{url('md/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{url('md/css/style.css')}}" rel="stylesheet">
    <link href="{{url('md/css/project-style.css')}}" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
    <div class="card">
        <div class="header" style="background: #111111">
           <div class="logo">
                <a href="{{ url(config('whyte.project.link')) }}"><img src="{{ url(config('whyte.project.logo')) }}"></a>
                <small>{{ config('whyte.project.subname') }}</small>
            </div>
        </div>
        <div class="body">
            @yield('content')
        </div>
        <footer class="text-center">
            <a class="col-white" target="_blank" href="{{ url(config('whyte.admin.copyright_link'))}}">{{config('whyte.admin.copyright')}}</a>
        </footer>
    </div>
    </div>


    @section('scripts')
    <!-- Jquery Core Js -->
    <script src="{{url('md/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{url('md/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{url('md/plugins/node-waves/waves.js')}}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{url('md/plugins/jquery-validation/jquery.validate.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{url('md/js/admin.js')}}"></script>
   @show
</body>

</html>