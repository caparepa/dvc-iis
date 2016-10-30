<!-- general form elements -->
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Formulario usuario</h3>
	</div>
<!-- /.box-header -->
<!-- form start -->
	<form id="form-usuario" method="post" role="form">
		<div class="box-body">

      
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
  
      <input type="hidden" name="id" value="{{$mock->id}}">
      
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

      @if($mock->id == Auth::user()->id)
			<div class="form-group">
				<label for="password">Contrase&ntilde;a</label>
				<input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
			</div>
      <div class="form-group">
        <label for="password">Confirmaci&oacute;n de contrase&ntilde;a</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="" placeholder="Password">
      </div>
      @endif
      
      @if($mock->isAdmin() || $mock->isTech())
      <div class="form-group">
        <label>Rol</label>
        <select class="form-control" id="rol" name="rol">
          @foreach($roles as $key => $value)
          <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>&Aacute;rea</label>
        <select class="form-control" id="area" name="area">
          @foreach($areas as $area)
          <option value="{{$area->id}}">{{$area->nombre}}</option>
          @endforeach
        </select>
      </div>
      @else
      <input type="hidden" value="{{$mock->rol}}" name="rol" />
      <input type="hidden" value="{{$mock->id_area}}" name="id_area" />
      @endif
			<div class="form-group ">
				<label for="avatar">File input</label>
				<input type="file" id="avatar" name="avatar">

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
@section('scripts')
<script type="text/javascript">
    $('#form-usuario').bootstrapValidator({
      fields: {
        nombre: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un nombre'
                }
            }
      	},
      	apellido: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un apellido'
                }
            }
      	},
      	cedula: {
            validators: {
                regexp: {
                	regexp: /^([VvEe][-]\d{7,8})$/ ,
                    message: 'Por favor, introduzca una cédula en formáto válido. E.g. V19204856'
                }
            }
      	},
      	rif: {
            validators: {
                regexp: {
                	regexp: /^([VvEeJjGg][-]\d{8}[-][0-9])$/ ,
                    message: 'Por favor, introduzca un rif en formato válido. E.g. J-12345678-9'
                }
            }
      	},
      	telefono_hab: {
            validators: {
                numeric: {
                    message: 'Por favor, introduzca un valor numérico.'
                }
            }
      	},
      	telefono_cell: {
            validators: {
                numeric: {
                    message: 'Por favor, introduzca un valor numérico.'
                }
            }
      	},
        email: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un código.'
                },
                remote: {
                  url: '/viaticos/usuarios/validate-email/',
                  data: function(validator) {
                        return {
                            id: validator.getFieldElements('id').val()
                        };
                    },
                }
            }
        },
        password: {
            validators: {
                identical: {
                  field: 'password_confirmation',
                  message: 'La clave introducida y su confirmación no son idénticas.'
                }
            },
        },
        password_confirmation: {
            validators: {
                identical: {
                  field: 'password',
                  message: 'La clave introducida y su confirmación no son idénticas.'
                }
            }
        },
      },

    });
</script>
@endsection