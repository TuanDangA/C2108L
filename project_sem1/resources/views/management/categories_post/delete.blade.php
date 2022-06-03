@extends('layouts.masterLayout')

@section('header','Add Post Category')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

            {{ Breadcrumbs::render('admin_categoriesPost_delete',$accounts->confirmation_code,$category->id,$category) }}        

            <form method="post" action="{{ Route('admin_categoriesPost_post',['confirmation_code'=>$accounts->confirmation_code]) }}">
                <fieldset>
                    <legend>Delete Post Category</legend>
                    {{ csrf_field() }}
                    Do you sure you want to delete this category?<br>
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id_category" value="{{ $category->id }}">
                    <label for="name">Post Category Name</label><br>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" disabled><br>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </fieldset>
            </form><br>
        </div>
    </div>
@stop