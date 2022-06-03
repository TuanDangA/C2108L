@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | EDIT BOOKING')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('bookings-edit-confirm',$accounts->confirmation_code,$bookings['bookings']->id,$bookings['events']->id) }}        

        <form method="post" action="{{ route('bookings-update', $accounts->confirmation_code) }}">
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
                <input type="hidden" name="id_event" value="{{ $bookings['events']->id }}">
                <input type="hidden" name="old_id_booking" value="{{ $bookings['bookings']->id }}">
                <label>Event Title</label>
                <input type="text" class="form-control" readonly value="{{ $bookings['events']->title }}">
                <label for="details">Details</label> 
                <input type="text" class="form-control" name="details" id="details" value="{{ $bookings['bookings']->details }}">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" value="{{ $bookings['bookings']->quantity }}">
                <label for="price">Price($)</label>
                <input type="number" class="form-control" name="price" id="price" value="{{ $bookings['events']->price }}" readonly>
                <label for="total">Total amount</label>
                <input type="text" class="form-control" id="total" readonly>
                <label for="id_user">User Email</label>
                <select name="id" class="form-control" id="id_user">
                    <option value="">--Select--</option>
                    @foreach ($bookings['users'] as $item)
                    <option value="{{ $item->id }}" @if ($bookings['bookings']->id_user == $item->id) selected @endif>{{ $item->email }}</option>
                    @endforeach
                </select>
                <br>
                <button class="btn btn-warning">Edit</button>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var price = $("#price").val();
            var quantity = $("#quantity").val();
            var total = price * quantity;
            
            $("#total").val('$'+total);

            $("#quantity").keyup(function() {
                $("#total").val('$'+ $("#price").val() * $(this).val());
            });
        });
    </script>
@stop

