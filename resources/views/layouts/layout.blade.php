<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset( 'css/bootstrap.min.css' ) }}">
        <script src="{{ asset( 'js/bootstrap.min.js' ) }}"></script>
        {{-- <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-qccLsX56K1gG9ra9ATbCwSAyzkdPW3V4ibNv7Lmg57prpXTG3j7lbW6yoNxERfdb" crossorigin="anonymous"></script> --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSkt5YtBfI6RX6ttHGiA6GhAnkuXnAhsUibXEzJ8G" crossorigin="anonymous"> --}}



        <!-- Styles -->
<style>
    .clicked {
            background-color: #8B0000 !important; /* Tomato background */
            color: #fff !important; /* White text color */
        }


</style>
    </head>
    <body>

      @yield('content')


    </body>
</html>
