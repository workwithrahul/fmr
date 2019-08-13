@extends('admin-layouts.admin-dashboard')
@section('title', 'Add New User')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid mainarea">

	<!-- Page Heading -->
	<h3 class="dashtitle">Add New User</h3>
	<div class="fullwidth Innermainarea">
		<!-- Content Row -->
		<form id="add_new_admin" action ="{{ url('admin/add/new/user') }}" method="POST" enctype="multipart/form-data" class="fullwidth">
		@csrf
			<div class="fullwidth rowform">
				<div class="row">
					<div class="col-12 col-sm-6">
						<input type="text" class="themeinput username {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" placeholder="Username" maxlength="80" value="{{ old('name') }}" />
						@if ($errors->has('username'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('username') }}</strong>
							</span>
						@endif						
					</div>
					<div class="col-12 col-sm-6">
						<input type="text" class="themeinput username {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" placeholder="Name" maxlength="80" value="{{ old('name') }}" />
						@if ($errors->has('name'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>
			<div class="fullwidth rowform">
				<div class="row">
					<div class="col-12 col-sm-6">
						<input type="password" class="themeinput password {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="Password" maxlength="80" value="{{ old('password') }}" />
						@if ($errors->has('password'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
					
				</div>
			</div>
			
			<div class="fullwidth btnrow">
				<div class="row">
					<div class="col-12 clientbtn">
					<a class="btn primarybtn cancelbtn cancel_button_cls" data-toggle="modal" data-target="#cancel_button" href="{{ url('admin/dashboard') }}" title="Cancel">Cancel</a>
						<input type="submit" class="btn primarybtn" value="Save" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /.container-fluid -->
@endsection