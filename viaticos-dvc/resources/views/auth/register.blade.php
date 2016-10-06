@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form id="form-registro" class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Apellido</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">C&eacute;dula</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="cedula" value="{{ old('cedula') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">RIF</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="rif" value="{{ old('rif') }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Tel&eacute;fono hab.</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="telefono_hab" value="{{ old('telefono_hab') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Tel&eacute;fono cel.</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="telefono_cell" value="{{ old('telefono_cell') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Contrase&ntilde;a</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmar contrase&ntilde;a</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('#form-registro').bootstrapValidator({
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
                    message: 'Por favor, introduzca un email.'
                },
                emailAddress: {
                  	message: 'Introduzca un formato válido de email.'
                },
                remote: {
                  url: '/validate-email'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca una contraseña.'
                }
            },
            identical: {
                	field: 'password_confirmation',
                	message: 'La clave introducida y su confirmación no son idénticas.'
                }
        },
        password_confirmation: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca confirmación de contraseña.'
                },
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
