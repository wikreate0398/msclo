<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Войти в Панель</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('admin_theme/admin/') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_theme/admin/') }}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_theme/admin/') }}/assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme/admin/') }}/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme/admin/') }}/assets/css/forms/switches.css">
    <link href="{{ asset('admin_theme/admin/') }}/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/loader.css') . '?v=' . time() }}" rel="stylesheet">
</head>
<body class="form">

<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">Войти</h1>

                    <form class="text-left login-form ajax__submit" action="{{ route('admin_run_login') }}">

                        {{ csrf_field() }}

                        <div class="form">

                            @if ($errors->has('login'))
                                <div class="alert alert-danger">{{ $errors->first('login') }}</div>
                            @endif

                            <div id="username-field" class="field-wrapper input">
                                <label for="username">E-MAIL</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="username" name="email" type="text" class="form-control" placeholder="E-mail">
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password">ПАРОЛЬ</label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Пароль">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary submit-btn" value="">Войти</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('admin_theme/admin/') }}/assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="{{ asset('admin_theme/admin/') }}/bootstrap/js/popper.min.js"></script>
<script src="{{ asset('admin_theme/admin/') }}/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ asset('admin_theme/admin/') }}/plugins/notification/snackbar/snackbar.min.js"></script>

<script src="/admin_theme/assets/js/ajax.js?v={{time()}}" type="text/javascript"></script>

</body>
</html>