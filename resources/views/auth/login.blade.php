<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Tricker">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>登录 - by Tricker</title>

    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>

<body>

    <div class="login">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card login-card">
                    <div class="card-header">登录</div>
                    <div class="card-body">
    @include('shared.errors')
    @include('shared.messages')
                        <form method="post" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="account">帐号：</label>
                                <input class="form-control" type="text" name="account" id="account" placeholder="请输入帐号…" value="{{ old('account') }}" required
                                    autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password">密码：</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="请输入密码…" required>
                            </div>
                            <div class="form-group form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="check">记住我</label>
                                <a class="right" href="#">忘记密码？</a>
                            </div>
                            <button class="btn btn-success btn-block" type="submit">登录</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</body>

</html>
