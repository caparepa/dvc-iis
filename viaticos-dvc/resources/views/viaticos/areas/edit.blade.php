@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Editar area
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Areas</a></li>
    <li class="active">Editar area</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
@include('viaticos.areas.form', ['action' => 'edit', 'mock' => $area])
</section>
<!-- /.content -->

@endsection