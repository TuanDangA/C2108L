@extends('layouts.masterLayout')

@section('header','Delete Animal Category')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

        {{ Breadcrumbs::render('admin_categoryAnimal_delete',$accounts->confirmation_code,$category->id) }}            

        <form method="post" action="{{ Route('admin_categoryAnimal_post',['confirmation_code'=>$accounts->confirmation_code]) }}">
            <fieldset>
                <legend>Delete Animal Category</legend>
                {{ csrf_field() }}
                Do you sure you want to delete this category?<br>
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id_category" value="{{ $category->id }}">
                <label for="name">Animal Category Name</label><br>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" disabled><br><Br>
                <button type="submit" class="btn btn-danger">Delete</button>
            </fieldset><br>
        </form>
        </div>
    </div>
@stop