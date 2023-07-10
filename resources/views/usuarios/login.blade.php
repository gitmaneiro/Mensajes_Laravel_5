<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- App title -->
        <title>Inicio de sesión - Politécnico Santiago Mariño</title>

        <!-- Notification css (Toastr) -->
        <link href="{{ asset('assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Switchery css -->
        <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />

        <!-- App CSS -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="padding-bottom: 0px;">
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class="account-bg">
                <div class="card-box m-b-0" style="border: 5px solid #1f0a75;">
                    <div class="text-xs-center m-t-20">
                        <a href="index.html" class="logo">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="img" class="img-thumbails" width="200px" height="auto">
                        </a>
                    </div>
                    <div class="m-t-30 m-b-20">
                        <div class="col-xs-12" id="respuesta"></div>
                        <div class="col-xs-12 text-xs-center">
                            <h6 class="text-muted text-uppercase m-b-0 m-t-0">Inicio de sesión</h6>
                        </div>
                        {!! Form::open(['route' => 'login.store', 'method' => 'post', 'id' => 'loginForm', 'name' => 'loginForm', 'class' => 'form-horizontal m-t-20 form-validate', 'novalidate' => 'novalidate']) !!}
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    {!! Form::text('username', null, ['placeholder' => 'Nombre de usuario', 'class' => 'form-control', 'id' => 'username', 'required' => true]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    {!! Form::password('password', ['placeholder' => 'Contraseña', 'class' => 'form-control', 'id' => 'password', 'required' => true]) !!}
                                </div>
                            </div>
                            <div class="form-group text-center m-t-30">
                                <div class="col-xs-12">
                                    {!! Form::button('Ingresar', ['class'=> 'btn btn-facebook btn-block waves-effect waves-light', 'id' => 'loginButton', 'type' => 'submit']) !!}
                                </div>
                            </div>
                            <div class="form-group m-t-30 m-b-0">
                                <div class="col-sm-12">
                                    <a href="{{ URL::route('restaurarContrasena') }}" class="text-muted"><i class="fa fa-lock m-r-5"></i> ¿Olvidó su contraseña?</a>
                                </div>
                            </div>
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
            <!-- end card-box-->
        </div>
        <!-- end wrapper page -->

        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/tether.min.js') }}"></script><!-- Tether for Bootstrap -->
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

        <!-- App js -->
        <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.app.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

    </body>
</html>