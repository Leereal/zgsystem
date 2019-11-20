@extends('layouts.app')

@section('content')
<body class="login">
    <div class="login_wrapper">        
      <section class="login_content">
        <div><img src="{{ asset('images/zimgen.png') }}"></div>
        <div class="row justify-content-center">          
            <div class="card">
              <div class="card-header">{{ __('Verify Your Email Address') }}</div>

              <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>

              
            </div>
          
        </div>                        
      </section>
    </div>
</body>
@endsection
