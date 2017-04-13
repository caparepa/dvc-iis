@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    @if($type == 'index_all')
    Listado de rendiciones
    @else
    Mis rendiciones
    @endif
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/viaticos/home"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="/viaticos/rendiciones">Rendiciones de cuentas</a></li>
    <li class="active">
      @if($type == 'index_all')
      Listado de Rendiciones de Cuentas
      @else
      Rendiciones de cuentas pendientes
      @endif
    </li>
  </ol>
</section>

<section>
  <div class="row">
  <div class="col-md-12">
    <?php
      //echo "<pre>";
      //echo print_r($rendiciones);
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
      Listado de rendiciones
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
      <table id="tabla-rendiciones" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Solicitud</th>
            <th>Solicitante</th>
            <th>Fecha de Vi&aacute;tico</th>
            <th>Status de Rendición</th>
            <th>Revisado por</th>
            <th>Fecha de revisi&oacute;n</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($rendiciones as $rendicion)
          <tr>
            <td><a href="{{url('viaticos/solicitudes/view/').$rendicion->id_solicitud}} ">{{$rendicion->id_solicitud}}</a></td>
            <td><a href="{{url('viaticos/usuarios/view/'.$rendicion->solicitante->id)}}">{{$rendicion->solicitante->fullName}}</a></td>
            <td>{{$rendicion->solicitud->fechaViatico}}</td>
            <td>{{$rendicion->statusRendicion}}</td>
            <td>{{$rendicion->revisor->fullName}}</td>
            <td>{{$rendicion->fechaRevision}}</td>
            <td>
              <a href="{{ url('viaticos/rendiciones/view/'.$rendicion->id) }}" class="btn btn-flat btn-sm"
                title="Ver rendicion {{$rendicion->id}}">
                <i class="fa fa-eye"></i>
              </a>
              <a href="{{ url('viaticos/rendiciones/edit/'.$rendicion->id) }}" class="btn btn-flat btn-sm"
                title="Editar rendicion {{$rendicion->id}}">
                <i class="fa fa-edit"></i>
              </a>
              <a href="{{ url('viaticos/rendiciones/delete/'.$rendicion->id) }}"
                class="btn btn-flat btn-sm"
                title="Eliminar rendicion {{$rendicion->id}}"
                data-confirm="¿Est&aacute; seguro que desea eliminar esta rendicion?">
                <i class="fa fa-trash-o"></i>
              </a>
              @if($type == 'index_all')
                @if(Auth::user()->isAdministracion() || Auth::user()->isDireccion())
                <a href="{{ url('viaticos/rendiciones/cambiar-status-rendicion/'.$rendicion->id.'/'.App\Models\Solicitud::STATUS_APPROVED) }}"
                  class="btn btn-flat btn-sm"
                  title="Aceptar rendicion {{$rendicion->id}}"
                  data-confirm="¿Est&aacute; seguro que desea aceptar esta rendicion?">
                  <i class="fa fa-check"></i>
                </a>
                  <a href="{{ url('viaticos/rendiciones/cambiar-status-rendicion/'.$rendicion->id.'/'.App\Models\Solicitud::STATUS_DENIED) }}"
                  class="btn btn-flat btn-sm"
                  title="Denegar rendicion {{$rendicion->id}}"
                  data-confirm="¿Est&aacute; seguro que desea denegar esta rendicion?">
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
          <tr>
            <th>Solicitud</th>
            <th>Solicitante</th>
            <th>Fecha de Vi&aacute;tico</th>
            <th>Status de Rendición</th>
            <th>Revisado por</th>
            <th>Fecha de revisi&oacute;n</th>
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
    $('#tabla-rendiciones').DataTable({
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
