@extends('layouts.app')

@section('content')
<body class="login">
    <div class="login_wrapper">        
      <section class="login_content">
        <div><img src="{{ asset('images/zimgen.png') }}"></div>
        <div class="row justify-content-center">          
            <div class="card">
              <div class="card-header">{{ __('Reset Password') }}</div>

              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif

              <form method="POST" action="{{ route('password.email') }}">
                  @csrf 
                  <div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                  <div class="form-group">                      
                          <button type="submit" class="btn btn-primary">
                              {{ __('Send Password Reset Link') }}
                          </button>                      
                  </div>
              </form>
            </div>
          
        </div>                        
      </section>
    </div>
</body>
@endsection
