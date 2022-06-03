@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | Booking-Delete')

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
        @if (!is_null($old_booking_adults) && !is_null($old_booking_children))
            {{ Breadcrumbs::render('user_visit_booking_delete',$accounts->confirmation_code,$old_booking_adults->id,$old_booking_children->id) }}        
        @endif
        @if (is_null($old_booking_adults) && !is_null($old_booking_children))
            {{ Breadcrumbs::render('user_visit_booking_delete',$accounts->confirmation_code,0,$old_booking_children->id) }}        
        @endif
        @if (!is_null($old_booking_adults) && is_null($old_booking_children))
            {{ Breadcrumbs::render('user_visit_booking_delete',$accounts->confirmation_code,$old_booking_adults->id,0) }}        
        @endif
        @if (is_null($old_booking_adults) && is_null($old_booking_children))
            {{ Breadcrumbs::render('user_visit_booking_delete',$accounts->confirmation_code,0,0) }}        
        @endif
    @endif
    @if (is_null($accounts))
        @if (!is_null($old_booking_adults) && !is_null($old_booking_children))
            {{ Breadcrumbs::render('user_visit_booking_delete',"guest",$old_booking_adults->id,$old_booking_children->id) }}        
        @endif
        @if (is_null($old_booking_adults) && !is_null($old_booking_children))
            {{ Breadcrumbs::render('user_visit_booking_delete',"guest",0,$old_booking_children->id) }}        
        @endif
        @if (!is_null($old_booking_adults) && is_null($old_booking_children))
            {{ Breadcrumbs::render('user_visit_booking_delete',"guest",$old_booking_adults->id,0) }}        
        @endif
        @if (is_null($old_booking_adults) && is_null($old_booking_children))
            {{ Breadcrumbs::render('user_visit_booking_delete',"guest",0,0) }}        
        @endif  
    @endif
</div>

<!-- Phần 3: Text -->
<div class="content-body container">
    <h2>Delete Booking</h2>
    <p>Are you sure you want to delete this booking? the action is unrecoverable</p>
    <form method="post" action="{{ route('user_visit_booking_submit',['confirmation_code'=>$accounts->confirmation_code]) }}">    
        @csrf
        <div class="contact">
            <h2>Contact Information</h2>
            <input type="hidden" name="id_user" value="{{ $accounts->id }}">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user">Full Name</i></span>
                <input required type="text" value="{{ $accounts->fullname }}" class=" form-control" placeholder="Enter your name..." readonly>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope">Email</i></span>
                <input required  type="email" value="{{ $accounts->email }}" class=" form-control" placeholder="Enter your email..." readonly>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-phone">Phone Number</i></span>
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
                <input type="date" name="arrival_date" readonly
                    @if(!is_null($old_booking_adults)) value="{{ $old_booking_adults->arrival_date }}"@endif 
                    @if(!is_null($old_booking_children)) value="{{ $old_booking_children->arrival_date }}"@endif 
                class=" form-control" required>
            </div>
            <div class="form-group">
                <label for="">Details:</label>
                <input class="form-control" id="details" name="details" placeholder="Note...." readonly
                    @if(!is_null($old_booking_adults) && is_null($old_booking_children)) value="{{ $old_booking_adults->details }}" @endif 
                    @if(!is_null($old_booking_children) && is_null($old_booking_adults)) value="{{ $old_booking_children->details }}" @endif 
                    @if(!is_null($old_booking_children) && !is_null($old_booking_adults)) value="{{ $old_booking_children->details }}" @endif
                >
            </div>

            <h2>Pick your tickets:</h2>
            <div class="row">
                <label class="col-6">{{ $visit_adults->title }}($):</label>
                <input type="text" class="col-3" value="{{ $visit_adults->price }}" id="price_adults" readonly>
                <label for="quantity_adults" class="col-2 ">Number of Customer:</label>
                <input type="number" class=" form-control col-2" name="quantity_adults" id="quantity_adults" @if(!is_null($old_booking_adults)) value="{{ $old_booking_adults->quantity }}"@endif @if (is_null($old_booking_adults)) value="0" @endif  onchange="showTotalPrice()" required readonly>
            </div>
             <div class="row">
                <label class="col-6">{{ $visit_children->title }}($):</label>
                <input type="text" class="col-3" value="{{ $visit_children->price }}" id="price_children" readonly>
                <label for="quantity_children" class="col-2 ">Number of Customer:</label>
                <input type="number" class="form-control col-2" name="quantity_children" id="quantity_children" @if(!is_null($old_booking_children)) value="{{ $old_booking_children->quantity }}"@endif @if (is_null($old_booking_children)) value="0" @endif onchange="showTotalPrice()" required readonly>
            </div>  
            <div class="row">
                <label class="col-6">Total-Price($):</label>
                <input type="text" class="col-3" name="total_price" id="total_price" 
                    @if(!is_null($old_booking_adults) && !is_null($old_booking_children)) value="{{ $old_booking_adults->price + $old_booking_children->price }}"@endif 
                    @if(!is_null($old_booking_adults) && is_null($old_booking_children)) value="{{ $old_booking_adults->price }}"@endif 
                    @if(is_null($old_booking_adults) && !is_null($old_booking_children)) value="{{ $old_booking_children->price }}"@endif 
                readonly>
                <input type="hidden" name="id_old_booking_adults" 
                    @if(!is_null($old_booking_adults)) value="{{ $old_booking_adults->id }}" @endif
                    @if(is_null($old_booking_adults)) value="0" @endif
                >
                <input type="hidden" name="id_old_booking_children" 
                    @if(!is_null($old_booking_children)) value="{{ $old_booking_children->id }}" @endif
                    @if(is_null($old_booking_children)) value="0" @endif
                >
                <input type="hidden" name="action" value="delete">
                <input type="hidden" class="col-3" name="total_price_children" id="total_price_children" @if(!is_null($old_booking_children)) value="{{ $old_booking_children->price }}"@endif readonly>
                <input type="hidden" class="col-3" name="total_price_adults" id="total_price_adults" @if(!is_null($old_booking_adults)) value="{{ $old_booking_adults->price }}"@endif readonly>
            </div> 
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Delete</button>
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