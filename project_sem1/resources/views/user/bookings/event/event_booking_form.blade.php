@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | Booking-Form')

@section('css-body')
    {{ asset('css/user/booking/booking_form.css') }}
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
            @if (!is_null($old_booking_event))
                {{ Breadcrumbs::render('user_event_booking_form',$accounts->confirmation_code,$event->href_param,$old_booking_event->id) }}        
            @endif
            @if (is_null($old_booking_event))
            {{ Breadcrumbs::render('user_event_booking_form',$accounts->confirmation_code,$event->href_param,0) }}        
            @endif
        @endif
        @if (is_null($accounts))
            @if (!is_null($old_booking_event))
            {{ Breadcrumbs::render('user_event_booking_form',"guest",$event->href_param,$old_booking_event->id) }}        
            @endif
            @if (is_null($old_booking_event))
            {{ Breadcrumbs::render('user_event_booking_form',"guest",$event->href_param,0) }}        
            @endif  
        @endif
    </div>

    <!-- Phần 3: Text -->
    <div class="content-body container">
        <h2>Get ticket Event</h2>
        <p>Thanks for your interest in hosting a special event at the Aquarium. Please fill out the form below and we’ll get back to you shortly</p>
        <form method="post" action="{{ route('user_event_booking_confirm',['confirmation_code'=>$accounts->confirmation_code,'href_param'=>$event->href_param]) }}">    
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="contact">
                <h2>Contact Information</h2>
                <input type="hidden" name="id_old_booking_event"
                    @if (!is_null($old_booking_event)) value="{{ $old_booking_event->id }}" @endif
                    @if (is_null($old_booking_event)) value="0" @endif
                >
                <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input required type="text" value="{{ $accounts->fullname }}" class=" form-control" placeholder="Enter your name..." readonly>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input required  type="email" value="{{ $accounts->email }}" class=" form-control" placeholder="Enter your email..." readonly>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input required  type="number" value="{{ $accounts->phone }}" class="form-control" placeholder="Enter your phone number..." readonly>
                </div>
            </div>

            <div class="request">
                <h2>Request</h2>
                <input type="hidden" name="id_event" value="{{ $event->id }}">
                <div class="form-group">
                    <label for="">Event Name:</label>
                    <input type="text" class=" form-control" value="{{ $event->title }}" readonly >
                </div>
                <div class="form-group">
                    <label for="">Start-time:</label>
                    <input type="datetime" id="" class=" form-control" value="{{ $event->start_date }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">End-time:</label>
                    <input type="datetime" id="" class=" form-control" value="{{ $event->end_date }}" readonly>
                </div>
                <div class="form-group">
                    <label for="price_per_person">Price per person($):</label>
                    <input type="text" id="price_per_person" class=" form-control" value="{{ $event->price }}" readonly>
                </div>

                <h2>Pick your tickets:</h2>
                <div class="row">
                    <label for="quantity" class="col-6 ">Quantity:</label>
                    <input type="number" class=" form-control col-3" name="quantity" required onchange="showTotalPrice(this.value)" id="quantity" placeholder="0"
                        @if (!is_null($old_booking_event)) value="{{ $old_booking_event->quantity }}" @endif
                    >
                </div>
                <div class="row">
                    <label for="comment" class="col-6">Details:</label>
                    <textarea class="form-control col-3" name="details" rows="4" id="comment" placeholder="Note....">@if(!is_null($old_booking_event)) {{ $old_booking_event->details }} @endif</textarea>
                </div>
                <div class="row">
                    <label class="col-6" for="total_price">Total-Price($):</label>
                    <input type="text" class="col-3" name="price" id="total_price" 
                        @if(!is_null($old_booking_event)) value="{{ $old_booking_event->price }}" @endif
                    readonly>
                </div> 
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Continue</button>
                <button class="btn btn-dark" type="reset">Reset</button>
            </div>
        </form>      
    </div>
@endsection

@section('js')
    <script>
        function showTotalPrice(val) {
            var price_per_person = document.getElementById('price_per_person').value;
            var total_price = val * price_per_person;
            var divobj = document.getElementById('total_price');
            divobj.value = total_price;
        }
    </script>
@endsection

 