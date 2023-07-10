<div class="p-20">
	<div class="form-group row">
		<label for="status" class="col-sm-2 col-sm-offset-3 form-control-label">Asunto <span class="text-danger">*</span></label>
		<div class="col-sm-4">
			{!! Form::text('status', null, ['placeholder' => 'Asunto', 'class' => 'form-control', 'id' => 'status', 'required' => true]) !!}
		</div>
	</div>
	<div class="form-group row">
		<label for="mensaje" class="col-sm-2 col-sm-offset-3 form-control-label">Mensaje <span class="text-danger">*</span></label>
		<div class="col-sm-4">
			{!! Form::textarea('mensaje', null, $attributes = array('id' => 'mensaje', 'class' => 'form-control', 'rows' => '3', 'placeholder' => 'Mensaje')) !!}
		</div>
	</div>
</div>