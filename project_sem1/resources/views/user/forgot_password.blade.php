@extends('layouts.masterLayout')

@section('title')
    Forgot Password
@stop

@section('content')
    <div class="container" style="margin-top: 100px;">

        @if (!(Session::has('status')))
            {{ Breadcrumbs::render('forgot-password-page') }}        
        @endif

        @if (Session::has('status') && Session::get('status') != 'done')
            {{ Breadcrumbs::render('forgot-password-confirm') }}        
        @endif

        @if (Session::has('confirm'))
            {{ Breadcrumbs::render('forgot-password-reset') }}        
        @endif

        @if (count ($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if (Session::has('confirm'))
            <div class="alert alert-success">
                {{ Session::get('confirm') }} 
            </div>
        @endif

        @if (Session::has('msg'))
            <div class="alert alert-warning">
                {{ Session::get('msg') }} 
            </div>
        @endif

        @if (Session::has('status') && Session::get('status') != 'done')
            <div class="alert alert-warning">
                {{ Session::get('status') }} 
            </div>
        @endif

        <div style="display: @if (Session::has('status') || Session::has('confirm') || $errors->has('password')) none @endif">
            <form method="post" action="{{ route('forgot-password-confirm') }}" >
                <div class="form-group">
                    @csrf    
                    <label>Email</label>
                    <input type="text" class="form-control" name="email">
                    <br>
                    <button class="btn btn-success">Next</button>
                </div>
            </form>
        </div>
            
        <div style="display: @if (Session::has('confirm') || $errors->has('password')) @else none @endif">
            <form method="post" action="{{ route('forgot-password-reset') }}" >
                <div class="form-group">
                    @csrf
                    <input type="hidden" name="email" value="{{ Session::get('email') }}"> 
                    <label>New Password</label>
                    <input type="password" class="form-control" name="password">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation">
                    <br>
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop
