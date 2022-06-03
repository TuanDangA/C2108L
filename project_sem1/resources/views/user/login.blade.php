@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | LOGIN')

@section('css-body')
    {{ asset('css/user/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="card" style="border:none">

            @if (!(Session::has('status')))
                {{ Breadcrumbs::render('login-page') }} 
            @endif
            @if (Session::has('status'))
                {{ Breadcrumbs::render('register') }} 
            @endif
            
            <div class="card-header bg-primary text-white">
                Login
            </div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="post">
                    <div class="container">
                        <div class="form-group">
                            @csrf

                            @if (count ($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            @if (Session::has('message'))
                                <div class="alert alert-success">
                                    {{ Session::get('message') }} 
                                </div>
                            @endif

                            @if (Session::has('msg'))
                                <div class="alert alert-danger">
                                    {{ Session::get('msg') }} 
                                </div>
                            @endif

                            @if (Session::has('status'))
                                @if (Session::get('status') == 'Password has been reset successfully!')
                                    <div class="alert alert-success">
                                        {{ Session::get('status') }} 
                                    </div>
                                @endif
                                @if (Session::get('status') != 'Password has been reset successfully!')
                                    <div class="alert alert-warning">
                                        {{ Session::get('status') }} 
                                    </div>
                                @endif
                            @endif

                            <label><i class="fas fa-envelope"></i> Email</label>
                            <input type="text" class="form-control" name="email">
                            <label><i class="fas fa-key"></i> Password</label>
                            <input type="password" class="form-control" name="password">
                            <br>
                            <input type="checkbox" name="token">Remember me
                            <br><br>
                            <button class="btn btn-success">Login</button>
                            <br>
                            <a href="{{ route('register-page') }}">I don't have account</a>
                            <br>
                            <a href="{{ route('forgot-password-page') }}">Forgot password</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop