<!-- general form elements -->
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Rendición de cuentas (WIP)</h3>
	</div>
<!-- /.box-header -->
<!-- form start -->
    <form id="form-rendicion" method="post" role="form">
		<div class="box-body">
			
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />

  			<input type="hidden" name="id" value="{{$mock->id}}">
			
			<div class="form-group">
				<label for="nombre">Asunto</label>
				<input type="text" class="form-control" id="asunto" name="asunto" value="{{$mock->asunto}}" placeholder="Asunto">
			</div>
			<div class="form-group">
				<label for="area">Area</label>
				<input type="text" class="form-control" id="area" name="area" value="{{$mock->area}}" placeholder="Área (zona a movilizarse)">
			</div>
			<div class="form-group">
				<label for="beneficiario">Beneficiario / Raz&oacute;n social</label>
				<input type="text" class="form-control autocomplete" id="beneficiario" name="beneficiario" value="{{$mock->beneficiario}}" placeholder="Beneficiario / Raz&oacute;n social">
			</div>
			<div class="form-group">
				<label for="cedula">C&eacute;dula / RIF</label>
				<input type="text" class="form-control" id="cedula" name="cedula_rif" value="{{$mock->cedula_rif}}" placeholder="C&eacute;dula o RIF del solicitante">
			</div>
			
      <div class="form-group">
        <label for="fechaCita">
          Fecha de traslado/movilización
        </label>
        <div class="input-group date">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
            <input id="fecha_rendicion" name="fecha_rendicion" type='text' class="form-control" value="{{$mock->fecha_rendicion}}" placeholder="aaaa-mm-dd"/>
        </div>
      </div>

      <!-- /.form group -->
			<div class="form-group">
				<label for="descripcion">Descripci&oacute;n</label>
				<textarea type="text" class="form-control" id="descripcion" name="descripcion" value="{{$mock->descripcion}}" placeholder="Descripci&oacute;n de la actividad"></textarea>
			</div>

			<div class="form-group">
				<label for="monto">Monto</label>
				<input type="text" class="form-control" id="monto" name="monto" value="{{$mock->monto}}" placeholder="Monto a solicitar">
			</div>
			<div class="form-group">
				<label>Cuenta</label>
				<select class="form-control" id="id_cuenta" name="id_cuenta" >
        <option value="">Seleccione un tipo de cuenta</option>
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
    $('#form-rendicion').bootstrapValidator({
      fields: {
        asunto: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca el motivo de la rendicion.'
                }
            }
      	},
      	area: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca la ubicación de la solicitd.'
                }
            }
      	},
      	beneficiario: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca el beneficiario.'
                }
            }
      	},
      	cedula_rif: {
            validators: {
                regexp: {
                	regexp: /(^([VvEe][-]\d{3,10})$|^([VvEeJjGg][-]\d{8}[-][0-9])$)/i ,
                    message: 'Por favor, introduzca un rif o cédula en formato válido. E.g. J-12345678-9 o V-12345678'
                }
            }
      	},
      	fecha_rendicion: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca una fecha.'
                }
            }
      	},
      	descripcion: {
            validators: {
                notEmpty: {
                    message: 'Por favor, describa la actividad para la cual se realiza la rendicion.'
                }
            }
      	},
      	monto: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un monto.'
                },
                regexp: {
                        regexp: /^[0-9]*\,[0-9]{2}$/g,
                        message: 'Introduzca un monto válido. Ej.: 1299,00'
                    }
            }
      	},
      	id_cuenta: {
            validators: {
                notEmpty: {
                    message: 'Por favor, seleccione un tipo de cuenta.'
                }
            }
      	},
      	id_area: {
            validators: {
                notEmpty: {
                    message: 'Por favor, seleccione el área de rendicion.'
                }
            }
      	},
      },

    });

    //Init Calendar
    $(function () {
      $('#fecha_rendicion').datetimepicker({
        minDate: new Date(),
        sideBySide: false,
        useCurrent: true,
        allowInputToggle: true,
        showClear: true,
        format: 'YYYY-MM-DD',
        tooltips: {
          today: 'Hoy',
          clear: 'Reiniciar'
        }
      });

    });

    /*$(function() {

      $(".autocomplete").autocomplete({
        source: function(request, response){
          $.ajax({
            url: '/viaticos/rendiciones/listado-razon-social',
            data: {term: request.term},
            dataType: 'JSON',
            success: function(data){
              var listado = data.listado;
              var transformed = $.map(listado, function(el){
                return {beneficiario:el.nombre}
              });
              console.log(transformed);
              response(listado);
            },
            error: function(error){
              console.log(error)
            }
          });
        }
      });
      
    });*/
</script>
@endsection