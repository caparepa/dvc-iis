<?php 
	
	$array_roles = [
		\App\Models\Usuario::ROL_ADMIN,
		\App\Models\Usuario::ROL_ADMINISTRACION,
		\App\Models\Usuario::ROL_DIRECCION,
	];

?>
<!-- =============================================== -->
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
	  <!-- Sidebar user panel -->
	  <div class="user-panel">
	    <div class="pull-left image">
	      <img src="{{ $sessionUser->avatarUrl }}" class="img-circle" alt="User Image">
	    </div>
	    <div class="pull-left info">
	      <p>{{$sessionUser->fullName}}</p>
	      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	    </div>
	  </div>
	  <!-- sidebar menu: : style can be found in sidebar.less -->
	  <ul class="sidebar-menu">
	    <li class="header">MEN&Uacute; PRINCIPAL</li>
	    <li>
	    	<a href="/viaticos/home">
				<i class="fa fa-dashboard"></i> 
				<span>Home</span>
	    	</a>
    	</li>
    	<li class="treeview">
		  <a href="#">
		    <i class="fa fa-book"></i> <span>Solicitudes</span>
		    <span class="pull-right-container">
		      <i class="fa fa-angle-left pull-right"></i>
		    </span>
		  </a>
		  <ul class="treeview-menu">
			@if(in_array($sessionUser->rol, $array_roles))
			<li><a href="/viaticos/solicitudes"><i class="fa fa-circle-o"></i>Lista de Solicitudes</a></li>
			@endif
			<li><a href="/viaticos/solicitudes/mis-solicitudes"><i class="fa fa-circle-o"></i>Mis solicitudes</a></li>
			<li><a href="/viaticos/solicitudes/create" id="crearSolicitud"><i class="fa fa-circle-o"></i>Crear solicitud</a></li>
		  </ul>
		</li>
		<li class="treeview">
		  <a href="#">
		    <i class="fa fa-book"></i> <span>Rendición de Cuentas</span>
		    <span class="pull-right-container">
		      <i class="fa fa-angle-left pull-right"></i>
		    </span>
		  </a>
		  <ul class="treeview-menu">
			@if(in_array($sessionUser->rol, $array_roles))
			<li><a href="/viaticos/rendiciones"><i class="fa fa-circle-o"></i>Listado de rendiciones</a></li>
			<li><a href="/viaticos/rendiciones/mis-rendiciones"><i class="fa fa-circle-o"></i>Mis rendiciones pendientes</a></li>
			@else
			<li><a href="/viaticos/rendiciones/mis-rendiciones"><i class="fa fa-circle-o"></i>Mis rendiciones pendientes</a></li>
			@endif
		  </ul>
		</li>
		<li class="treeview">
		  <a href="#">
		    <i class="fa fa-table"></i> <span>Cuentas</span>
		    <span class="pull-right-container">
		      <i class="fa fa-angle-left pull-right"></i>
		    </span>
		  </a>
		  <ul class="treeview-menu">
		   <li><a href="/viaticos/cuentas"><i class="fa fa-circle-o"></i>Plan de Cuentas</a></li>
		    <li><a href="/viaticos/cuentas/create"><i class="fa fa-circle-o"></i>Crear cuenta</a></li>
		  </ul>
		</li>
		<li class="treeview">
		  <a href="#">
		    <i class="fa fa-bar-chart"></i> <span>Reportes</span>
		    <span class="pull-right-container">
		      <i class="fa fa-angle-left pull-right"></i>
		    </span>
		  </a>
		  <ul class="treeview-menu">
		    <li><a href="/viaticos/reportes"><i class="fa fa-circle-o"></i>Listado de Reportes</a></li>
		  </ul>
		</li>
		<li class="treeview">
		  <a href="#">
		    <i class="fa fa-cubes"></i> <span>&Aacute;reas</span>
		    <span class="pull-right-container">
		      <i class="fa fa-angle-left pull-right"></i>
		    </span>
		  </a>
		  <ul class="treeview-menu">
		    <li><a href="/viaticos/areas"><i class="fa fa-circle-o"></i>Listado de &aacute;reas</a></li>
		    <li><a href="/viaticos/areas/create"><i class="fa fa-circle-o"></i>Crear &aacute;rea</a></li>
		  </ul>
		</li>
		<li class="treeview">
		  <a href="#">
		    <i class="fa fa-users"></i> <span>Usuarios</span>
		    <span class="pull-right-container">
		      <i class="fa fa-angle-left pull-right"></i>
		    </span>
		  </a>
		  <ul class="treeview-menu">
		    <li><a href="/viaticos/usuarios"><i class="fa fa-circle-o"></i>Listado de usuarios</a></li>
		    <li><a href="/viaticos/usuarios/create"><i class="fa fa-circle-o"></i>Crear Usuario</a></li>
		    <li><a href="/viaticos/usuarios/profile"><i class="fa fa-circle-o"></i>Perfil de usuario</a></li>
		  </ul>
		</li>
    	<!-- -->
	  </ul>
	</section>
	<!-- /.sidebar -->
</aside>

<!-- modal rendicion de cuentas pendientes -->
<div class="example-modal">
	<div id="modalRendicion" tabindex="-1" role="dialog" class="modal modal-warning" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Aviso</h4>
					</div>
					<div class="modal-body">
						<p>
							Tiene rendiciones de cuentas pendientes abiertas o por cargar. Por favor,
							cierra o cargue las rendiciones antes de realizar una nueva solicitud.
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
						<a href="/viaticos/dashboard" type="button" class="btn btn-outline">Rendici&oacute;n de Cuentas</a>
					</div>
				</div>
			<!-- /.modal-content -->
			</div>
		<!-- /.modal-dialog -->
		</div>
	<!-- /.modal -->
</div>
<!-- /.modal rendicion de cuentas pendientes -->