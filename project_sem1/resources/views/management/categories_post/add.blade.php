@extends('layouts.masterLayout')

@section('header','Add Post Category')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

            {{ Breadcrumbs::render('admin_categoriesPost_add',$accounts->confirmation_code) }}        

            <form method="post" action="{{ route('admin_categoriesPost_post',['confirmation_code'=>$accounts->confirmation_code]) }}">
                <fieldset>
                    <legend>Add Post Category</legend>
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
                    
                    <input type="hidden" name="action" value="add">
                    <label for="name">Category Name</label><br>
                    <input type="text" name="name" id="name" class="form-control"><br>
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </fieldset>        
            </form><br>
        </div>
    </div>
@stop