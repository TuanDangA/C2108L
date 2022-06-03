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
            {{ Breadcrumbs::render('user_visit_booking_confirm',$accounts->confirmation_code,$request->id_old_booking_adults,$request->id_old_booking_children) }}        
        @endif
        @if (is_null($accounts))
            {{ Breadcrumbs::render('user_visit_booking_confirm',"guest",$request->id_old_booking_adults,$request->id_old_booking_children) }}        
        @endif
    </div>

    <!-- Phần 3: Text -->
    <div class="content-body container">
        <h2> Ticket Visit confirm</h2>
        <p>Thanks for your interest in us. Please confirm the content below to complete the booking.</p>
        <table class="table table-bordered table-hover">
            <thead>
                <tr >
                    <th>No.</th>
                    <th>Name Visitor</th>
                    <th>Event</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Details</th>
                    <th>Arrival date</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th style="width:60px"></th>
                    <th style="width:60px"></th>
                </tr>
            </thead>

            <tbody>
                @if ($request->quantity_adults >0)
                    <tr class="table-primary">
                        <td>{{ ++$index }}</td>
                        <td>{{ $accounts->fullname }}</td>
                        <td>{{ $visit_adults->title }}</td>
                        <td>{{ $accounts->email }}</td>
                        <td>{{ $accounts->phone }}</td>
                        <td>{{ $request->details }}</td>
                        <td>{{ $request->arrival_date }}</td>
                        <td>{{ $request->quantity_adults }}</td>
                        <td>{{ $request->total_price_adults }}</td>
                        <td style="width:60px;vertical-align:middle">
                            @if (($request->id_old_booking_adults !=0) || ($request->id_old_booking_children !=0))
                                <center>
                                    <form method="post" action="{{ route('user_visit_booking_edit',['confirmation_code'=>$accounts->confirmation_code]) }}">    
                                        @csrf  
                                        <input type="hidden" name="id_old_booking_adults" value="{{ $request->id_old_booking_adults }}">
                                        <input type="hidden" name="id_old_booking_children" value="{{ $request->id_old_booking_children }}">
                                        <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                                        <input type="hidden" name="quantity_adults" value="{{ $request->quantity_adults }}">
                                        <input type="hidden" name="quantity_children" value="{{ $request->quantity_children }}">
                                        <input type="hidden" name="total_price_adults" value="{{ $request->total_price_adults }}">
                                        <input type="hidden" name="total_price_children" value="{{ $request->total_price_children }}">            
                                        <input type="hidden" name="arrival_date" value="{{ $request->arrival_date }}">
                                        <input type="hidden" name="details" value="{{ $request->details }}">
                                        <input type="hidden" name="total_price" value="{{ $request->total_price }}">
                                        <button type="submit" class="btn btn-warning">Edit</button>
                                    </form>
                                </center>
                            @endif
                            @if (($request->id_old_booking_adults ==0) && ($request->id_old_booking_children ==0))
                                <center>
                                    <form method="post" action="{{ route('user_visit_booking_edit',['confirmation_code'=>$accounts->confirmation_code]) }}">    
                                        @csrf  
                                        <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                                        <input type="hidden" name="quantity_adults" value="{{ $request->quantity_adults }}">
                                        <input type="hidden" name="quantity_children" value="{{ $request->quantity_children }}">
                                        <input type="hidden" name="total_price_adults" value="{{ $request->total_price_adults }}">
                                        <input type="hidden" name="total_price_children" value="{{ $request->total_price_children }}">            
                                        <input type="hidden" name="arrival_date" value="{{ $request->arrival_date }}">
                                        <input type="hidden" name="details" value="{{ $request->details }}">
                                        <input type="hidden" name="total_price" value="{{ $request->total_price }}">
                                        <button type="submit" class="btn btn-warning">Edit</button>
                                    </form>
                                </center>
                            @endif
                        </td>
                        <td style="width:60px;vertical-align:middle">
                            <center><a href="{{ route('user_visit_booking_details',['confirmation_code'=>$accounts->confirmation_code]) }}"><button class="btn btn-danger">Cancel</button></a></center>
                        </td>
                    </tr>
                @endif
                @if ($request->quantity_children>0)
                    <tr class="table-primary">
                        <td>{{ ++$index }}</td>
                        <td>{{ $accounts->fullname }}</td>
                        <td>{{ $visit_children->title }}</td>
                        <td>{{ $accounts->email }}</td>
                        <td>{{ $accounts->phone }}</td>
                        <td>{{ $request->details }}</td>
                        <td>{{ $request->arrival_date }}</td>
                        <td>{{ $request->quantity_children }}</td>
                        <td>{{ $request->total_price_children }}</td>
                        <td style="width:60px;vertical-align:middle">
                            @if (($request->id_old_booking_adults !=0) || ($request->id_old_booking_children !=0))
                                <center>
                                    <form method="post" action="{{ route('user_visit_booking_edit',['confirmation_code'=>$accounts->confirmation_code]) }}">    
                                        @csrf  
                                        <input type="hidden" name="id_old_booking_adults" value="{{ $request->id_old_booking_adults }}">
                                        <input type="hidden" name="id_old_booking_children" value="{{ $request->id_old_booking_children }}">
                                        <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                                        <input type="hidden" name="quantity_adults" value="{{ $request->quantity_adults }}">
                                        <input type="hidden" name="quantity_children" value="{{ $request->quantity_children }}">
                                        <input type="hidden" name="total_price_adults" value="{{ $request->total_price_adults }}">
                                        <input type="hidden" name="total_price_children" value="{{ $request->total_price_children }}">            
                                        <input type="hidden" name="arrival_date" value="{{ $request->arrival_date }}">
                                        <input type="hidden" name="details" value="{{ $request->details }}">
                                        <input type="hidden" name="total_price" value="{{ $request->total_price }}">
                                        <button type="submit" class="btn btn-warning">Edit</button>
                                    </form>
                                </center>
                            @endif
                            @if (($request->id_old_booking_adults ==0) && ($request->id_old_booking_children ==0))
                                <center>
                                    <form method="post" action="{{ route('user_visit_booking_edit',['confirmation_code'=>$accounts->confirmation_code]) }}">    
                                        @csrf  
                                        <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                                        <input type="hidden" name="quantity_adults" value="{{ $request->quantity_adults }}">
                                        <input type="hidden" name="quantity_children" value="{{ $request->quantity_children }}">
                                        <input type="hidden" name="total_price_adults" value="{{ $request->total_price_adults }}">
                                        <input type="hidden" name="total_price_children" value="{{ $request->total_price_children }}">            
                                        <input type="hidden" name="arrival_date" value="{{ $request->arrival_date }}">
                                        <input type="hidden" name="details" value="{{ $request->details }}">
                                        <input type="hidden" name="total_price" value="{{ $request->total_price }}">
                                        <button type="submit" class="btn btn-warning">Edit</button>
                                    </form>
                                </center>
                            @endif
                        </td>
                        <td style="width:60px;vertical-align:middle">
                            <center><a href="{{ route('user_visit_booking_details',['confirmation_code'=>$accounts->confirmation_code]) }}"><button class="btn btn-danger">Cancel</button></a></center>
                        </td>
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
            <form method="post" action="{{ route('user_visit_booking_submit',['confirmation_code'=>$accounts->confirmation_code]) }}">    
                @csrf  
                @if (($request->id_old_booking_adults !=0) || ($request->id_old_booking_children !=0))
                    <input type="hidden" name="action" value="edit">
                @endif
                @if (($request->id_old_booking_adults ==0) && ($request->id_old_booking_children ==0))
                    <input type="hidden" name="action" value="add">
                @endif
                <input type="hidden" name="id_old_booking_adults" value="{{ $request->id_old_booking_adults }}">
                <input type="hidden" name="id_old_booking_children" value="{{ $request->id_old_booking_children }}">
                <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                <input type="hidden" name="quantity_adults" value="{{ $request->quantity_adults }}">
                <input type="hidden" name="quantity_children" value="{{ $request->quantity_children }}">
                <input type="hidden" name="total_price_adults" value="{{ $request->total_price_adults }}">
                <input type="hidden" name="total_price_children" value="{{ $request->total_price_children }}">            
                <input type="hidden" name="arrival_date" value="{{ $request->arrival_date }}">
                <input type="hidden" name="details" value="{{ $request->details }}">
                <input type="hidden" name="total_price" value="{{ $request->total_price }}">
                <button type="submit" class="btn btn-success">Book</button>
            </form>
        </div>
        <div class="form-group">
            <a href="{{ route('home',['confirmation_code'=>$accounts->confirmation_code]) }}"><button type="button" class="btn btn-danger">Home</button></a>
        </div>
    </div>
@endsection