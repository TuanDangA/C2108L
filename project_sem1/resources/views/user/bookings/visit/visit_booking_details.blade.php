@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | Booking-Details')

@section('css-body')
    {{ asset('css/user/booking/booking_details.css') }}
@stop

@section('content')
    <!-- phần 2: IMG-->
    <div class="content-img container-fluid">
        <div class="content-header container-fluid" style="background-image: url('{{ asset('storage/images/rand_backgrounds/'.$backgroundname) }}')">
            <!-- background img -->
        </div>
    </div>

    <div style="margin-left:0px;width:96%;margin-top:40px;">
        @if (!is_null($accounts))
            {{ Breadcrumbs::render('user_visit_booking_details',$accounts->confirmation_code) }}        
        @endif
        @if (is_null($accounts))
            {{ Breadcrumbs::render('user_visit_booking_details', "guest") }}        
        @endif
    </div>

    <!-- Phần 3: Text -->
    <div class="content-body container">

        <div class="left-body">
            <h2>Aquarium Admission</h2>
            <!-- Nội dung bài viết-Overview -->
            <p>The Nexus Aquarium is fully open! Guests may now enjoy our indoor galleries and exhibits.</p>

            <br>

            <p>You purchase tickets no additional reservation is required. Your purchased ticket serves as your reservation. You will be admitted at the time stated on your ticket (not before).</p>

            <br>
            
            <p>For those holding pre-purchased Aquarium tickets, you will be required to make a timed entry reservation to accompany the tickets you have in-hand.</p>

            <br>
                
            <p>For more info and our safety protocols, please visit our Aquarium Safety page.</p>

            <br>
                
            <p>If you are able, please consider making an additional donation to help support the non-profit Aquarium.</p>
        </div>

        
        <div class="right-body">
            <span>Plan your visit</span>
            <br><br>
            <h2>HOURS OF OPERATION</h2>
            <p>Guests may tour up to 90 minutes after the last entry time.</p>
            <div class="item">
                <div class="label">Monday</div>
                <div class="time">9 AM - 9 PM</div>
            </div>
            <div class="item">
                <div class="label">Tuseday</div>
                <div class="time">9 AM - 9 PM</div>
            </div>
            <div class="item">
                <div class="label">Wednesday</div>
                <div class="time">9 AM - 9 PM</div>
            </div>
            <div class="item">
                <div class="label">Thursday</div>
                <div class="time">9 AM - 9 PM</div>
            </div>
            <div class="item">
                <div class="label">Firday</div>
                <div class="time">9 AM - 9 PM</div>
            </div>
            <div class="item">
                <div class="label">Saturday</div>
                <div class="time">9 AM - 9  PM</div>
            </div>
            <div class="item">
                <div class="label">Sunday</div>
                <div class="time">9 AM - 9 PM</div>
            </div>
        </div>

    </div>

    <!-- Phần 4: Img & JS text -->
    <div class="slide-body container"><br>
        <h2>Admission and Ticket Information</h2>

        <div class="row">
            <div class="col-sm-6">
                <div class="cards">
                    <div class="top">
                        <h3>ADULTS</h3>
                        <p>Ages: 12-64</p>
                    </div>
            
                    <div class="bottom">
                        <p>${{ $visit_adults->price }}</p>
                    </div> 
                </div>
            </div>

            <div class="col-sm-6">
                <div class="cards">
                    <div class="top">
                        <h3>CHILDREN</h3>
                        <p>Ages: 0-11 </p>
                    </div>
            
                    <div class="bottom">
                        <p>${{ $visit_children->price }}</p>
                    </div> 
                </div>
            </div> 
        </div>

        <div class="slide-bottom">
            @if (!is_null($accounts))
                <a href="{{ route('user_visit_booking_form',['confirmation_code'=>$accounts->confirmation_code,'id_old_booking_adults'=>0,'id_old_booking_children'=>0]) }}"><button type="button">Buy Ticket</button></a>
                @else
                    <a href="{{ route('login-page') }}"><button type="button">Buy Ticket</button></a>
            @endif
        </div>
    </div>
@endsection