@extends('viaticos.layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ver solicitud
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('viaticos/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{url('viaticos/solicitudes')}}">Solicitudes</a></li>
    <li class="active">Ver solicitud</li>
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

              <h3 class="box-title">Detalle solicitud</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Asunto</dt>
                <dd>{{$solicitud->asunto}}</dd>
                <dt>Fecha</dt>
                <dd>{{$solicitud->fecha_solicitud}}</dd>
                <dt>Beneficiario</dt>
                <dd>{{$solicitud->beneficiario}}</dd>
                
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