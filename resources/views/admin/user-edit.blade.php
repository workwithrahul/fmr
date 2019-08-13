@extends('admin-layouts.admin-dashboard')
@section('title', 'Edit User Details')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid mainarea">
	<!-- Page Heading -->
	<h3 class="dashtitle">Edit User</h3>
	<div class="fullwidth Innermainarea">
		<!-- Content Row -->
		<div class="fullwidth profiletitrow">User Detail</div>
		<div class="myaccount fullwidth">
			<form id="edit_admin_detail" action ="{{ url('/admin/update/user/details') }}" method="post" enctype="multipart/form-data"class="fullwidth" onkeypress="validatePassword()">
			@csrf
			<input type="hidden" name="user_id" value="{{$AdminData->id}}" />
				<div class="row">
					<div class="col-12 col-sm-8 profiledetailside">
						<div class="fullwidth pdetailrow">
							<div class="row">
								<div class="col-12 col-sm-4 ptitlebox">
									<span><img src="{{ URL::asset('public/admin/images/user.png') }}" alt="email" /> Username </span>
								</div>
								<div class="col-12 col-sm-8 ptinfobox">
									<input type="text" placeholder="Enter username" name="username" class="noborderinput {{ $errors->has('username') ? 'is-invalid' : '' }}" maxlength="80" value="{{ $AdminData->username }}" />
									@if ($errors->has('username'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('username') }}</strong>
										</span>
									@endif
								</div>
							</div> 
						</div> 
						<div class="fullwidth pdetailrow">
							<div class="row">
								<div class="col-12 col-sm-4 ptitlebox">
									<span><img src="{{ URL::asset('public/admin/images/user.png') }}" alt="Phone" /> Name </span>
								</div>
								<div class="col-12 col-sm-8 ptinfobox">
									<input type="text" placeholder="Enter name" name="name" class="noborderinput {{ $errors->has('name') ? 'is-invalid' : '' }}" maxlength="80" value="{{ $AdminData->name }}" />
									@if ($errors->has('name'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div> 
						</div>
						
						
						<div class="fullwidth profiletitrow midtitle">Security</div>
						<div class="fullwidth pdetailrow">
							<div class="row">
								<div class="col-12 col-sm-4 ptitlebox">
									<span><img width="16" src="{{ URL::asset('public/admin/images/lock.png') }}" alt="Password" /> Password </span>
								</div>
								<div class="col-12 col-sm-8 ptinfobox">
									<span><a href="javascript:void(0);" id="change_password_field">Change Password</a></span>
								</div>
							</div>
						</div>
						<div id="show_password_field" style="display:none;">
							<div class="fullwidth pdetailrow">
								<div class="row">
									<div class="col-12 col-sm-6 ptitlebox">
										<span class="change_password_lable">Password</span>
										<input type="password" id="pviwe_pwd" name="password" class="noborderinput passwordinput" placeholder="Enter" maxlength="80" value="" />
									</div>
									<div class="col-12 col-sm-6 ptitlebox">
										<span class="change_password_lable">Confirm Password</span>
										<input type="password" name="cnfpassword" class="noborderinput passwordinput" placeholder="Enter" maxlength="80" value="" />
									</div>
								</div>
							</div>
						</div>
						<div class="fullwidth btnrow">
							<div class="row">
								<div class="col-12 clientbtn">
									<a id="resetForm" class="btn primarybtn midbtn cancelbtn delete_record_cls" data-toggle="modal" data-target="#delete_record" href="{{ url('admin/dashboard') }}" title="Cancel">Cancel</a>
									<input type="submit" class="btn midbtn primarybtn" value="Save">
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /.container-fluid -->
@endsection