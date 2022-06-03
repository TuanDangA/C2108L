@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | Booking-Submit')

@section('css-body')
    {{ asset('css/user/booking/booking_submit.css') }}
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
            {{ Breadcrumbs::render('user_visit_booking_submit',$accounts->confirmation_code,$request->id_old_booking_adults,$request->id_old_booking_children) }}        
        @endif
        @if (is_null($accounts))
            {{ Breadcrumbs::render('user_visit_booking_submit',"guest",$request->id_old_booking_adults,$request->id_old_booking_children) }}        
        @endif
    </div>

    <!-- Phần 3: Text -->
    <div class="content-body container">
        <h2>Thank you! Booking Successfull</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr >
                    <th>No.</th>
                    <th>Name Visitor</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Detail</th> 
                    <th>Arrival date</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @if ($request->quantity_adults >0)
                    <tr class="table-primary">
                        <td>{{ ++$index }}</td>
                        <td>{{ $accounts->fullname }}</td>
                        <td>{{ $accounts->email }}</td>
                        <td>{{ $accounts->phone }}</td>
                        <td>{{ $request->details }}</td>
                        <td>{{ $request->arrival_date }}</td>
                        <td>{{ $request->quantity_adults }}</td>
                        <td>{{ $request->total_price_adults }}</td>
                    </tr>
                @endif
                @if ($request->quantity_children>0)
                    <tr class="table-primary">
                        <td>{{ ++$index }}</td>
                        <td>{{ $accounts->fullname }}</td>
                        <td>{{ $accounts->email }}</td>
                        <td>{{ $accounts->phone }}</td>
                        <td>{{ $request->details }}</td>
                        <td>{{ $request->arrival_date }}</td>
                        <td>{{ $request->quantity_children }}</td>
                        <td>{{ $request->total_price_children }}</td>
                    </tr>
                @endif
                <tr class="table-primary">
                    <td colspan="7"><center>TOTAL</center></td>
                    <td style="width:60px">
                        {{ $request->total_price }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="form-group">
            <a href="{{ route('user_booking_list',['confirmation_code'=>$accounts->confirmation_code]) }}"><button type="button" class="btn btn-info">My Bookings</button></a>
            <a href="{{ route('home',['confirmation_code'=>$accounts->confirmation_code]) }}"><button type="button" class="btn btn-success">Home</button></a>
        </div>
    </div>
@endsection