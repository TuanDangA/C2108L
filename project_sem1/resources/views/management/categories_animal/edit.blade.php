@extends('layouts.masterLayout')

@section('header','Edit Animal Category')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

        {{ Breadcrumbs::render('admin_categoryAnimal_edit',$accounts->confirmation_code,$category->id) }}            

        <form method="post" action="{{ Route('admin_categoryAnimal_post',['confirmation_code'=>$accounts->confirmation_code]) }}" enctype="multipart/form-data">
            <fieldset>
                <legend>Edit Animal Category</legend>
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
                <label for="name">Animal Category Name</label><br>
                <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control"><br><br>
                <button type="submit" class="btn btn-info">Edit</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </fieldset><br>
        </form>
        </div>
    </div>
@stop
