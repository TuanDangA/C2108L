@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | Booking-Confirm')

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
            @if ($request->id_old_booking_event !=0)
                {{ Breadcrumbs::render('user_event_booking_confirm',$accounts->confirmation_code,$event->href_param,$request->id_old_booking_event) }}        
            @endif
            @if ($request->id_old_booking_event ==0)
                {{ Breadcrumbs::render('user_event_booking_confirm',$accounts->confirmation_code,$event->href_param,0) }}        
            @endif
        @endif
        @if (is_null($accounts))
            @if ($request->id_old_booking_event !=0)
            {{ Breadcrumbs::render('user_event_booking_confirm',"guest",$event->href_param,$request->id_old_booking_event) }}        
            @endif
            @if ($request->id_old_booking_event ==0)
            {{ Breadcrumbs::render('user_event_booking_confirm',"guest",$event->href_param,0) }}        
            @endif  
        @endif
    </div>

    <!-- Phần 3: Text -->
    <div class="content-body container">
            <h2> Ticket Event confirm</h2>
            <p>Thanks for your interest in hosting a special event at the Aquarium. Please confirm the content below to complete the booking.</p>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr >
                        <th>No.</th>
                        <th>FullName</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Event</th>
                        <th>Details</th> 
                        <th>Start-time</th>
                        <th>End-time</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th style="width:60px"></th>
                        <th style="width:60px"></th>
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
                        <td style="width:60px">
                            @if ($request->id_old_booking_event !=0 )
                                <form method="post" action="{{ route('user_event_booking_edit',['confirmation_code'=>$accounts->confirmation_code,'href_param'=>$event->href_param]) }}">
                                    @csrf
                                    <input type="hidden" name="id_old_booking_event" value="{{ $request->id_old_booking_event }}">
                                    <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                                    <input type="hidden" name="id_event" value="{{ $event->id }}">
                                    <input type="hidden" name="quantity" value="{{ $request->quantity }}">
                                    <input type="hidden" name="price" value="{{ $request->price }}">
                                    <input type="hidden" name="details" value="{{ $request->details }}">
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </form>
                            @endif
                            @if ($request->id_old_booking_event ==0)
                                <form method="post" action="{{ route('user_event_booking_edit',['confirmation_code'=>$accounts->confirmation_code,'href_param'=>$event->href_param]) }}">
                                    @csrf
                                    <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                                    <input type="hidden" name="id_event" value="{{ $event->id }}">
                                    <input type="hidden" name="quantity" value="{{ $request->quantity }}">
                                    <input type="hidden" name="price" value="{{ $request->price }}">
                                    <input type="hidden" name="details" value="{{ $request->details }}">
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </form>
                            @endif
                        </td>
                        <td style="width:60px">
                            @if ($request->id_old_booking_event != 0)
                                <a href="{{ route('user_booking_list',['confirmation_code'=>$accounts->confirmation_code]) }}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            @endif
                            @if ($request->id_old_booking_event == 0)
                                <a href="{{ route('event-detail',['confirmation_code'=>$accounts->confirmation_code,'href_param'=>$event->href_param,'id']) }}"><button type="button" class="btn btn-danger">Cancel</button></a> 
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <form method="post" action="{{ route('user_event_booking_submit',['confirmation_code'=>$accounts->confirmation_code,'href_param'=>$event->href_param]) }}">    
                @csrf
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if ($request->id_old_booking_event !=0)<input type="hidden" name="action" value="edit">@endif
                @if ($request->id_old_booking_event ==0)<input type="hidden" name="action" value="add">@endif
                <input type="hidden" name="id_old_booking_event" value="{{ $request->id_old_booking_event }}">
                <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                <input type="hidden" name="id_event" value="{{ $event->id }}">
                <input type="hidden" name="quantity" value="{{ $request->quantity }}">
                <input type="hidden" name="price" value="{{ $request->price }}">
                <input type="hidden" name="details" value="{{ $request->details }}">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Book</button>
                </div>
            </form>
    </div>
@endsection


 