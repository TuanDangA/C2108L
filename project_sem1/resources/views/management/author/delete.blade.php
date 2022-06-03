@extends('layouts.masterLayout')

@section('header','Delete Author')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

            {{ Breadcrumbs::render('admin_author_delete',$accounts->confirmation_code,$author) }}        

            <form method="post" action="{{ Route('admin_author_post',['confirmation_code'=>$accounts->confirmation_code]) }}">
                <fieldset>
                    <legend>Delete Author</legend>
                    {{ csrf_field() }}
                    Do you sure you want to delete this author?<br>
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="{{ $author->id }}">
                    <label for="name">Animal Author</label><br>
                    <input type="text" name="name" value="{{ $author->name }}" class="form-control" disabled><br>
                    <label for="title">Title</label><br>
                    <input type="text" name="title" value="{{ $author->title }}" class="form-control" disabled><br>
                    <label for="DOB">DOB</label><br>
                    <input type="date" name="DOB" value="{{ $author->DOB }}" class="form-control" disabled><br><br>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </fieldset>
            </form><br>
        </div>
    </div>
@stop