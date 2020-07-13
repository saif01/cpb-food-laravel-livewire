<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Bootstrap-4.5 CSS--}}
    <link rel="stylesheet" href="{{ asset('all-assets/common/bootstrap-4.5/css/bootstrap.min.css') }}">

    <style>
        .container, .row {
            height: 100%;
            min-height: 100%;
        }

        html, body {
            height: 100%;
        }

</style>


</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 my-auto">
                <div class="card">
                    <div class="card-header">User Login</div>

                    <div class="card-body">

                        @if (Session::has('loginErrorMsg'))
                        <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
                            {{ Session::get('loginErrorMsg') }}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif



                        <form method="POST" action="{{ route('user.login.action') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="login" class="col-md-4 col-form-label text-md-right">Login ID</label>

                                <div class="col-md-6">
                                    <input id="login" type="login" class="form-control @error('login') is-invalid @enderror @if(Session::has('loginErrorMsg')) is-invalid @endif" name="login" value="{{ old('login') }}"  required autocomplete="login" autofocus>

                                    @error('login')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Bootstrap-4.5 JS--}}
    <script src="{{ asset('all-assets/common/bootstrap-4.5/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('all-assets/common/bootstrap-4.5/js/popper.min.js') }}"></script>
    <script src="{{ asset('all-assets/common/bootstrap-4.5/js/bootstrap.min.js') }}"></script>
</body>
</html>
