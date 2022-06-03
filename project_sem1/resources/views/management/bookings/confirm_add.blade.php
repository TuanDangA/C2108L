@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | ADD NEW EVENT')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('bookings-add-confirm',$accounts->confirmation_code,$bookings['events']->id) }}        

        <form method="post" action="{{ route('bookings-insert', $accounts->confirmation_code) }}">
            <div class="form-group">
                @csrf

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <label>Event Title</label>
                <input type="text" class="form-control" readonly value="{{ $bookings['events']->title }}">
                <input type="hidden" name="id_event" value="{{ $bookings['events']->id }}">
                <label for="details">Details</label> 
                <input type="text" id="details" class="form-control" name="details">
                <label for="arrival_date">Arrival Date</label> 
                <input type="date" class="form-control" id="arrival_date" name="arrival_date">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity">
                <label for="price">Price($)</label>
                <input type="number" class="form-control" name="price" id="price" value="{{ $bookings['events']->price }}" readonly>
                <label for="total">Total amount</label>
                <input type="text" class="form-control" id="total" readonly>
                <label for="id">User Email</label>
                <select name="id" class="form-control" id="id">
                    <option value="">--Select--</option>
                    @foreach ($bookings['users'] as $item)
                        <option value="{{ $item->id }}">{{ $item->email }}</option>
                    @endforeach
                </select>
                <br>
                <button class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#quantity").keyup(function() {
                var price = $("#price").val();
                var quantity = $(this).val();
                var total = price * quantity;

                $("#total").val('$'+total);
            });
        });
    </script>
@stop

