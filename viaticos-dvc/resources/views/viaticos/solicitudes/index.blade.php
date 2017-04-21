@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    @if($type == 'index_all')
    Listado de solicitudes
    @else
    Mis Solicitudes
    @endif
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/viaticos/home"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="/viaticos/solicitudes">Solicitudes</a></li>
    <li class="active">
      @if($type == 'index_all')
      Listado de solicitudes
      @else
      Mis Solicitudes
      @endif
    </li>
  </ol>
</section>

<section>
  <div class="row">
  <div class="col-md-12">
    <?php
      //echo "<pre>";
      //echo print_r($solicitudes);
      //echo "</pre>"; 
    ?>
    
  </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">
      @if($type == 'index_all')
      Listado de solicitudes
      @else
      Mis Solicitudes
      @endif
      </h3>
      <!-- botones -->
      <!--
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
      -->
      <!-- botones -->
    </div>
    <div class="box-body">
      <!-- tabla -->
      <table id="tabla-solicitudes" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Asunto</th>
            <th>Solicitante</th>
            <th>Fecha de Vi&aacute;tico</th>
            <th>Fecha de Creaci&oacute;n</th>
            <th>Status de solicitud</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach($solicitudes as $solicitud)
          <tr>
            <td><a href="{{url('viaticos/solicitudes/view/'.$solicitud->id)}}">{{$solicitud->asunto}}</a></td>
            <td><a href="{{url('viaticos/usuarios/view/'.$solicitud->usuario->id)}}">{{$solicitud->usuario->fullName}}</a></td>
            <td>{{$solicitud->fechaViatico}}</td>
            <td>{{$solicitud->fechaCreacion}}</td>
            <td>{{$solicitud->statusSolicitud}}</td>
            <td>
              <a href="{{ url('viaticos/solicitudes/view/'.$solicitud->id) }}" class="btn btn-flat btn-sm"
                title="Ver solicitud {{$solicitud->id}}">
                <i class="fa fa-eye"></i>
              </a>
              <a href="{{ url('viaticos/solicitudes/edit/'.$solicitud->id) }}" class="btn btn-flat btn-sm"
                title="Editar solicitud {{$solicitud->id}}">
                <i class="fa fa-edit"></i>
              </a>
              <a href="{{ url('viaticos/solicitudes/delete/'.$solicitud->id) }}"
                class="btn btn-flat btn-sm"
                title="Eliminar solicitud {{$solicitud->id}}"
                data-confirm="¿Est&aacute; seguro que desea eliminar esta solicitud?">
                <i class="fa fa-trash-o"></i>
              </a>
              @if($type == 'index_all')
                @if(Auth::user()->isAdministracion() || Auth::user()->isDireccion())
                <a href="{{ url('viaticos/solicitudes/cambiar-status/'.$solicitud->id.'/'.App\Models\Solicitud::STATUS_APPROVED) }}"
                  class="btn btn-flat btn-sm"
                  title="Aceptar solicitud {{$solicitud->id}}"
                  data-confirm="¿Est&aacute; seguro que desea aceptar esta solicitud?">
                  <i class="fa fa-check"></i>
                </a>
                  <a href="{{ url('viaticos/solicitudes/cambiar-status/'.$solicitud->id.'/'.App\Models\Solicitud::STATUS_DENIED) }}"
                  class="btn btn-flat btn-sm"
                  title="Denegar solicitud {{$solicitud->id}}"
                  data-confirm="¿Est&aacute; seguro que desea denegar esta solicitud?">
                  <i class="fa fa-ban"></i>
                </a>
                @endif
              @endif
            </td>
          </tr>
          @endforeach
        
        </tbody>
        <tfoot>
          <tr>
            <th>Asunto</th>
            <th>Solicitante</th>
            <th>Fecha de Vi&aacute;tico</th>
            <th>Fecha de Creaci&oacute;n</th>
            <th>Status de solicitud</th>
            <th>Acciones</th>
            
          </tr>
        </tfoot>
      </table>
      <!-- /.tabla -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->

@endsection
@section('scripts')
<script>
  $(function () {
    $('#tabla-solicitudes').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

</script>
@endsection
