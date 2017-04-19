@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Crear solicitud
    <small>Crear solicitud</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="#">Solicitudes</a></li>
    <li class="active">Crear Solicitud</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
@include('viaticos.solicitudes.form', ['action' => 'create', 'mock' => $solicitud, 'cuentas' => $cuentas])
</section>
<!-- /.content -->

@endsection