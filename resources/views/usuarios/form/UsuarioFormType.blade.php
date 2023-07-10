<div class="p-20">
	<div class="form-group row">
		<label for="file" class="col-sm-2 col-sm-offset-3 form-control-label">Imagen</label>
		<div class="col-sm-4">
			{!! Form::file('file', $attributes = array('class' => 'form-control file-styled', 'id' => 'file', 'accept' => 'image/jpg,image/png,image/jpeg,image/gif')) !!}
		</div>
	</div>
	<div class="form-group row">
		<label for="email" class="col-sm-2 col-sm-offset-3 form-control-label">Correo Electrónico <span class="text-danger">*</span></label>
		<div class="col-sm-4">
			{!! Form::email('email', null, ['placeholder' => 'Correo electrónico', 'class' => 'form-control', 'id' => 'email', 'required' => true]) !!}
		</div>
	</div>
	<div class="form-group row">
		<label for="name" class="col-sm-2 col-sm-offset-3 form-control-label">Nombre <span class="text-danger">*</span></label>
		<div class="col-sm-4">
			{!! Form::text('name', null, ['placeholder' => 'Apellidos y nombres', 'class' => 'form-control', 'id' => 'name', 'required' => true]) !!}
		</div>
	</div>
	<div class="form-group row">
		<label for="cedula" class="col-sm-2 col-sm-offset-3 form-control-label">Cédula <span class="text-danger">*</span></label>
		<div class="col-sm-4">
			{!! Form::text('cedula', null, ['placeholder' => 'Cédula', 'class' => 'form-control', 'id' => 'cedula', 'required' => true]) !!}
		</div>
	</div>
	<div class="form-group row">
		<label for="username" class="col-sm-2 col-sm-offset-3 form-control-label">Nombre de usuario <span class="text-danger">*</span></label>
		<div class="col-sm-4">
			{!! Form::text('username', null, ['placeholder' => 'Nombre de usuario', 'class' => 'form-control', 'id' => 'username', 'required' => true]) !!}
		</div>
	</div>
	<div class="form-group row">
		<label for="password" class="col-sm-2 col-sm-offset-3 form-control-label">Contraseña <span class="text-danger">*</span></label>
		<div class="col-sm-4">
			{!! Form::password('password', ['placeholder' => 'Contraseña', 'class' => 'form-control', 'id' => 'password', 'required' => true]) !!}
		</div>
	</div>
	<div class="form-group row">
		<label for="password_confirmation" class="col-sm-2 col-sm-offset-3 form-control-label">Repetir contraseña <span class="text-danger">*</span></label>
		<div class="col-sm-4">
			{!! Form::password('password_confirmation', ['placeholder' => 'Repetir contraseña', 'class' => 'form-control', 'id' => 'password_confirmation', 'required' => true]) !!}
		</div>
	</div>
	<div class="form-group row">
		<label for="details" class="col-sm-2 col-sm-offset-3 form-control-label">Detalles</label>
		<div class="col-sm-4">
			{!! Form::textarea('details', null, $attributes = array('id' => 'details', 'class' => 'form-control', 'rows' => '3', 'placeholder' => 'Detalles')) !!}
		</div>
	</div>
</div>