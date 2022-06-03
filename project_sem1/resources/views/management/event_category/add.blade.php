@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | ADD NEW EVENT CATEGORY')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('event_category-add',$accounts->confirmation_code) }}        

        <form method="post" action="{{ route('event_category-insert', $accounts->confirmation_code) }}">
            <div class="form-group">
                @csrf

                @if (count ($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="name" name="name"> 
                <br>
                <button class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
@stop
