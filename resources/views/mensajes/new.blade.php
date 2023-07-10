@extends('layouts.base')

@section('titulo')
    <title>Nuevo mensaje - Politécnico Santiago Mariño</title>
@stop

@section('content')
@include('layouts.breadcum', ['titulo' => 'Nuevo mensaje', 'tituloModulo' => 'Mensajes', 'rutaModulo' => URL::route('mensajes.index'), 'tituloSubmodulo' => 'Nuevo mensaje'])
<div class="row">
	<div class="col-xs-12">
		<div class="card-box">
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-12">
					{!! Form::open(['route' => 'mensajes.store', 'method' => 'post', 'id' => 'mensajeForm', 'name' => 'mensajeForm', 'class' => '', 'novalidate' => 'novalidate', 'role' => 'form']) !!}
						@include('mensajes.form.MensajeFormType')
						<div class="form-group row">
							<div class="col-sm-6">
							{!! Form::button('Guardar', ['class'=> 'btn btn-primary waves-effect waves-light pull-right', 'id' => 'mensajeSubmit', 'type' => 'submit', 'data' => 1]) !!}
							</div>
							<div class="col-sm-6">
								{!! Form::button('Cancelar', ['class'=> 'btn btn-secondary waves-effect m-l-5', 'id' => 'cancelar', 'type' => 'button', 'onclick' => "document.location.href = '".URL::route('principal')."'"]) !!}
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