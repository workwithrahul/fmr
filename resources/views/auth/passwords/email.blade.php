@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
<div class="fullwidth BannerTop">
            <img src="<?php echo url('/'); ?>/public/images/loginbg.png" class="fullwidth" alt="banner"/>
        </div>
        <div class="fullwidth midform">
            <div class="container" >
                <div class="midarealogin text-center">
                    <div class="fullwidth loginlogo">
                        <img src="<?php echo url('/'); ?>/public/images/logo.png" alt="logo" />
                    </div>
                    <div class="fullwidth forgotInner">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif
						@if (session('status'))
							<div class="fullwidth submitrow">
								<a href="{{url('/')}}" class="btn primarybtn sbtbtn">Continue</a>
							</div>
						@else
							<h4>Forgot your password? </h4>
							<p>Enter your email address below and we'll <br>
							send you a link to reset your password.</p>
							 <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
								@csrf
								<div class="fullwidth formrow">
									<input id="email" type="email" placeholder="Enter registered email" class="useremail form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required />
									@if ($errors->has('email'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
								<div class="fullwidth submitrow">
									<input class="btn primarybtn sbtbtn" type="submit" name="sub" value="Send Reset Link" />
								</div>
							</form>
						 @endif
                    </div>

                </div>

            </div>
        </div>
@endsection
