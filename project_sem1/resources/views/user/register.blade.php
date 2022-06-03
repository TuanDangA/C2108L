@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | LOGIN')

@section('css-body')
    {{ asset('css/user/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="card" style="border: none;">

            {{ Breadcrumbs::render('register-page') }}    
                
            <div class="card-header bg-warning text-white">
                Register
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('register') }}" >
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
        
                        <label><i class="fas fa-address-card"></i> Fullname</label>
                        <input type="text" class="form-control" name="fullname">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="text" class="form-control" name="email">
                        <label><i class="fas fa-key"></i> Password</label>
                        <input type="password" class="form-control" name="password">
                        <label><i class="fas fa-key"></i> Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation">  
                        <br>
                        <button class="btn btn-success">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop