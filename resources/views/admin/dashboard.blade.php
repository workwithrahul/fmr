@extends('admin-layouts.admin-dashboard')
@section('title', 'Users')
@section('content')      
<!-- Begin Page Content -->
<div class="container-fluid mainarea">

	<!-- Page Heading -->
	<h3 class="dashtitle">Users</h3>
	<div class="addnewbox"><a href="{{ url('admin/add') }}"><img src="{{ URL::asset('public/admin/images/addnew.png') }}" alt="img" /> </a></div>
	<div class="fullwidth Innermainarea">
		<!-- Content Row -->
		<div class="row">
			<div class="col-sm-12">
				<table class="fullwidth themetable tabletype1">
					<thead>
						<tr>
							<th>Username</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($users as $user)
					<tr>
						<td>{{ $user->username}}</td>
						<td>{{ $user->name}}</td>
						<td>
						<a href="{{ url('admin/user/edit') }}/{{$user->id}}" data-toggle="tooltip" title="Delete User">
							<img class="actionicon viewimg" src="{{ URL::asset('public/admin/images/edit.png') }}" alt="img">
						</a>	
						<a onclick="return confirm('Are you sure want to Delete?')" href="{{ url('admin/delete/user') }}/{{$user->id}}" data-toggle="tooltip" title="Delete User">
							<img class="actionicon viewimg" src="{{ URL::asset('public/admin/images/del.png') }}" alt="img">
						</a>
							
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
</div>
<!-- /.container-fluid -->
@endsection