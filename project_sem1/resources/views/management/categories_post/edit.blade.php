@extends('layouts.masterLayout')

@section('header','Edit Post Category')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

            {{ Breadcrumbs::render('admin_categoriesPost_edit',$accounts->confirmation_code,$category->id,$category) }}        

            <form method="post" action="{{ Route('admin_categoriesPost_post',['confirmation_code'=>$accounts->confirmation_code]) }}">
                <fieldset>
                    <legend>Edit Post Category</legend>
                    {{ csrf_field() }}
                    @if (count ($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id_category" value="{{ $category->id }}">
                    <label for="name">Post Category Name</label><br>
                    <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control"><br><br>
                    <button type="submit" class="btn btn-info">Edit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
            </form><br><br>
        </div>
    </div>
@stop