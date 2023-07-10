@extends('layouts.base')

@section('titulo')
    <title>Nuevo usuario - Politécnico Santiago Mariño</title>
@stop

@section('content')
@include('layouts.breadcum', ['titulo' => 'Registro de usuario', 'tituloModulo' => 'Usuarios', 'rutaModulo' => URL::route('usuarios.index'), 'tituloSubmodulo' => 'Registrar usuario'])
<div class="row">
	<div class="col-xs-12">
		<div class="card-box">
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-12">
					{!! Form::open(['route' => 'usuarios.store', 'method' => 'post', 'id' => 'usuarioForm', 'name' => 'usuarioForm', 'class' => '', 'novalidate' => 'novalidate', 'role' => 'form']) !!}
						@include('usuarios.form.UsuarioFormType')
						<div class="form-group row">
							<div class="col-sm-6">
							{!! Form::button('Guardar', ['class'=> 'btn btn-primary waves-effect waves-light pull-right', 'id' => 'usuarioSubmit', 'type' => 'submit', 'data' => 1]) !!}
							</div>
							<div class="col-sm-6">
								{!! Form::button('Cancelar', ['class'=> 'btn btn-secondary waves-effect m-l-5', 'id' => 'cancelar', 'type' => 'button', 'onclick' => "document.location.href = '".URL::route('usuarios.index')."'"]) !!}
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