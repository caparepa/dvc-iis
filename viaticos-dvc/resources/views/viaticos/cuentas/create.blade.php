@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Crear cuenta
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="viaticos/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="viaticos/cuentas">Cuentas</a></li>
    <li class="active">Crear cuenta</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
@include('viaticos.cuentas.form', ['action' => 'create', 'mock' => $cuenta])
</section>
<!-- /.content -->

@endsection