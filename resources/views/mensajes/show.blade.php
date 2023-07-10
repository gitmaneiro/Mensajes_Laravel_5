@extends('layouts.base')

@section('titulo')
    <title>Datos del mensaje "{{ $mensaje->status }}" - Politécnico Santiago Mariño</title>
@stop

@section('content')
@include('layouts.breadcum', ['titulo' => 'Información del mensaje', 'tituloModulo' => 'Mensajes', 'rutaModulo' => URL::route('mensajes.index'), 'tituloSubmodulo' => 'Información del mensaje'])
<div class="row">
	<div class="col-xs-12">
		<div class="card-box table-responsive">
			{!! Form::open(['route' => ['mensajes.destroy', $mensaje->id], 'method' =>'DELETE', 'id' => 'form-eliminar-mensaje']) !!}
			<table id="datatable" class="table table-striped table-bordered">
				<tr>
					<th>Asunto: </th>
					<td>{{ $mensaje->status }}</td>
				</tr>
				<tr>
					<th>Mensaje: </th>
					<td>{{ $mensaje->mensaje }}</td>
				</tr>
				<tr>
					<th>Creado: </th>
					<td>{{ date_format($mensaje->created_at, 'd/m/Y H:i:s') }}</td>
				</tr>
				<tr>
					<th>Actualizado: </th>
					<td>{{ date_format($mensaje->updated_at, 'd/m/Y H:i:s') }}</td>
				</tr>
				@if(Auth::check())
				<tr>
					<th>Acciones</th>
					<td>
						<a href="{{ URL::route('mensajes.edit', $mensaje->id) }}" class="btn btn-warning btn-icon" title="Editar {{ $mensaje->status }}">
                            <i class="zmdi zmdi-edit"></i> Editar
                        </a>
                        <a href="javascript:{}" data-id="{{ $mensaje->id }}" class="btn btn-danger btn-icon tooltip-error borrar" data-rel="tooltip" title="Eliminar {{ $mensaje->status }}" objeto="{{ $mensaje->id }}">
                            <i class="zmdi zmdi-delete"></i> Eliminar
                        </a>
					</td>
				</tr>
				@endif
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
			var message = "¿Está realmente seguro(a) de eliminar este mensaje?";
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