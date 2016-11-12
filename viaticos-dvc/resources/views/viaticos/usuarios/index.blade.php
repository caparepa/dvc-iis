@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Listado de Usuarios
    <small>Usuarios</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/viaticos/home"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="/viaticos/usuarios">Usuarios</a></li>
    <li class="active">Listado de usuarios</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Listado de Usuarios</h3>
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
      <table id="tabla-usuarios" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>E-mail</th>
            <th>Rol</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach($usuarios as $usuario)
          <tr>
            <td>{{$usuario->id}}</td>
            <td>{{$usuario->fullName}}</td>
            <td>{{$usuario->email}}</td>
            <td>{{$usuario->rolName}}</td>
            <td>
                    <a href="{{ url('viaticos/usuarios/edit/'.$usuario->id) }}" class="btn btn-flat btn-sm"
                      title="Editar {{$usuario->fullName}}">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{ url('viaticos/usuarios/delete/'.$usuario->id) }}"
                      class="btn btn-flat btn-sm"
                      title="Eliminar {{$usuario->fullName }}"
                      data-confirm="¿Est&aacute; seguro que desea eliminar este usuario?">
                      <i class="fa fa-trash-o"></i>
                    </a>
                  </td>
          </tr>
          @endforeach
        
        </tbody>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>E-mail</th>
            <th>Rol</th>
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
    $('#tabla-usuarios').DataTable({
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
