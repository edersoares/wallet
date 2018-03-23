<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Wallet') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }
        #app {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            min-height: 100%;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .checkbox {
            font-weight: 400;
        }
        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body>
<div id="app" class="text-center">
    <form class="form-signin" method="post" action="{{ route('login') }}">

        @csrf

        <h1>Wallet</h1>
        <h2 class="h4 mb-3 font-weight-normal">{{ __('Login') }}</h2>
        <label class="sr-only">{{ __('E-Mail') }}</label>
        <input type="email" name="email" class="form-control" placeholder="{{ __('E-Mail') }}" required autofocus>
        <label class="sr-only">{{ __('Password') }}</label>
        <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="remember"> {{ __('Remember Me') }}
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
        <p class="mt-3 mb-3">
            <a href="{{ route('register') }}">{{ __('Register') }}</a>
            <span class="text-muted"> | </span>
            <a href="{{ route('password.request') }}">{{ __('Forgot Password') }}</a>
        </p>
    </form>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
