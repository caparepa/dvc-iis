<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ADMIN DVC</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @yield('meta')
    
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css">
  <!-- jQuery-ui 1.11.14 -->
  <link rel="stylesheet" href="/bower_components/jquery-ui/themes/base/jquery-ui.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/bower_components/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css">
  <!-- eonasdan datetime picker -->
  <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />


  <!-- -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS sidedar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    @include('viaticos.includes.header')

    @include('viaticos.includes.sidebar')
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->

    @include('viaticos.includes.footer')
    
    @include('viaticos.includes.control-sidebar')
    
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 2.2.3 -->
  <script src="/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- jQuery-ui 1.11.14 -->
  <script src="/bower_components/jquery-ui/jquery-ui.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="/bower_components/AdminLTE/plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="/bower_components/AdminLTE/dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="/bower_components/AdminLTE/dist/js/demo.js"></script>
  <!-- Data tables -->
  <script src="/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- moment.js -->
  <script src="/bower_components/moment/moment.js"></script>
  <!-- Bootstrap Validator -->
  <script src="/bower_components/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
  <!-- eonasdan datetime picker-->
  <script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
  <!-- handlebars -->
  <script src="/bower_components/handlebars/handlebars.js"></script>
  
  <!-- custom scripts-->
  <script type="text/javascript">
    $("#crearSolicitud").on('click', function(e){
      e.preventDefault();
      $.ajax({
        url: '/viaticos/solicitudes/validar-rendicion-pendiente',
        dataType: 'JSON',
        success: function(data){
          var url = $("#crearSolicitud").attr("href");
          if(!data.result){
            window.location.href = url;
          }else{
            $("#modalRendicion").modal('show');
          }
        },
        error: function(error){
          console.log(error)
        }
      });
    });
  </script>

  @yield('scripts')
  @yield('templates')
</body>
</html>
