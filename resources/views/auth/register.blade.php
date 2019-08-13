@extends('layouts.app')
@section('title', 'Register')
@section('content')
<section class="main-wrapper full-h">
      <div class="row full-h">
          <div class="login-wrapper col-sm-12 full-h">
              <div class="auth-middle-container">
                  <div class="logo">
                    <img src="{{ URL::asset('public/images/logo.png') }}" />
                  </div>
                  <div class="auth-form-wrapper">
                    <form method="POST" id="authForm" class="register-form" onsubmit="registerSubmit()">
                    @csrf 
                        <div class="form-group hint-tooltip" id="loginName">
                          <input type="text" placeholder="Universal Tail Number" autocomplete="off" value="UT - " id="utn" class="form-control field-tooltip" maxlength="23" 
                        data-toggle="tooltip" 
                        data-html="true" 
                        data-placement="right"
                        data-title="<div class='tooltip-pass'><h5>UT Number must be</h5><ul><li class='4char'>Between 4-18 characters.</li></ul></div>" />
                          <span class="fa fa-chevron-right submit-icon" onclick="registerSubmit(1)"></span>
                        </div>
                        <span class="login-id id-error form-error">Please enter NextID</span>
                        <div id="loginPassword" class="form-group password hidden hint-tooltip">
                          <input type="password" id="password" name="password" placeholder="Password" autocomplete="new-password" value="" maxlength="18" class="form-control field-tooltip"
                        data-toggle="tooltip" 
                        data-html="true" 
                        data-placement="right"
                        data-title="<div class='tooltip-pass'><h5>Your password must have</h5><ul><li class='8char'>8 or more characters</li><li class=' up-lower'>Upper and lowercase letters.</li><li class='one-num'>At least one number.</li><li class='one-special'>At least one special character.</li></ul></div>"
                    />
                          <span class="fa fa-chevron-right submit-icon" onclick="registerSubmit(2)"></span>
                          <!-- <div class="password-hint">

                          </div> -->
                        </div>
                        <span class="login-pass pass-error form-error">Please enter password</span>
                        <div id="loginEmail" class="form-group email hidden">
                          <input type="text" id="email" name="email" placeholder="E-mail" autocomplete="off" value="" class="form-control" />
                          <span class="fa fa-chevron-right submit-icon" onclick="registerSubmit(3)"></span>
                        </div>
                        <span class="login-email form-error email-error" id="error-msg">Please enter valid E-mail</span>
                        <input type="submit" class="hidden" />
                    </form>
                    <div class="other-auth-links text-center">
                      <a href="{{ url('login') }}">Already have an account?</a>
                      <div class="line"></div>
                      <a href="{{ url('login') }}">Return to login</a>
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
