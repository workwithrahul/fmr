<!-- @extends('layouts.app') -->
@section('title', 'Home')
@section('content')
<section class="main-wrapper full-h homepage">
      <div class="row full-h">
          <div class="black-wrapper col-sm-12 full-h">
            <header>
                <div class="dropdown user-menu pull-right">
                    <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Dropdown button
                    </button> -->
                    <span class="fa fa-user-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                  </div>
            </header>
              <div class="auth-middle-container homepage-container">
                  <div class="logo">
                    <img src="{{ URL::asset('public/images/logo.png') }}" />
                  </div>
                  </br></br>
                  <div class="form-group" id="loginName">
                     
                      @csrf
                      <input type="text" id="search_name" placeholder="Search name..." class="form-control" />
                  <div class="auth-form-wrapper" id="searchData" style="display: none;">
                      <h2 id="searchEmail"></h2>
                      <span style="color:#e5e5e5;cursor:pointer;" onclick="copyToClipboard('#searchEmail')">Click to copy the above email</span>
                  </div>   
                  </div>
              </div>
          </div>
        </div>
    </section>
@endsection