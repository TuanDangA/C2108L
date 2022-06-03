@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | EVENTS')

@section('css-body')
    {{ asset('css/user/eventlist.css') }}
@stop

@section('content')
    <div class="events container-fluid">
        <div class="events-header container-fluid" style="background-image: url('{{ asset('storage/images/rand_backgrounds/'.$backgroundname) }}')">
                <h2>EVENTS</h2>
                <p>Stay up to date on the latest Aquarium events—in our building, in the field with our community.</p>
                <span>Filter</span>
            <div class="events-search container">
                <form action="@if(isset($accounts)) {{ route('event-view-filter', $accounts->confirmation_code) }} @else {{ route('event-view-filter', 'guest') }}@endif" method="post"> 
                    @csrf
                    <div class="search-all">
                        <select name="category"> 
                            <option value="">FILTER BY CATEGORY</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category['name']}}" @if($category['name'] == $events[0]->name) selected @endif>
                                        {{ $category['name'] }}
                                    </option>
                                @endforeach
                        </select>
                    </div>
                    <div class="search-add">
                        <i class="fab fa-searchengin"></i>
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>  
        </div>

        <div style="margin-top:20px;">
            @if (isset($old_category))
                @if (!is_null($accounts))
                    {{ Breadcrumbs::render('event-view-filter', $accounts->confirmation_code) }}        
                @endif
                @if (is_null($accounts))
                    {{ Breadcrumbs::render('event-view-filter', "guest") }}        
                @endif
            @endif
            @if (!isset($old_category))
                @if (!is_null($accounts))
                    {{ Breadcrumbs::render('event_list', $accounts->confirmation_code) }}        
                @endif
                @if (is_null($accounts))
                    {{ Breadcrumbs::render('event_list', "guest") }}        
                @endif
            @endif
        </div>

        <div class="events-body container">
                <h2>Viewing ({{ $count }})</h2>
        </div>

        <div class="events-photo container" >
            <div class="row container-fluid">
                @foreach ($events as $event)
                    <div class="col">
                        <a 
                            @if(!is_null($accounts))href="{{ route('event-detail', array('confirmation_code'=>$accounts->confirmation_code, 'href_param'=>$event->href_param)) }}"
                            @else href="{{ route('event-detail', array('confirmation_code'=>"guest", 'href_param'=>$event->href_param)) }}" 
                            @endif
                        >
                            <img src="{{ asset('storage/images/events/'.$event->image) }}" style="width:300px;height:200px;">
                            <p>{{ $event->title }}</p>
                            <p>View More</p>
                        </a>
                    </div>                              
                @endforeach
            </div>
        </div>
    </div>
@stop

