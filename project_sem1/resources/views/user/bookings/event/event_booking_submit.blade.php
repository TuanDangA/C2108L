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
            @if ($request->id_old_booking_event !=0)
                {{ Breadcrumbs::render('user_event_booking_submit',$accounts->confirmation_code,$event->href_param,$request->id_old_booking_event) }}        
            @endif
            @if ($request->id_old_booking_event ==0)
                {{ Breadcrumbs::render('user_event_booking_submit',$accounts->confirmation_code,$event->href_param,0) }}        
            @endif
        @endif
        @if (is_null($accounts))
            @if ($request->id_old_booking_event !=0)
            {{ Breadcrumbs::render('user_event_booking_submit',"guest",$event->href_param,$request->id_old_booking_event) }}        
            @endif
            @if ($request->id_old_booking_event ==0)
            {{ Breadcrumbs::render('user_event_booking_submit',"guest",$event->href_param,0) }}        
            @endif  
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
                    <th>Event</th>
                    <th>Detail</th> 
                    <th>Start-time</th>
                    <th>End-time</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <tr class="table-primary">
                    <td>1</td>
                    <td>{{ $accounts->fullname }}</td>
                    <td>{{ $accounts->email }}</td>
                    <td>{{ $accounts->phone }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $request->details }}</td>
                    <td>{{ $event->start_date }}</td>
                    <td>{{ $event->end_date }}</td>
                    <td>{{ $request->quantity }}</td>
                    <td>{{ $request->price }}</td>
                </tr>
            </tbody>
        </table>

        <div class="form-group">
            <a href="{{ route('user_booking_list',['confirmation_code'=>$accounts->confirmation_code]) }}"><button type="button" class="btn btn-info">My Bookings</button></a>
            <a href="{{ route('home',['confirmation_code'=>$accounts->confirmation_code]) }}"><button type="button" class="btn btn-success">Home</button></a>
        </div>
    </div>
@endsection