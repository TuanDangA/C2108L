@extends('layouts.masterLayout')

@section('header','Edit Range')
@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

        {{ Breadcrumbs::render('admin_range_edit',$accounts->confirmation_code,$range) }}        

        <form method="post" action="{{ Route('admin_range_post',['confirmation_code'=>$accounts->confirmation_code]) }}" enctype="multipart/form-data">
            <fieldset>
                <legend>Edit Range</legend>
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
                <input type="hidden" name="id" value="{{ $range->id }}">

                <label for="name">Range</label><br>
                <input type="text" name="name" id="name" value="{{ $range->name }}" class="form-control"><br><br>
                <button type="submit" class="btn btn-warning">Edit</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </fieldset>
        </form><br>
        </div>
    </div>
@stop
