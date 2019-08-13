@extends('layouts.app')
@section('title', 'Verify OTP')
@section('content')
<section class="main-wrapper full-h">
      <div class="row full-h">
          <div class="login-wrapper col-sm-12 full-h">
              <div class="auth-middle-container">
                  <div class="logo">
                    <img src="{{ URL::asset('public/images/logo.png') }}" />
                  </div>
                  <div class="auth-form-wrapper">
                    <form method="POST" id="authForm" class="login-form" onsubmit="verifySubmit()"> 
                    	@csrf
                    	<input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group" id="verificationCode">
                          <input type="text" name="otp" id="verify-otp" placeholder="Verification Code" class="form-control" />
                          <span class="fa fa-chevron-right submit-icon" onclick="verifySubmit()"></span>
                        </div>
                        <span class="verify-error form-error" id="error-msg">Incorrect code. Please try again.</span>
                        <input type="submit" class="hidden" />
                    </form>
                    <div class="other-auth-links text-center">
                      <a href="javascript:void(0);" id="resend-otp">Re-send verification code</a>
                      <div class="line"></div>
                      <a href="mailto:ask@nextfbo.com">Contact support</a>
                    </div>
                  </div>
              </div>
          </div>
        </div>
    </section>
    
    <div id="loader">
      <span class="fa fa-spinner fa-spin"></span>
    </div>
@endsection