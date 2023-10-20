<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CHURCH GESTOR</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        body {
            background-image: url("{{ URL::asset('img/church_bg.jpg') }}");
            background-color: #cccccc;
            background-size: cover;
        }

        /* append */
        .auth-link a {
            color: silver;
            background-color: #636b6f;
            padding: 1em;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">

            <div class="top-right links auth-link">
            </div>
  

        <div class="panel">
            <div class="content">
                <div class="title m-b-md panel-heading">
                    <b>BIENVENIDO</b>
                </div>
                <b><i>Gestión de miembros y grupos</i></b>
                <div class="panel-footer">
                    <b>
                        <h3 class="text-primary font-weight-bold">Un producto de: <a href="http://myckhel.adbin.com.ng">
                                {{ env('APP_NAME') }}</a></h3>
                    </b>
                </div>
            </div>
            <div class="panel-footer">
                <div class="content">
                    @if (Route::has('login'))
                        <div class="auth-link links">
                            @auth
                                <a href="{{ url('/dashboard') }}">Comenzar</a>
                            @else
                                <a href="{{ route('login') }}">Login</a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
