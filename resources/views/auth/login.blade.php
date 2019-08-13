@extends('layouts.app')
@section('title', 'Login')
@section('content')
       <section class="main-wrapper full-h">
      <div class="row full-h">
          <div class="login-wrapper col-sm-12 full-h">
              <div class="auth-middle-container">
                  <div class="logo">
                    <img src="{{ URL::asset('public/images/logo.png') }}" />
                  </div>
                  <div class="auth-form-wrapper">
                    <form method="POST" action="{{ route('login') }}" id="authForm" class="login-form" onsubmit="loginSubmit()">
                    @csrf 
                        <div class="form-group" id="loginName">
                          <input type="text" id="utn" placeholder="username" autocomplete="off" maxlength="23" class="form-control" />
                          <span class="fa fa-chevron-right submit-icon" onclick="loginSubmit(1)"></span>
                        </div>
                        <span class="id-error form-error">Please enter username</span>
                        <div id="loginPassword" class="form-group password hidden">
                          <input type="password" id="password" maxlength="18" autocomplete="new-password" placeholder="Password" value="" class="form-control" />
                          <span class="fa fa-chevron-right submit-icon" onclick="loginSubmit(2)"></span>
                        </div>
                        <span class="pass-error form-error" id="error-msg">Please enter password</span>
                        <input type="submit" class="hidden" />
                    </form>
                   <!--  <div class="other-auth-links text-center">
                      <a href="{{ url('/forgot/password') }}">Forget NextID or Password?</a>
                      <div class="line"></div>
                      <a href="{{ url('register') }}">Create New</a>
                    </div> -->
                  </div>
              </div>
          </div>
        </div>
    </section>
    <div id="loader">
      <span class="fa fa-spinner fa-spin"></span>
    </div>
@endsection
