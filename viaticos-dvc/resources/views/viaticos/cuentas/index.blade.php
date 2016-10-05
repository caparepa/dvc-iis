@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Listado de Cuentas
    <small>Plan de cuentas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/viaticos/home"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="/viaticos/cuentas">Cuentas</a></li>
    <li class="active">Collapsed Sidebar</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Listado de Cuentas</h3>
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
      <table id="example2" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>C&oacute;digo</th>
            <th>Nombre</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach($cuentas as $cuenta)
          <tr>
            <td>{{$cuenta->codigo}}</td>
            <td>{{$cuenta->nombre}}</td>
            <td class="text right">
                    <a href="{{ url('viaticos/cuentas/edit/'.$cuenta->id) }}" class="btn btn-flat btn-sm"
                      title="Editar {{$cuenta->nombre}}">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{ url('viaticos/cuentas/delete/'.$cuenta->id) }}"
                      class="btn btn-flat btn-sm"
                      title="Eliminar {{$cuenta->nombre}}"
                      data-confirm="¿Est&aacute; seguro que desea eliminar esta sala?">
                      <i class="fa fa-trash-o"></i>
                    </a>
                  </td>
          </tr>
          @endforeach
        
        </tbody>
        <tfoot>
          <tr>
            <th>C&oacute;digo</th>
            <th>Nombre</th>
            <th>Acciones</th>
            
          </tr>
        </tfoot>
      </table>
      <!-- /.tabla -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      Footer
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
    $("#example1").DataTable();
    $('#example2').DataTable({
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