@extends('auth.main')

@section('content')
    <div class="text-center mt-4">
      <h1 class="h2">{{ __('auth.welcome') }}</h1>
      <p class="lead">{{ __('auth.welcome_text') }}</p>
    </div>

    @if ($errors->has('email') or $errors->has('password') )
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <div class="alert-message">
        {{ $errors->first('email') }} {{ $errors->first('password') }} 
      </div>
    </div>
    @endif

    <div class="card">
      <div class="card-body">
        <div class="m-sm-4">
          <div class="text-center">
            <img src="{{ asset('img/logo.png') }}" class="img-fluid rounded-circle" width="132" height="132" />
          </div>
          <br>
          <form action="{{ route('login') }}" method="post">
            {{ csrf_field() }}
            <div class="mb-3">
              <label class="form-label">{{ __('auth.email') }}</label>
              <input class="form-control form-control-lg" type="email" name="email" placeholder="email@example.com" value="{{ old('email') }}" required autofocus />             
            </div>
            <div class="mb-3">
              <label class="form-label">{{ __('auth.password') }}</label>
              <input class="form-control form-control-lg" type="password" name="password" placeholder="******" />
              <small>
                {{-- 
                  <a href="pages-reset-password.html">Forgot password?</a>
                  <a href="{{ route('password.request') }}" class="float-right small">استعادة كلمة المرور ؟</a>
                --}}
              </small>
            </div>
            <div>
              <label class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="form-check-label">{{ __('auth.remember') }} </span>
              </label>
            </div>
            <div class="text-center mt-3">
              <button type="submit" class="btn btn-lg btn-primary">{{ __('auth.validate') }}</button>
              {{-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> --}}
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection

