@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ver rendición de cuentas
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('viaticos/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{url('viaticos/rendiciones')}}">Rendiciones de cuentas</a></li>
    <li class="active">Ver rendición de cuentas</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
        <!-- ./col -->
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-book"></i>

              <h3 class="box-title">Detalle de rendición de cuentas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Asunto</dt>
                <dd>{{$rendicion->asunto}}</dd>
                <dt>Fecha</dt>
                <dd>{{$rendicion->fecha_rendicion}}</dd>
                <dt>Beneficiario</dt>
                <dd>{{$rendicion->beneficiario}}</dd>
                
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
</section>
<!-- /.content -->

@endsection