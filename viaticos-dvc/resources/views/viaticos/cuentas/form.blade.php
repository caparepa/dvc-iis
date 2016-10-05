<!-- general form elements -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Cuenta</h3>
  </div>
<!-- /.box-header -->
<!-- form start -->
  <form id="form-cuenta" method="post" role="form">
    <div class="box-body">
      
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />

      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$mock->nombre}}" placeholder="Nombre">
      </div>
      <div class="form-group">
        <label for="codigo">C&oacute;digo</label>
        <input type="text" class="form-control" id="codigo" name="codigo" value="{{$mock->codigo}}" placeholder="Código">
      </div>
      
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
                  url: '/viaticos/cuentas/validate-codigo/'
                }
            }
        }
      },

    });
</script>
@endsection
