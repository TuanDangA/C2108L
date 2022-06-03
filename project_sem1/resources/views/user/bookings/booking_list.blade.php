@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | Booking-List')

@section('css-body')
    {{ asset('css/user/booking/booking_confirm.css') }}
@stop

@section('content')
    <!-- phần 2: IMG-->
    <div class="content-img container-fluid">
        <div class="content-header container" style="background-image: url('{{ asset('storage/images/rand_backgrounds/'.$backgroundname) }}')">
            <!-- background img -->
        </div>
    </div>
    <div style="margin-left:0px;width:96%;margin-top:40px;">
        @if (!is_null($accounts))
        {{ Breadcrumbs::render('booking_list', $accounts->confirmation_code) }}        
    @endif
    @if (is_null($accounts))
        {{ Breadcrumbs::render('booking_list', "guest") }}        
    @endif
    </div>
    <!-- Phần 3: Text -->
    <div class="content-body container">
        <h2>Booking List</h2>
        <p style="color:red;">Note: bookings that are due before 24 hours are non-editable</p>
        <table class="table table-bordered table-hover">
            <thead>
                <tr >
                    <th>No.</th>
                    <th>Name Visitor</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Event</th>
                    <th>Details</th>
                    <th>Arrival date</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th style="width:120px" colspan="2"><center>Action</center></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($bookings as $booking)
                    <tr class="table-primary">
                        <td>{{ ++$index }}</td>
                        <td>{{ $booking->fullname }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->title }}</td>
                        <td>{{ $booking->details }}</td>
                        <td>{{ $booking->arrival_date }}</td>
                        <td>{{ $booking->quantity }}</td>
                        <td>{{ $booking->total_price }}</td>
                        <td style="width:60px;vertical-align:middle">
                            <center><a href="{{ route('user_booking_edit_route',['confirmation_code'=>$accounts->confirmation_code,'id_booking'=>$booking->id]) }}"><button class="btn btn-warning">Edit</button></a></center>
                        </td>
                        <td style="width:60px;vertical-align:middle">
                            <center><a href="{{ route('user_booking_delete_route',['confirmation_code'=>$accounts->confirmation_code,'id_booking'=>$booking->id]) }}"><button class="btn btn-danger">Cancel</button></a></center>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="form-group">
            <a href="{{ route('home',['confirmation_code'=>$accounts->confirmation_code]) }}"><button type="button" class="btn btn-success">Home</button></a>
        </div>
    </div>
@endsection