@extends('layouts.base')

@section('titulo')
    <title>Datos del usuario "{{ $user->name }}" - Politécnico Santiago Mariño</title>
@stop

@section('content')
@include('layouts.breadcum', ['titulo' => 'Información del usuario', 'tituloModulo' => 'Usuarios', 'rutaModulo' => URL::route('usuarios.index'), 'tituloSubmodulo' => 'Información del usuario'])
<div class="row">
	<div class="col-xs-12">
		<div class="card-box table-responsive">
			{!! Form::open(['route' => ['usuarios.destroy', $user->id], 'method' =>'DELETE', 'id' => 'form-eliminar-usuario']) !!}
			<table id="datatable" class="table table-striped table-bordered">
				<tr>
					<th>Imagen: </th>
					<td>
						@if($user->path == '')
                        <img src="{{ asset('uploads/usuarios/unfile.png') }}" alt="user" class="img-thumbails" width="100px" height="auto">
                        @else
                        <img src="{{ asset('uploads/usuarios/'.$user->path) }}" alt="Foto de {{ $user->username }}" class="img-thumbails" width="100px" height="auto">
                        @endif
					</td>
				</tr>
				<tr>
					<th>Nombre de usuario: </th>
					<td>{{ $user->username }}</td>
				</tr>
				<tr>
					<th>Nombre: </th>
					<td>{{ $user->name }}</td>
				</tr>
				<tr>
					<th>Cédula: </th>
					<td>{{ number_format($user->cedula, 0, '', '.') }}</td>
				</tr>
				<tr>
					<th>Correo: </th>
					<td>{{ $user->email }}</td>
				</tr>
				<tr>
					<th>Detalles: </th>
					<td>{{ $user->details }}</td>
				</tr>
				<tr>
					<th>Acciones</th>
					<td>
						<a href="{{ URL::route('usuarios.edit', $user->id) }}" class="btn btn-warning btn-icon" title="Editar {{ $user->name }}">
                            <i class="zmdi zmdi-edit"></i> Editar
                        </a>
                        <a href="javascript:{}" data-id="{{ $user->id }}" class="btn btn-danger btn-icon tooltip-error borrar" data-rel="tooltip" title="Eliminar {{ $user->name }}" objeto="{{ $user->id }}">
                            <i class="zmdi zmdi-delete"></i> Eliminar
                        </a>
					</td>
				</tr>
			</table>
			{!! Form::close() !!}
		</div>
	</div><!-- end col-->
</div>
<!-- end row -->
@stop

@section('javascripts')
<script type="text/javascript">
	$(function () {
		$('.borrar').click(function (e) {
			e.preventDefault();
			var message = "¿Está realmente seguro(a) de eliminar este usuario?";
			var form = $('#form-eliminar-usuario');
			swal({
				title: message,
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: 'btn-secondary waves-effect',
                confirmButtonClass: 'btn-warning',
                confirmButtonText: "Si",
                cancelButtonText: "No",
                closeOnConfirm: false
            }, function () {
            	form.submit();
	        });
		});
	});
</script>
@stop