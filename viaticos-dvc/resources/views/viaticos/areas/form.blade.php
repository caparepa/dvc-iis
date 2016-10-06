<!-- general form elements -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Crear area</h3>
  </div>
<!-- /.box-header -->
<!-- form start -->
  <form id="form-area" method="post" role="form">
    <div class="box-body">
      
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />

      <input type="hidden" name="id" value="{{$mock->id}}">
            
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$mock->nombre}}" placeholder="Nombre">
      </div>
      <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$mock->descripcion}}" placeholder="Descripción">
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
    $('#form-area').bootstrapValidator({
      fields: {
        nombre: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca un nombre'
                }
            }
              },
        descripcion: {
            validators: {
                notEmpty: {
                    message: 'Por favor, introduzca una descripción.'
                }
            }
        }
      },

    });
</script>
@endsection
