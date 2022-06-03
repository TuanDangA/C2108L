@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | EVENT DETAILS')

@section('css-body')
    {{ asset('css/user/eventdetail.css') }}
@stop

@section('content')
    <div class="content-img container-fluid ">
        <div class="left-img">
            <div class="text-align container">

                @if (isset($accounts))
                    <a href="{{ route('event-view',['confirmation_code'=>$accounts->confirmation_code]) }}" >
                @endif
                @if (!isset($accounts))
                    <a href="{{ route('event-view',['confirmation_code'=>"guest"]) }}" >                    
                @endif

                    <button type="submit" class="btn btn-link">
                        <i class="far fa-caret-square-left" style="color:rgb(0, 102, 255) "></i>
                    </button>
                    <span style="color:rgb(0, 102, 255) !important; text-transform: uppercase;">EVENTS</span> 
                </a>

                <p>{{ $events->title }}</p>
            </div>
        
        </div>

        <div class="right-img">
            <!-- chèn ảnh con vật vào img: LongThumbnail -->
            <img src="{{ asset('storage/images/events/'.$events->image) }}" alt="">
        </div>
    </div>

    <div style="margin-left:0px;width:96%;margin-top:20px;">
        @if (!is_null($accounts))
            {{ Breadcrumbs::render('event_detail',$accounts->confirmation_code,$events->href_param) }}        
        @endif
        @if (is_null($accounts))
            {{ Breadcrumbs::render('event_detail', "guest",$events->href_param) }}        
        @endif
    </div>

    <!-- Phần 3: Text -->
    <div class="content-body container">

        <div class="left-body">
            <h2>Overview</h2>
            <!-- Nội dung bài viết-Overview -->
            <p>{{ $events->content }}</p>
        </div>

        <div class="right-body">
            <div class="posts-icon">
                <i class="far fa-clock"></i>
                <p>Time</p>
            </div>
            <ul>
                <li>Begin at:</li>
                {{ $events->start_date }}
                <li>Finish at:</li>
                {{ $events->end_date }}
            </ul>
            <div class="posts-icon">
                <i class="fas fa-map-marker-alt"></i>
                <p>Location</p>
            </div>
            <ul>
                <li>{{ $events->location }}</li>
            </ul>
            <div class="posts-icon">
                <i class="fas fa-dollar-sign"></i>
                <p>Price</p>
            </div>
            <ul>
                <li>{{ $events->price }}</li>
            </ul>
            <div class="posts-icon">
                <i class="fas fa-ticket-alt"></i>
                @if (!is_null($accounts))
                    <a href="{{ route('user_event_booking_form',['confirmation_code'=>$accounts->confirmation_code,'id_old_booking_event'=>0,'href_param'=>$events->href_param]) }}">
                        <button type="button">
                            <span> Book now</span>
                        </button>
                    </a>
                @endif
                @if (is_null($accounts))
                    <a href="{{ route('login-page')}}">
                        <button type="button">
                            <span> Book now</span>
                        </button>
                    </a>
                @endif
                
            </div>

        </div>

    </div>

    <p class="related-event-header">Related Events</p>
    <div class="related-event">
        @foreach ($related_events as $related_event)
            <div class="event1">
                <a href=" @if(!is_null($accounts)){{ route('event-detail', array('confirmation_code'=>$accounts->confirmation_code, 'href_param'=>$related_event->href_param,'id'=>$related_event->id)) }} 
                          @else{{ route('event-detail', array('confirmation_code'=>'guest', 'href_param'=>$related_event->href_param,'id'=>$related_event->id)) }} @endif"
                >
                    <img src="{{ asset('storage/images/events/'.$related_event->image) }}" alt="" width="210" height="140">
                    <p>{{ $related_event->title }}</p>
                </a>
            </div>
        @endforeach
    </div>
    <div class="comment">
        <p>Your comment:</p>
        <textarea class="form-control" rows="8" placeholder="Note...."></textarea>
        <button>Send</button>
    </div>
@stop