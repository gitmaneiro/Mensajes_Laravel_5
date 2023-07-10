<div class="row">
 <div class="col-xs-12">
    <div class="page-title-box">
        <h4 class="page-title">{{ $titulo }}</h4>
        <ol class="breadcrumb p-0">
            <li>
                <a href="{{ URL::route('principal') }}">Inicio</a>
            </li>
            @if(isset($tituloModulo))
            <li @if(!isset($tituloSubmodulo)) class="active" @endif >
                @if(isset($tituloSubmodulo))
                <a href="{{ $rutaModulo }}">{{ $tituloModulo }}</a>
                @else
                {{ $tituloModulo }}
                @endif
            </li>
            @endif
            @if(isset($tituloSubmodulo))
            <li class="active">
                {{ $tituloSubmodulo }}
            </li>
            @endif
        </ol>
        <div class="clearfix"></div>
    </div>
</div>
</div>
<!-- end row -->