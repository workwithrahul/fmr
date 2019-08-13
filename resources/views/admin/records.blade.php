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
							<th>Name</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($users as $user)
					<tr>
						<td>{{ $user->name}}</td>
						<td>{{ $user->email}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>

			</div>
		</div>
		<div class="row">
			<div class="col-sm-12" >{!! $users->render() !!}</div>
		</div>
		
	</div>
</div>
<!-- /.container-fluid -->
@endsection