<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@can('CRUD users')
	<li class="nav-item nav-dropdown">
		<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
		<ul class="nav-dropdown-items">
			<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
			<li class='nav-item'><a class='nav-link' href="{{ backpack_url('healthstaff') }}"><i class='nav-icon la la-user-md'></i> Health Staffs</a></li>
			<li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
			<li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
		</ul>
	</li>
@endcan

@can('CRUD businesses')
	<li class='nav-item'><a class='nav-link' href="{{ backpack_url('business') }}"><i class='nav-icon la la-building-o'></i> Businesses</a></li>
@endcan

@can('update users health status')
	<li class="nav-item nav-dropdown">
		<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-hospital-o"></i> Health Staff Forms</a>
		<ul class="nav-dropdown-items">
		<li class="nav-item"><a class="nav-link" href="{{ backpack_url('update_test_results') }}"><i class="nav-icon la la-user"></i> <span>Update Test results</span></a></li>
		</ul>
	</li>
@endcan

