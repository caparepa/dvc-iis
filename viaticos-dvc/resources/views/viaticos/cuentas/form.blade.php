<!-- general form elements -->
<div class="box box-primary">
  <div class="box-header with-border">
    @if($action == 'create')
    <h3 class="box-title">Crear cuenta</h3>
    @else
    <h3 class="box-title">Editar cuenta</h3>
    @endif
  </div>
<!-- /.box-header -->
<!-- form start -->
  <form id="form-cuenta" method="post" role="form">
    <div class="box-body">
      
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />

      <input type="hidden" name="id" value="{{$mock->id}}">

      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$mock->nombre}}" placeholder="Nombre">
      </div>
      <div class="form-group">
        <label for="codigo">C&oacute;digo</label>
        <input type="text" class="form-control" id="codigo" name="codigo" value="{{$mock->codigo}}" placeholder="Código">
      </div>
      
      <!--<p class="help-block">Example block-level help text here.</p>-->
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
    $('#form-cuenta').bootstrapValidator({
      fields: {
        nombre: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un nombre'
                }
            }
              },
        codigo: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un código.'
                },
                remote: {
                  url: '/viaticos/cuentas/validate-codigo/',
                  data: function(validator) {
                        return {
                            id: validator.getFieldElements('id').val()
                        };
                    },
                }
            }
        }
      },

    });
</script>
@endsection
