<!-- general form elements -->
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Solicitud</h3>
	</div>
<!-- /.box-header -->
<!-- form start -->
    <form id="form-usuario" method="post" role="form">
		<div class="box-body">
			
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />

  			<input type="hidden" name="id" value="{{$mock->id}}">
			
			<div class="form-group">
				<label for="nombre">Asunto</label>
				<input type="text" class="form-control" id="asunto" name="asunto" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="area">Area (esta viene cargada del area del solicitante...)</label>
				<input type="text" class="form-control" id="area" name="area" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="beneficiario">Beneficiario (apra quien o para donde va el viatico)</label>
				<input type="text" class="form-control" id="beneficiario" name="beneficiario" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="cedula">C&eacute;dula</label>
				<input type="text" class="form-control" id="cedula" name="cedula" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="rif">RIF</label>
				<input type="text" class="form-control" id="rif" name="rif" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="fecha_solicitud">Fecha solicitud para cuando es el viatico (DATEPICKER)</label>
				<input type="text" class="form-control" id="fecha_solicitud" name="fecha_solicitud" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripci&oacute;n</label>
				<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="monto">Monto</label>
				<input type="text" class="form-control" id="monto" name="monto" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label>Cuenta</label>
				<select class="form-control" id="cuenta" name="cuenta" >
				@foreach($cuentas as $cuenta)
					<option value="{{$cuenta->id}}">{{$cuenta->nombre}}</option>
				@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Area</label>
				<select class="form-control" id="cuenta" name="cuenta" >
				@foreach($areas as $area)
					<option value="{{$area->id}}">{{$area->nombre}}</option>
				@endforeach
				</select>
			</div>
			
		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
</div>
<!-- /.box -->