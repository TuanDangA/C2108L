@extends('layouts.masterLayout')

@section('header','Delete Range')
@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

            {{ Breadcrumbs::render('admin_range_delete',$accounts->confirmation_code,$range) }}        

        <form method="post" action="{{ Route('admin_range_post',['confirmation_code'=>$accounts->confirmation_code]) }}">
            <fieldset>
                <legend>Delete Range</legend>
                {{ csrf_field() }}
                Do you sure you want to delete this range?<br><br>
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="{{ $range->id }}">
                <label for="name">Range</label><br>
                <input type="text" name="name" value="{{ $range->name }}" class="form-control" disabled><br><br>
                <button type="submit" class="btn btn-danger">Delete</button>
            </fieldset>
        </form><br>
        </div>
    </div>
@stop