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

        <!-- swal -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
        
    </head>

    <body class="nav-md">

        @inject('helper', 'App\Helpers\AppHelper')

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
                        Koperasi ITB
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ mix("/assets/js/app.js") }}"></script>

        <!-- swal -->            
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

        <script type="text/javascript">
            //DISABLE BUTTON SUBMIT
            function submitForm(btn) {

                $(document).ready(function() {
                    $(document).on('submit', 'form', function() {
                        btn.attr('disabled', 'disabled');
                    });
                });

                // $.listen('parsley:form:validated', function(e){
                //     if (e.validationResult) {
                //         btn.disabled = true;
                //         btn.form.submit();

                //     }
                // });
            }

            setTimeout(function() {
                $('#successMessageAlert').fadeOut('fast');
            }, 5000);
        </script>

        @yield("js")
    
    </body>

</html>