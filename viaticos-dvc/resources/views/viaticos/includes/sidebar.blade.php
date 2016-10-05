<!-- =============================================== -->
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
	  <!-- Sidebar user panel -->
	  <div class="user-panel">
	    <div class="pull-left image">
	      <img src="{{ url('images/avatar.png') }}" class="img-circle" alt="User Image">
	    </div>
	    <div class="pull-left info">
	      <p>Alexander Pierce</p>
	      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	    </div>
	  </div>
	  <!-- search form -->
	  <!--<form action="#" method="get" class="sidebar-form">
	    <div class="input-group">
	      <input type="text" name="q" class="form-control" placeholder="Search...">
	          <span class="input-group-btn">
	            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
	            </button>
	          </span>
	    </div>
	  </form>-->
	  <!-- /.search form -->
	  <!-- sidebar menu: : style can be found in sidebar.less -->
	  <ul class="sidebar-menu">
	    <li class="header">MAIN NAVIGATION</li>
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
			<li><a href="/viaticos/solicitudes"><i class="fa fa-circle-o"></i>Lista de Solicitudes</a></li>
			<li><a href="/viaticos/solicitudes/create"><i class="fa fa-circle-o"></i>Crear solicitud</a></li>
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
		    <i class="fa fa-users"></i> <span>Usuarios</span>
		    <span class="pull-right-container">
		      <i class="fa fa-angle-left pull-right"></i>
		    </span>
		  </a>
		  <ul class="treeview-menu">
		    <li><a href="/viaticos/usuarios"><i class="fa fa-circle-o"></i>Listado de usuarios</a></li>
		    <li><a href="/viaticos/usuarios/create"><i class="fa fa-circle-o"></i>Crear Usuario</a></li>
		    <li><a href="/viativos/usuarios/profile"><i class="fa fa-circle-o"></i>Perfil de usuario</a></li>
		  </ul>
		</li>
    	<!-- -->
	  </ul>
	</section>
	<!-- /.sidebar -->
</aside>