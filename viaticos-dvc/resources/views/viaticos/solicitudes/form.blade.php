<!-- general form elements -->
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Solicitud</h3>
	</div>
<!-- /.box-header -->
<!-- form start -->
    <form id="form-solicitud" method="post" role="form">
		<div class="box-body">
			
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />

  			<input type="hidden" name="id" value="{{$mock->id}}">
			
			<div class="form-group">
				<label for="nombre">Asunto</label>
				<input type="text" class="form-control" id="asunto" name="asunto" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="area">Area (zona de movilización)</label>
				<input type="text" class="form-control" id="area" name="area" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="beneficiario">Beneficiario / Raz&oacute;n social</label>
				<input type="text" class="form-control autocomplete" id="beneficiario" name="beneficiario" placeholder="Enter email">
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
        <label>Fecha</label>

        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control pull-right" id="datepicker" name="fecha_solicitud">
        </div>
        <!-- /.input group -->
      </div>
      <!-- /.form group -->
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
				<select class="form-control" id="id_cuenta" name="id_cuenta" >
				@foreach($cuentas as $cuenta)
					<option value="{{$cuenta->id}}">{{$cuenta->nombre}}</option>
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
@section('scripts')
<script type="text/javascript">
    $('#form-solicitud').bootstrapValidator({
      fields: {
        asunto: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un nombre'
                }
            }
      	},
      	area: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un apellido'
                }
            }
      	},
      	beneficiario: {
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
      	fecha: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un apellido'
                }
            }
      	},
      	descripcion: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un apellido'
                }
            }
      	},
      	monto: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un apellido'
                }
            }
      	},
      	id_cuenta: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un apellido'
                }
            }
      	},
      	id_area: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un apellido'
                }
            }
      	},
      },

    });

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    $(function() {

      var availableTags = [
        "ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++",
        "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran",
        "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl",
        "PHP", "Python", "Ruby", "Scala", "Scheme"
      ];

      /*$(".autocomplete").autocomplete({
        source: '/viaticos/solicitudes/listado-razon-social',
        dataType: 'json',
        success: function(data){
          console.log(data.listado);
        }
      });*/

      $(".autocomplete").autocomplete({
        source: function(request, response){
          $.ajax({
            url: '/viaticos/solicitudes/listado-razon-social',
            data: {term: request.term},
            dataType: 'JSON',
            success: function(data){
              var listado = data.listado;
              var transformed = $.map(listado, function(el){
                return {beneficiario:el.nombre}
              });
              console.log(transformed);
              response(transformed);
            },
            error: function(error){
              console.log(error)
            }
          });
        },
        minLenght: 2
      });
      
      /*$(".autocomplete").autocomplete({
        source: function(request, response){
            $.ajax({
              url: '/viaticos/solicitudes/listado-razon-social',
              data: { query: request.term },
              dataType: 'JSON',
              success: function (data) {
                var listado = data.listado;
                var transformed = $.map(listado, function(el){
                  return { nombre : el.nombre }
                });
                return transformed;
              },
              error: function (error) {
                  console.error(error);
              }
          });
        }
      });*/
    });
</script>
@endsection