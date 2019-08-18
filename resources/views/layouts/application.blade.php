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

        <title>Gentelella Alela! | </title>

        <!-- Bootstrap -->
        <link href="{{ mix("/assets/css/styles.css") }}" rel="stylesheet">

    </head>

    <body class="nav-md">

        <div class="container body">
      
            <div class="main_container">

                <!-- side menu -->
                <div class="col-md-3 left_col">
                  
                    @include('partials.main_menu')

                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    @include('partials.navigation')
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div>
                    @yield('content')
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ mix("/assets/js/app.js") }}"></script>
    
    </body>

</html>