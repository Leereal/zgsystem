<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/ico" />
    <title>{{ config('app.name', 'Laravel') }} | </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
    <!-- page content -->
        @yield('content')
        <!-- /page content -->
</html>
