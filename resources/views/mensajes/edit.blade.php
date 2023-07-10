@extends('layouts.base')

@section('titulo')
    <title>Actualizar mensaje - Politécnico Santiago Mariño</title>
@stop

@section('content')
@include('layouts.breadcum', ['titulo' => 'Editar mensaje', 'tituloModulo' => 'Mensajes', 'rutaModulo' => URL::route('mensajes.index'), 'tituloSubmodulo' => 'Editar mensaje'])
<div class="row">
	<div class="col-xs-12">
		<div class="card-box">
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-12">
					{!! Form::model($mensaje, array('route' => ['mensajes.update', $mensaje->id], 'method' => 'PUT', 'id' => 'mensajeForm', 'name' => 'mensajeForm', 'class' => '', 'novalidate' => 'novalidate', 'role' => 'form')) !!}
						@include('mensajes.form.MensajeFormType')
						<div class="form-group row">
							<div class="col-sm-6">
							{!! Form::button('Actualizar', ['class'=> 'btn btn-primary waves-effect waves-light pull-right', 'id' => 'mensajeSubmit', 'type' => 'submit', 'data' => 0]) !!}
							</div>
							<div class="col-sm-6">
								{!! Form::button('Cancelar', ['class'=> 'btn btn-secondary waves-effect m-l-5', 'id' => 'cancelar', 'type' => 'button', 'onclick' => "document.location.href = '".URL::route('mensaje.index')."'"]) !!}
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