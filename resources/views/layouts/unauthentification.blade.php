<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/ico" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Koperasi ITB</title>

        <!-- Bootstrap -->
        <link href="{{ mix("/assets/css/styles.css") }}" rel="stylesheet">

    </head>

    <body class="login">
        
        <div>
            
            @yield("content")

        </div>
    </body>

</html>