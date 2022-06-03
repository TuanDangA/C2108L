@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | PROFILE')

@section('css-body')
    {{ asset('css/user/profile.css') }}
@stop

@section('content')
<div class="body">
    <div class="container">
        
        <div style="margin-left:70px;">
            @if (!is_null($accounts))
                {{ Breadcrumbs::render('profile-view', $accounts->confirmation_code) }}        
            @endif
            @if (is_null($accounts))
                {{ Breadcrumbs::render('profile-view', "guest") }}        
            @endif
        </div>

        @if (Session::has('msg'))
            <div class="alert alert-success">
                {{ Session::get('msg') }} 
            </div>
        @endif
        <table>
            <tr>
                <td>
                    <label>Fullname: </label>
                </td>
                <td>
                    <label>{{ $accounts->fullname }}</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email: </label>
                </td>
                <td>
                    <label>{{ $accounts->email }}</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Phone number: </label>
                </td>
                <td>
                    <label>{{ $accounts->phone }}</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password: </label>
                </td>
                <td>
                    <label>********<!--hard fixed --></label>
                    <a href="{{ route('profile-change-password', $accounts->confirmation_code) }}"><button style="font-size: 15px;color:red;">Change password</button></a>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Address: </label>
                </td>
                <td>
                    <label>{{ $accounts->address }}</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Gender: </label>
                </td>
                <td>
                    <label>{{ $accounts->gender }}</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Date of birth: </label>
                </td>
                <td>
                    <label>{{ $accounts->dob }}</label>
                </td>
            </tr>
        </table>
    </div>
    <center><a href="{{ route('profile-edit', $accounts->confirmation_code) }}"><button>Edit</button></a></center>
</div>
@stop
