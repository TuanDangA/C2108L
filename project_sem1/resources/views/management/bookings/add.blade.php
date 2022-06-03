@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | CHOOSE EVENT TITLE')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('bookings-add',$accounts->confirmation_code) }}        

        <form method="get" action="{{ route('bookings-add-confirm', $accounts->confirmation_code) }}">
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

                <label for="id_event">Event Title</label>
                <select name="id_event" id="id_event" class="form-control">
                    <option value="">--Select--</option>
                    @foreach ($bookings as $item)
                    <option value="{{ $item->id }}">{{ $item->title}} - ${{ $item->price }}</option>
                    @endforeach
                </select>
                <br>
                <button class="btn btn-success">Next</button>
            </div>
        </form>
    </div>
@stop