@extends('adminview.layouts.login_layout')

@section('content')

<form action="{{url('/login_admin')}}" method="POST">
@csrf
<div class="form-box" id="login-box">
    <div class="body bg-gray">
        <div style="text-align: center; "> <img style=" width: 80px;" src="{{asset('images/logo_main.png')}}"></div>
    <strong><b>Login</b></strong>
    <!--Login Invalid-->
    @if (session('invalidlogin'))
    <div class="alert alert-danger">
     <strong>Invalid! </strong>Email and Password.
  </div>      
@endif
<!--Invalid Authorization-->
@if (session('invalidauth'))
    <div class="alert alert-warning">
     <strong>Unauthorised access! </strong>Please Login.
  </div>      
@endif
    
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Enter your Email Id">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Enter your Password">
        </div>
        <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Login">
        </div>
    
    </div>
</div>
</form>




@endsection
