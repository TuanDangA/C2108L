@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | CHANGE PASSWORD')

@section('css-body')
    {{ asset('css/user/changepwd.css') }}
@stop


@section('content')
<div class="body">
    <div class="container">

        <div style="margin-left:70px;">
            @if (!is_null($accounts))
                {{ Breadcrumbs::render('profile-change-password', $accounts->confirmation_code) }}        
            @endif
            @if (is_null($accounts))
                {{ Breadcrumbs::render('profile-change-password', "guest") }}        
            @endif
        </div>
        
        <table>
            <tr>
                <td>
                    <form method="post" action="{{ route('profile-change-password-save', $accounts->confirmation_code) }}">
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

                        @if (Session::has('msg'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{Session::get('msg')}}</li>
                                </ul>
                            </div>
                        @endif

                        <input type="hidden" name="id" value="{{ $accounts->id }}">
                        <div>
                            <label>Current password:</label>
                            <input type="password" name="oldPwd">
                        </div>
                        <div>
                            <label>New password:</label>
                            <input type="password" name="password">
                        </div>
                        <div>
                            <label>Confirm new password:</label>
                            <input type="password" name="password_confirmation">
                        </div>
                        <button type="submit">Save</button>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</div>
@stop
