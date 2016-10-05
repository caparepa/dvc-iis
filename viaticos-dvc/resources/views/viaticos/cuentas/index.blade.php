@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Cuentas
    <small>Layout with collapsed sidebar on load</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Layout</a></li>
    <li class="active">Collapsed Sidebar</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Title</h3>
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
            <th>Nomre</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach($cuentas as $cuenta)
          <tr>
            <td>{{$cuenta->codigo}}</td>
            <td>{{$cuenta->nombre}}</td>
            <td>Acciones</td>
          </tr>
          @endforeach
        
        </tbody>
        <tfoot>
          <tr>
            <th>C&oacute;digo</th>
            <th>Nomre</th>
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