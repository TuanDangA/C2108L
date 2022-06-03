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
        {{ Breadcrumbs::render('user_visit_booking_edit',$accounts->confirmation_code) }}        
    @endif
    @if (is_null($accounts))
        {{ Breadcrumbs::render('user_visit_booking_edit', "guest") }}        
    @endif
</div>

<!-- Phần 3: Text -->
<div class="content-body container">
    <h2>Get ticket visit aquarium</h2>
    <p>Thanks for your interest in us. Please fill out the form below and we’ll get back to you shortly</p>
    <form method="post" action="{{ route('user_visit_booking_confirm',['confirmation_code'=>$accounts->confirmation_code]) }}">    
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
            <div class="form-group">
                <label for="">Event Name:</label>
                <input type="text" class=" form-control" value="Visit Nexus Aquarium" readonly >
            </div>
            <div class="form-group">
                <label for="">Open-time:</label>
                <input type="datetime" name="" id="" class=" form-control" value="9 AM" readonly>
            </div>
            <div class="form-group">
                <label for="">Close-time:</label>
                <input type="datetime" name="" id="" class=" form-control" value="5 PM" readonly>
            </div>
            <div class="form-group">
                <label for="">Arrival-date:</label>
                <input type="date" name="arrival_date" value="{{ $request->arrival_date }}" class=" form-control" required>
            </div>
            <div class="form-group">
                <label for="details">Details:</label>
                <input class="form-control" id="details" name="details" placeholder="Note...." value="{{ $request->details }}">
            </div>

            <h2>Pick your tickets:</h2>
            <div class="row">
                <label class="col-6">{{ $visit_adults->title }}($):</label>
                <input type="text" class="col-3" value="{{ $visit_adults->price }}" id="price_adults" readonly>
                <label for="quantity_adults" class="col-2 ">Number of Customer:</label>
                <input type="number" class=" form-control col-2" name="quantity_adults" id="quantity_adults" value="{{ $request->quantity_adults }}" onchange="showTotalPrice()" required>
            </div>
             <div class="row">
                <label class="col-6">{{ $visit_children->title }}($):</label>
                <input type="text" class="col-3" value="{{ $visit_children->price }}" id="price_children" readonly>
                <label for="quantity_children" class="col-2 ">Number of Customer:</label>
                <input type="number" class="form-control col-2" name="quantity_children" id="quantity_children" value="{{ $request->quantity_children }}" onchange="showTotalPrice()" required>
            </div>  
            <div class="row">
                <label class="col-6">Total-Price($):</label>
                <input type="text" class="col-3" name="total_price" id="total_price" 
                    value="{{ $request->total_price }}"
                readonly>
                <input type="hidden" name="id_old_booking_adults" 
                    @if(isset($request->id_old_booking_adults)) value="{{ $request->id_old_booking_adults}}" @else value="0" @endif
                >
                <input type="hidden" name="id_old_booking_children" 
                    @if(isset($request->id_old_booking_children)) value="{{ $request->id_old_booking_children }}" @else value="0" @endif
                >
                <input type="hidden" class="col-3" name="total_price_children" id="total_price_children" 
                    value="{{ $request->total_price_children }}"
                >
                <input type="hidden" class="col-3" name="total_price_adults" id="total_price_adults" 
                    value="{{ $request->total_price_adults }}"
                >
            </div> 
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Continue</button>
        </div>
    </form>  
</div>
@endsection

@section('js')
    <script>
        function showTotalPrice() {
            var  price_adults = document.getElementById('price_adults').value;
            var  price_children = document.getElementById('price_children').value;
            var  quantity_adults = document.getElementById('quantity_adults').value;
            var  quantity_children = document.getElementById('quantity_children').value;
            var total_quantity = quantity_adults + quantity_children;
            var total_price_children = price_children * quantity_children;
            var total_price_adults = price_adults * quantity_adults;
            var total_price = total_price_children + total_price_adults;
            document.getElementById('total_price_children').value = total_price_children;
            document.getElementById('total_price_adults').value = total_price_adults;
            document.getElementById('total_price').value = total_price;
        }
    </script>
@endsection