@extends('layouts.base')

@section('titulo')
    <title>Actualizar configuración - Politécnico Santiago Mariño</title>
@stop

@section('content')
@include('layouts.breadcum', ['titulo' => 'Editar configuración'])
<div class="row">
	<div class="col-xs-12">
		<div class="card-box">
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-12">
					{!! Form::model($configuracion, array('route' => ['postEditarConfiguracion'], 'method' => 'PUT', 'id' => 'configuracionForm', 'name' => 'configuracionForm', 'class' => '', 'novalidate' => 'novalidate', 'role' => 'form')) !!}
						
						<div class="p-20">
							<div class="form-group row">
								<label for="cantidadMensajes" class="col-sm-3 col-sm-offset-2 form-control-label">Cantidad de mensajes a mostrar <span class="text-danger">*</span></label>
								<div class="col-sm-4">
									{!! Form::input('number', 'cantidadMensajes', null, ['placeholder' => 'Cantidad de mensajes', 'class' => 'form-control', 'id' => 'cantidadMensajes', 'required' => true]) !!}
								</div>
							</div>
							<div class="form-group row">
								<label for="velocidad" class="col-sm-3 col-sm-offset-2 form-control-label">Velocidad <span class="text-danger">*</span></label>
								<div class="col-sm-4">
									{!! Form::select('velocidad', array('' => 'Seleccione','30' => 'Rápido', '300' => 'Normal', '3000' => 'Lento'), null, $attributes = array('id' => 'velocidad', 'class' => 'form-control', 'required' => 'required')) !!}
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
							{!! Form::button('Actualizar', ['class'=> 'btn btn-primary waves-effect waves-light pull-right', 'id' => 'configuracionSubmit', 'type' => 'submit', 'data' => 0]) !!}
							</div>
						</div>
					{!! Form::close()!!}
				</div>
			</div>
			<!-- end row -->
		</div>
	</div><!-- end col-->
</div>
<!-- end row -->
@stop