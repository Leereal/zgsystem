<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} |</title>
        <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/ico" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                background-image: url("{{asset('images/medical.jpg') }}");
                 /* Center and scale the image nicely */
                  background-position: center;
                  background-repeat: no-repeat;
                  background-size: cover;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;S
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

            .links > a {                
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

           a:link, a:visited {
              background-color: white;
              color: black;
              border: 2px solid green;
              padding: 10px 20px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
            }

            a:hover, a:active {
              background-color: green;
              color: white;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body >
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}"><strong>Home</strong></a>
                    @else
                        <a href="{{ route('login') }}"><strong>Login</strong></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"><strong>Register</strong></a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">

                <div class="title m-b-md" style="color:red">
                    <strong>ZIM GENERAL MEDICAL AID SYSTEM</strong>
                </div>           
            </div>
        </div>
    </body>
</html>
