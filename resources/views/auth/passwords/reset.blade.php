@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
<section class="main-wrapper full-h">
      <div class="row full-h">
          <div class="login-wrapper col-sm-12 full-h">
              <div class="auth-middle-container">
                  <div class="logo">
                    <img src="{{ URL::asset('public/images/logo.png') }}" />
                  </div>
                  <div class="auth-form-wrapper">
                    <form method="POST" id="authForm" action="{{ route('password.request') }}" class="register-form resetform">
                    @csrf 
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group row" style="display: none;">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="hidden" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ?? get_user_by_token($token) }}" required autofocus>
                            </div>
                    </div>
                         <div class="form-group row password hint-tooltip" id="loginPassword">
                           
                                <input id="password" placeholder="Create new password" type="password" class="field-tooltip form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required maxlength="18"
                        data-toggle="tooltip" 
                        data-html="true" 
                        data-placement="right"
                        data-title="<div class='tooltip-pass'><h5>Your password must have</h5><ul><li class='8char'>8 or more characters</li><li class=' up-lower'>Upper and lowercase letters.</li><li class='one-num'>At least one number.</li><li class='one-special'>At least one special character.</li></ul></div>"
                    >
                            
                        </div>
                        <div class="form-group row">
                            <input id="password-confirm" placeholder="Confirm password" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <span style="color:red;">
                            @if ($errors->has('password'))
                                <span style="color:red;">
                                   Passwords do not match. Please try again.      
                                </span>  
                            @endif
                        </span>
                         <div class="form-group row">
                        <input style="background-color:#337ab7;border-color:#2e6da4;color:#fff;" type="submit" id="reset-submit" class="form-control" value="{{ __('Reset Password') }}" disabled></div>
                        </div>       
                    </form>
                  </div>
              </div>
          </div>
        </div>
    </section>
    
    <div id="loader">
      <span class="fa fa-spinner fa-spin"></span>
    </div>
@endsection
