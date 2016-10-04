<!-- general form elements -->
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Quick Exampleaaa</h3>
	</div>
<!-- /.box-header -->
<!-- form start -->
	<form id="form-usuario" method="post" role="form">
		<div class="box-body">
			
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />

			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control" id="nombre" name="nombre" value="{{$mock->nombre}}" placeholder="Nombre">
			</div>
			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" class="form-control" id="apellido" name="apellido" value="{{$mock->apellido}}" placeholder="Apellido">
			</div>
			<div class="form-group">
				<label for="cedula">C&eacute;dula</label>
				<input type="text" class="form-control" id="cedula" name="cedula" value="{{$mock->cedula}}" placeholder="Cédula">
			</div>
			<div class="form-group">
				<label for="rif">RIF</label>
				<input type="text" class="form-control" id="rif" name="rif" value="{{$mock->rif}}" placeholder="RIF">
			</div>
			<div class="form-group">
				<label for="telefono_hab">Tel&eacute;fono hab.</label>
				<input type="text" class="form-control" id="telefono_hab" name="telefono_hab" value="{{$mock->telefono_hab}}" placeholder="Teléfono hab.">
			</div>
			<div class="form-group">
				<label for="telefono_cell">Tel&eacute;fono cel.</label>
				<input type="text" class="form-control" id="telefono_cell" name="telefono_cell" value="{{$mock->telefono_cell}}" placeholder="Teléfono cel.">
			</div>
			<div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control" id="email" name="email" value="{{$mock->email}}" placeholder="Email">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" value="{{$mock->password}}" placeholder="Password">
			</div>
			<div class="form-group">
				<label>Rol</label>
				<select class="form-control">
					@foreach($roles as $key => $value)
					<option value="{{$key}}">{{$value}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group ">
				<label for="exampleInputFile">File input</label>
				<input type="file" id="exampleInputFile">

				<p class="help-block">Example block-level help text here.</p>
			</div>
			
		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
</div>
<!-- /.box -->