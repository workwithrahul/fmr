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
                    <form method="POST" id="authForm" class="login-form" onsubmit="resetSubmit()"> 
                        <div class="form-group" id="resetEmail">
                          <input type="text" id="email" name="email" placeholder="Enter your e-mail id" value="" class="form-control" />
                          <span class="fa fa-chevron-right submit-icon" onclick="resetSubmit(1)"></span>
                        </div>
                        <span class="reset-error form-error">Please enter your e-mail</span>
                        <input type="submit" class="hidden" />
                    </form>
                    <div class="other-auth-links text-center">
                      <a href="{{ url('login') }}">Return to login</a>
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