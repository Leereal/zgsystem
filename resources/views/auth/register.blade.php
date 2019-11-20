@extends('layouts.app')

@section('content')
<body class="login">
    <div>
      
      <a class="hiddenanchor" id="signin"></a>
      <a class="hiddenanchor" id="signup"></a>

      <div class="login_wrapper">
        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <div><img src="{{ asset('images/zimgen.png') }}"></div>
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <h1>Create Account</h1>
              <div>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              <div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              <div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
             
                    <div >
                        <input id="password-confirm" type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required autocomplete="new-password">
                    </div>
              
              <div>                
                <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
                </button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>                  
                  <p>©{{ now()->year }} All Rights Reserved. Powered by Leereal</p>
                </div>
              </div>
            </form>
          </section>
        </div>
        <div class="animate form login_form">
          <section class="login_content">
            <div><img src="{{ asset('images/zimgen.png') }}"></div>

            <form method="POST" action="{{ route('login') }}">
                        @csrf
              <h1>Login Form</h1>
              <div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              <div>
                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
               <div>                
                <button type="submit" class="btn btn-primary">
                  {{ __('Login') }}
                </button>                          
                
                <span class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </span>
                
              </div>              
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to the system?
                  <a href="#signup" class="to_register"> Create Account</a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>                  
                  <p>©{{ now()->year }} All Rights Reserved. Powered by Leereal</p>
                </div>
              </div>
            </form>
          </section>
        </div>        
      </div>
    </div>
</body>
@endsection
