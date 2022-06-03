@extends('layouts.masterLayout')

@section('header','Delete Background')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

            {{ Breadcrumbs::render('admin_rand_backgrounds_delete',$accounts->confirmation_code,$background) }}        

            <form method="post" action="{{ Route('admin_rand_backgrounds_post',['confirmation_code'=>$accounts->confirmation_code]) }}">
                <fieldset>
                    <legend>Delete Background</legend>
                    {{ csrf_field() }}
                    Are You Sure You Want To Delete This Background?<br>
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="{{ $background->id }}">
                    <label for="thumbnail">Thumbnail</label><br>
                    <img src="{{ asset('storage/images/rand_backgrounds/'.$background->name) }}" id="imgSrc" alt="Error!Try Again"><br><br>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </fieldset>
            </form><br>
        </div>
    </div>
@stop

