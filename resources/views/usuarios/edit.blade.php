@extends('layouts.base')

@section('titulo')
    <title>Actualizar usuario - Politécnico Santiago Mariño</title>
@stop

@section('content')
@include('layouts.breadcum', ['titulo' => 'Editar usuario', 'tituloModulo' => 'Usuarios', 'rutaModulo' => URL::route('usuarios.index'), 'tituloSubmodulo' => 'Editar usuario'])
<div class="row">
	<div class="col-xs-12">
		<div class="card-box">
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-12">
					{!! Form::model($user, array('route' => ['usuarios.update', $user->id], 'method' => 'PUT', 'id' => 'usuarioEditarForm', 'name' => 'usuarioEditarForm', 'class' => '', 'novalidate' => 'novalidate', 'role' => 'form')) !!}
						@include('usuarios.form.UsuarioEditFormType')
						<div class="form-group row">
							<div class="col-sm-6">
							{!! Form::button('Actualizar', ['class'=> 'btn btn-primary waves-effect waves-light pull-right', 'id' => 'usuarioEditarSubmit', 'type' => 'submit', 'data' => 0]) !!}
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