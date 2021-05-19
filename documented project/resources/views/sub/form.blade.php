<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT AWESOME -->
    <script src="https://use.fontawesome.com/22792a4a64.js"></script>

    <!-- TinyMCE -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({
            selector: 'textarea.editor',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code',
                'textcolor',
            ],
            toolbar: 'undo redo | insert | styleselect | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            content_css: '//www.tinymce.com/css/codepen.min.css'
        });</script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

    <style>
        body{
            background: #f7fafc !important;
        }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a href="{{ url('/') }}">
                    <img class="navbar-brand" src="{{asset('/img/logo.gif')}}" />
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/home">Home</a>
                    </li>

                    <li>
                        <a href="/video-tutorials">Video Tutorials</a>
                    </li>
                    <li>
                        <a href="/text-tutorials">Text Tutorials</a>
                    </li>
                    <li>
                        <a href="/subscription/">SUBSCRIBE</a>
                    </li>
                    <li>
                        <a href="/about">About</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                        <li>
                                            <a href="/admin-panel">Admin Panel</a>
                                        </li>
                                    @endif
                                @endif

                                @can('create', \App\TextPost::class)
                                    <li>
                                        <a href="/createtext">Create Text Tutorial</a>
                                    </li>
                                @endcan


                                @can('create', \App\VideoPost::class)
                                    <li>
                                        <a href="/createvideo">Create Video Tutorial</a>
                                    </li>
                                @endcan


                                <li>
                                    <a href="/change-user-password">Change Password</a>
                                </li>

                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
            @if(!\Illuminate\Support\Facades\Auth::user()->subscribed('main'))
                <div class="row">
                    <div class="col-md-6 text-center col-md-offset-3">
                        <h1>Join now!</h1>
                        <h3>Get full access for $9.99/m</h3>
                        <hr>
                        <form action="/subscription/create/" method="POST">
                            {!! csrf_field() !!}
                            <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="pk_test_DvLJmbNK00POQUlWLsWySXEi"
                                    data-amount="999"
                                    data-name="Team PSV"
                                    data-description="Widget"
                                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                    data-locale="auto">
                            </script>
                        </form>
                    </div>
                </div>
            @elseif(\Illuminate\Support\Facades\Auth::user()->subscription('main')->cancelled())
                <div class="row">
                    <div class="col-md-6 text-center col-md-offset-3">
                        <h1>Your subscription ends at:</h1>
                        <h3>{{\Illuminate\Support\Facades\Auth::user()->subscription('main')->ends_at}}</h3>
                        <hr>
                        <a href="/subscription/resume/" class="btn btn-success">Resume now!</a>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-6 text-center col-md-offset-3">
                        <h1>Thank you for subscribing!</h1>
                        <hr>
                        <a href="/subscription/cancel/" class="btn btn-danger">Cancel subscription</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Scripts -->
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
