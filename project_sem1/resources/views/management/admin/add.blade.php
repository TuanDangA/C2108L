@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | ADD NEW ADMIN')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('new_admin-add',$accounts->confirmation_code) }}        

        <div class="card">
            <div class="card-header bg-primary text-white">
                Add new admin
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('new_admin-insert', $accounts->confirmation_code) }}" >
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
        
                        <label for="fullname"><i class="fas fa-address-card"></i> Fullname</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Name...">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email...">
                        <label for="password"><i class="fas fa-key"></i> Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password...">
                        <label for="password_confirmation"><i class="fas fa-key"></i> Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password...">  
                        <br>
                        <button class="btn btn-success">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop