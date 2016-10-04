@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Crear usuario (usar esta pagina de ejemplo!!!)
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
@include('viaticos.usuarios.form', ['action' => 'create', 'roles' => $roles, 'mock' => $usuario])
</section>
<!-- /.content -->

@endsection