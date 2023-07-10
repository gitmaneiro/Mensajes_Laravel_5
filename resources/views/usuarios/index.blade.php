@extends('layouts.base')

@section('titulo')
<title>Listado de usuarios - Politécnico Santiago Mariño</title>
@stop

@section('content')
@include('layouts.breadcum', ['titulo' => 'Listado de usuarios', 'tituloModulo' => 'Usuarios'])
<div class="row">
	<div class="col-sm-12">
		<div class="card-box table-responsive">
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Cédula</th>
						<th>Nombre</th>
						<th>Email</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
						<tr>
							<td>{{ number_format($user->cedula, 0, '', '.') }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
							<td>
								<a href="{{ URL::route('usuarios.show', $user->id) }}" data-rel="tooltip" title="Mostrar {{ $user->username }}" objeto="{{ $user->username }}" class="btn waves-effect waves-light btn-primary"> 
									<i class="fa fa-eye"></i>
								</a>&nbsp;
								<a href="{{ URL::route('usuarios.edit', $user->id) }}" class="tooltip-success editar btn waves-effect waves-light btn-warning " data-rel="tooltip" title="Editar {{ $user->username }}" objeto="{{ $user->username }}" style="text-decoration:none;"> 
									<i class="fa fa-edit"></i>
								</a>&nbsp;
								<a href="#" data-id="{{ $user->id }}" class="tooltip-error borrar btn waves-effect waves-light btn-danger" data-rel="tooltip" title="Eliminar {{ $user->username }}" objeto="{{ $user->id }}"> 
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
						@endforeach
				</tbody>
			</table>
			{!! Form::open(array('route' => array('usuarios.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) !!}
            {!! Form::close() !!}
		</div>
	</div>
</div> <!-- end row -->
@stop

@section('javascripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable').DataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ resultados por página",
				"zeroRecords": "Sin resultados",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "Sin ninguna información",
				"infoFiltered": "(Filtrado de _MAX_ resultados totales)",
				"search":         "Buscar:",
				"paginate": {
					"first":      "Primero",
					"last":       "Último",
					"next":       "Siguiente",
					"previous":   "Anterior"
				},
			}
		});

		@if(Session::has('message'))
			setTimeout(function () {
				var mensaje1 = "{{ Session::get('message') }}";
				swal("¡Eliminado!", mensaje1, "success");
			}, 10);
		@endif

        if ($('.tooltip-error').length) {
           $('.tooltip-error').click(function (e) {
                e.preventDefault();
                var message = "¿Está realmente seguro(a) de eliminar este usuario?";
                var id = $(this).data('id');
                var form = $('#form-delete');
                var action = form.attr('action').replace('USER_ID', id);
                var row =  $(this).parents('tr');
                swal({
                    title: message,
                    //text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonClass: 'btn-secondary waves-effect',
                    confirmButtonClass: 'btn-warning',
                    confirmButtonText: "Si",
                    cancelButtonText: "No",
                    closeOnConfirm: false
                }, function () {
                    row.fadeOut(1000);
                    $.post(action, form.serialize(), function(result) {
                        if (result.success) {
                            row.delay(1000).remove();
                            swal("¡Eliminado!", result.msg, "success");                
                        } 
                        else 
                            row.show();
                    }, 'json');
                });
            });
        }
	});
</script>
@stop