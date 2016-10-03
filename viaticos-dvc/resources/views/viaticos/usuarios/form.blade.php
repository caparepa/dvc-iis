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
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Enter email">
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
				<label for="telefono_hab">Tel&eacute;fono hab.</label>
				<input type="text" class="form-control" id="telefono_hab" name="telefono_hab" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="telefono_cell">Tel&eacute;fono cel.</label>
				<input type="text" class="form-control" id="telefono_cell" name="telefono_cell" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			</div>
			<div class="form-group">
				<label>Rol</label>
				<select class="form-control">
					<option>option 1</option>
					<option>option 2</option>
					<option>option 3</option>
					<option>option 4</option>
					<option>option 5</option>
				</select>
			</div>
			<div class="form-group ">
				<label for="exampleInputFile">File input</label>
				<input type="file" id="exampleInputFile">

				<p class="help-block">Example block-level help text here.</p>
			</div>
			<div class="checkbox">
				<label>
				  <input type="checkbox"> Check me out
				</label>
			</div>

		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
</div>
<!-- /.box -->