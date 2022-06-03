@extends('layouts.masterLayout')

@section('header','Send Feedback')

@section('css-body')
    {{ asset('css/user/feedback.css') }}
@stop


@section('content')
    <div class="content-body container">
        <br>

        @if (!is_null($accounts))
            {{ Breadcrumbs::render('feedback', $accounts->confirmation_code) }}        
        @endif
        @if (is_null($accounts))
            {{ Breadcrumbs::render('feedback', "guest") }}        
        @endif

        <h2>Give us feedback</h2>
        <p>Thank you for your interest in us.Please send us your feedback about Nexus Aquarium!</p>
        <form method="post" action="{{ route('user_feedback_post',['confirmation_code'=>$accounts->confirmation_code]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="contact">
                <h2>Contact Information</h2>
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
                    <input required  type="number" value="{{ $accounts->phone }}" class=" form-control" placeholder="Enter your phone number..." readonly>
                    <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                    <input type="hidden" name="action" value="add">
                </div>
            </div><br>

            <div class="request">
                <h2>Feedback</h2>
                <div class="form-group">
                    <label for="">About:</label>
                    <select name="id_feedback_category">
                        <option value="">--Select--</option>
                        @foreach ($categoriesList as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="">Content:</label>
                    <textarea class="form-control" rows="5" id="comment" name="content"></textarea>
                </div>
            </div><br>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Submit</button>
                <button class="btn btn-dark" type="reset">Reset</button>
            </div><br>
        </form>  
    </div>
@endsection