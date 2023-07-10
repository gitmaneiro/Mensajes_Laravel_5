<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft"> 
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">Menú principal</li>
                <li>
                    <a href="{{ URL::route('principal') }}" class="waves-effect">
                        <i class="zmdi zmdi-home"></i><span> Inicio </span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('mensajes.index') }}" class="waves-effect">
                        <i class="zmdi zmdi-collection-text"></i><span> Ver mensajes </span>
                    </a>
                </li>
                @if (Auth::check())
                <li>
                    <a href="{{ URL::route('mensajes.create') }}" class="waves-effect">
                        <i class="zmdi zmdi-email"></i><span> Enviar mensaje </span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('editarConfiguracion') }}" class="waves-effect">
                        <i class="zmdi zmdi-settings"></i><span> Configuración </span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('usuarios.create') }}" class="waves-effect">
                        <i class="zmdi zmdi-account-add"></i><span> Agregar usuario </span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('usuarios.index') }}" class="waves-effect">
                        <i class="zmdi zmdi-accounts"></i><span> Ver usuarios </span>
                    </a>
                </li>

                <li>
                    <a href="{{ URL::route('logout') }}" class="waves-effect">
                        <i class="zmdi zmdi-power"></i><span> Cerrar sesión </span>
                    </a>
                </li>
                @else
                <li>
                    <a href="{{ URL::route('login.index') }}" class="waves-effect">
                        <i class="zmdi zmdi-power"></i><span> Iniciar sesión </span>
                    </a>
                </li>
                @endif             
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->