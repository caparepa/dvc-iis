@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Crear area
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="viaticos/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="viaticos/U¿">Areas</a></li>
    <li class="active">Crear area</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
@include('viaticos.areas.form', ['action' => 'create', 'mock' => $area])
</section>
<!-- /.content -->

@endsection