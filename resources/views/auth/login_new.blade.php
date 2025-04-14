<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Admin - Login </title>

    <link rel="stylesheet" href="{{asset('login/reset.css')}}">

    <link rel="stylesheet" href="{{asset('login/style.css')}}" media="screen" type="text/css" />

</head>

<body>

<div class="wrap">
    <div class="avatar">
        <img src="{{asset('img/final_logo_dcs.png')}}">
    </div>
<form class="form" action="{{ url('/') }}" method="post">
    @csrf
    <input name="email" type="text" placeholder="username" required>
    <div class="bar">
        <i></i>
    </div>
    <input name="password" type="password" placeholder="password" required>
    <button type="submit">Login</button>
</form>
</div>
@if(session()->has('error'))
    <br>
    <div style="text-align: center;" class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

<script src="js/index.js"></script>

</body>

</html>
