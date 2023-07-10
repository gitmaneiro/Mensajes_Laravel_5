<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- App title -->
        @section('titulo')
        <title>Politécnico Santiago Mariño</title>
        @show

        <!-- Notification css (Toastr) -->
        <link href="{{ asset('assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Switchery css -->
        <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />

        <!-- Sweet Alert css -->
        <link href="{{ asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
        <!-- DataTables -->
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        @section('estilos')
        @show
    </head>
    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            @include('layouts.topbar')
            @include('layouts.sidebar')
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        @section('content')
                            @include('layouts.breadcum', ['titulo' => 'Pantalla principal'])
                            @if(isset($configuracion->velocidad))
                            <marquee height="400px" direction="up" loop="infinite" scrolldelay="{!! $configuracion->velocidad !!}" scrollamount="5">
                                <div class="row" id="mensajes"></div>
                            </marquee>
                            @endif
                            
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @show
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>
            <!-- End content-page -->
            @include('layouts.right-sidebar')
            <footer class="footer text-right">2017 © Instituto Universitario Politécnico Santiago Mariño - Maturín, Monagas.</footer>
        </div>
        <!-- END wrapper -->

        <!-- Modernizr js -->
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <!-- Tether for Bootstrap -->
        <script src="{{ asset('assets/js/tether.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/detect.js') }}"></script>
        <script src="{{ asset('assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>

        <!-- Toastr js -->
        <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

        <!-- Sweet Alert js -->
        <script src="{{ asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
        <script src="{{ asset('assets/pages/jquery.sweet-alert.init.js') }}"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

        <script src="{{ asset('assets/js/custom.js') }}"></script>

        @section('javascripts')
        <script language="javascript">
            var timestamp = null;
            var mensaje = null;
            var id = null;
            var status = null;
            var urlHttpush = "{!! URL::route('httpush') !!}";
            var urlMensajes = "{!! URL::route('messages') !!}";
            var token = $("input[name=_token]").val();
            function cargar_push() { 
                $.ajax({
                    async:  true, 
                    type: "POST",
                    url: urlHttpush,
                    headers: {'X-CSRF-TOKEN' : token},
                    data: "&timestamp="+timestamp,
                    dataType:"json",
                    success: function(data) {
                        timestamp = data.json["timestamp"];
                        mensaje = data.json.mensaje;
                        id = data.json.id;
                        status = data.json.status;
                        if(timestamp != null) {
                            $.ajax({
                                async:  true, 
                                type: "POST",
                                url: urlMensajes,
                                headers: {'X-CSRF-TOKEN' : token},
                                data: "",
                                dataType:"json",
                                success: function(data) { 
                                    for(var i = 0; i < (data.respuesta).length; i++) {
                                        toastr.options = {
                                          closeButton: true,
                                          debug: false,
                                          newestOnTop: false,
                                          progressBar: false,
                                          positionClass: "toast-top-right",
                                          preventDuplicates: true,
                                          showDuration: "300",
                                          hideDuration: "1000",
                                          timeOut: "5000",
                                          extendedTimeOut: "1000",
                                          showEasing: "swing",
                                          hideEasing: "linear",
                                          showMethod: "fadeIn",
                                          hideMethod: "fadeOut"
                                        }
                                        toastr["info"](data.respuesta[i].mensaje, data.respuesta[i].status);
                                    }
                                    $("#mensajes").html(data.mensajesPantalla);
                                }
                            }); 
                        }
                        setTimeout('cargar_push()',1000);
                    }
                });     
            }
            $(document).ready(function() {
                cargar_push();
            });  
        </script>
        @show

    </body>
</html>