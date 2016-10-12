@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Editas usuario	
    <small>Editas usuario</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="viaticos/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="viaticos/usuarios">Usuarios</a></li>
    <li class="active">Editas usuario</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
@include('viaticos.usuarios.form', ['action' => 'edit', 'roles' => $roles, 'areas' => $areas, 'mock' => $usuario])
</section>
<!-- /.content -->

@endsection