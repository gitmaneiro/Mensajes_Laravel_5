<!-- Top Bar Start -->
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{ URL::route('principal') }}" class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="img" class="img-thumbails" width="50px" height="auto">
            <span>Mensajes</span>
        </a>
    </div>
    <nav class="navbar navbar-custom">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="zmdi zmdi-menu"></i>
                </button>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            @if(Auth::check())
            <li class="nav-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @if(Auth::user()->path == '')
                    <img src="{{ asset('uploads/usuarios/unfile.png') }}" alt="user" class="img-circle">
                    @else
                    <img src="{{ asset('uploads/usuarios/'.Auth::user()->path) }}" alt="Foto de {{ Auth::user()->username }}" class="img-circle">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="text-overflow"><small>Bienvenido {!! Auth::user()->name !!}</small> </h5>
                    </div>
                    <a href="{{ URL::route('usuarios.show', Auth::user()->id) }}" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-account-circle"></i> <span>Perfil</span>
                    </a>
                    <!-- item-->
                    <a href="{{ URL::route('logout') }}" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-power"></i> <span>Salir</span>
                    </a>
                </div>
            </li>
            @endif
        </ul>
    </nav>
</div>
<!-- Top Bar End -->