<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center" href="{{ url('admin/dashboard') }}">
		<div class="sidebar-brand-icon">
			<img class="dashboardlogo" src="{{ URL::asset('public/images/logo.png') }}" alt="logo" />
		</div>
	</a>			
	<!-- Nav Item - Dashboard -->
	
	<li class="nav-item align-items-center">
		<a class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin/add') || request()->is('admin/dashboard/*') ? 'active' : 'collapsed' }}" href="javascript:void(0)" data-toggle="collapse" data-target="#adminPages" aria-expanded="true" aria-controls="collapsePages">
			<img src="{{ URL::asset('public/admin/images/admin-team.png') }}" alt="icon"/>
			<span>Users</span>
		</a>
		<div id="adminPages" class="collapse {{ request()->is('admin/dashboard') || request()->is('admin/add') || request()->is('admin/dashboard/*') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item {{ request()->is('admin/dashboard') || request()->is('admin/team/*') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}">View All Users</a>	
				<a class="collapse-item {{ request()->is('admin/add') ? 'active' : '' }}" href="{{ url('admin/add') }}">Add New User</a>	    
			</div>
		</div>
	</li>
	
	
	
	<li class="nav-item">
		<a class="nav-link" href="{{ url('/admin/records') }}">
			<img src="{{ URL::asset('public/admin/images/clients.png') }}" alt="icon"/>
			<span>Records</span>
		</a>
		
	</li>
	
	
	<li class="nav-item">
		<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
			<img src="{{ URL::asset('public/admin/images/logout.png') }}" alt="icon"/>
			<span>Log Out</span>
		</a>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">
	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
<!-- End of Sidebar -->