@extends('layouts.masterLayout')

@section('header','Edit Author')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

        {{ Breadcrumbs::render('admin_author_edit',$accounts->confirmation_code,$author) }}        

        <form method="post" action="{{ Route('admin_author_post',['confirmation_code'=>$accounts->confirmation_code]) }}" enctype="multipart/form-data">
            <fieldset>
                <legend>Edit Author</legend>
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
                <input type="hidden" name="id" value="{{ $author->id }}">
                <label for="name">Author Name</label><br>
                <input type="text" name="name" id="name" value="{{ $author->name }}" class="form-control"><br>
                <label for="title">Title</label><br>
                <input type="text" name="title" id="title" value="{{ $author->title }}" class="form-control"><br>
                <label for="DOB">DOB</label><br>
                <input type="date" name="DOB" id="DOB" value="{{ $author->DOB }}" class="form-control"><br><br>
                <button type="submit" class="btn btn-warning">Edit</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </fieldset>
        </form><br>
        </div>
    </div>
@stop
