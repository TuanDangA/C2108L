@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | HOME')

@section('css-body')
    {{ asset('css/user/home.css') }}
@stop


@section('content')
<div class="container">
    <div class="body container">
        <div class="preview" style="background-image: url('{{ asset('storage/images/rand_backgrounds/'.$backgroundname) }}')">
            <div class="darken-bg"></div>
            <div class="preview-body container">
                <div class="preview-title"><h1>Explore With Wonder, Connect With Real</h1></div>
                <div class="preview-content"><h6>In a world where we move from screen to screen, Nexus Aquarium invites you to move from ocean to ocean. Get ready to discover real experiences, hands-on exhibits, and real wonders like nowhere else on earth.</h6></div>
            </div>
        </div>

        <div style="margin-left:0px;width:96%;margin-top:20px;">
            @if (!is_null($accounts))
                {{ Breadcrumbs::render('home', $accounts->confirmation_code) }}        
            @endif
            @if (is_null($accounts))
                {{ Breadcrumbs::render('home', "guest") }}        
            @endif
        </div>
        <div class="animal-preview container">
            <div class="animal-video">
                <div class="vidSlides fadein">
                    <video autoplay loop muted>
                        <source src="{{ asset('storage/videos/home/video1.mp4') }}" type="video/mp4">
                    </video>
                </div>
                <div class="vidSlides fadein">
                    <video autoplay loop muted>
                        <source src="{{ asset('storage/videos/home/video2.mp4') }}" type="video/mp4">
                    </video>
                </div>
                <div class="vidSlides fadein">
                    <video autoplay loop muted>
                        <source src="{{ asset('storage/videos/home/video3.mp4') }}" type="video/mp4">
                    </video>
                </div>
                <div class="vidSlides fadein">
                    <video autoplay loop muted>
                        <source src="{{ asset('storage/videos/home/video4.mp4') }}" type="video/mp4">
                    </video>
                </div>
                <div class="animal-pic">
                    <div class="picSlides fadein">
                        <img draggable="false" src="{{ asset('storage/images/home/animal1.jpeg') }}" style="width: 100%;">
                    </div>
                    <div class="picSlides fadein">
                        <img draggable="false" src="{{ asset('storage/images/home/animal2.jpeg') }}" style="width: 100%;">
                    </div>
                    <div class="picSlides fadein">
                        <img draggable="false" src="{{ asset('storage/images/home/animal3.jpeg') }}" style="width: 100%;">
                    </div>
                    <div class="picSlides fadein">
                        <img draggable="false" src="{{ asset('storage/images/home/animal4.jpeg') }}" style="width: 100%;">
                    </div>
                </div>
            </div>
            <div class="animal-info">
                <div class="animal-encounter">
                    <div class="infSlides fadein">
                        <h6>ENCOUNTERS</h6>
                        <h2>Try Our Immersive Shark & Ray Interaction</h2>
                        <p>Turn your fear into fascination. Suit up and get in the water with some of our sharks and rays in this animal interaction in our Sharks! Predators of the Deep gallery.</p>
                    </div>
                    <div class="infSlides fadein">
                        <h6>ENCOUNTERS</h6>
                        <h2>Get Up Close With a Sea Lion</h2>
                        <p>Our unique Sea Lion Encounter takes you go behind the scenes to interact with these charismatic animals. Over the course of approximately 30 minutes, you’ll enjoy an exclusive tour of the California sea lion facility and a special educational presentation on the sea lions, then participate in an exciting sea lion training session alongside Georgia Aquarium’s own animal trainers.</p>
                    </div>
                    <div class="infSlides fadein">
                        <h6>ENCOUNTERS</h6>
                        <h2>Suit Up & Go For a Swim With Whale Sharks</h2>
                        <p>Journey with Gentle Giants swim encounter is the only opportunity in the world where you are guaranteed to swim with whale sharks, manta rays, and more. You’ll get to swim with a snorkel in the Ocean Voyager exhibit, with thousands of amazing animals for the experience of a lifetime.</p>
                    </div>
                    <div class="infSlides fadein">
                        <h6>ENCOUNTERS</h6>
                        <h2>Get Ready to Cage Dive With Fearsome Sharks</h2>
                        <p>This new animal interaction lets you submerge yourself in a shark enthusiast’s dream and venture into the deep with some of our predators of the deep. Take a ride through our new gallery and come face to face with a number of shark species, including the incredible great hammerhead and sand tiger sharks.</p>
                    </div>
                </div>
                <div class="animal-list-pic">
                    <img draggable="false" src="{{ asset('storage/images/home/animal1.jpeg') }}" onclick="currentSlide(1)">
                    <img draggable="false" src="{{ asset('storage/images/home/animal2.jpeg') }}" onclick="currentSlide(2)">
                    <img draggable="false" src="{{ asset('storage/images/home/animal3.jpeg') }}" onclick="currentSlide(3)">
                    <img draggable="false" src="{{ asset('storage/images/home/animal4.jpeg') }}" onclick="currentSlide(4)">
                </div>
            </div>
        </div>
        <div class="news">
            <div class="container">
                @foreach($PostList as $post)
                    <ul class="newsSlides fadein">
                        <li class="txt-content">
                            @if (!is_null($accounts))
                                <a href="{{ route('user_post_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$post->hrefParam]) }}" style="text-decoration: none;color:black;"><h2>{{ $post->title }}</h2></a><br>
                                <a href="{{ route('user_post_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$post->hrefParam]) }}" style="text-decoration: none;color:black;"><h6>{{ $post->author_name }}</h6></a>
                            @endif
                            @if (is_null($accounts))
                                <a href="{{ route('user_post_detail',['confirmation_code'=>"guest",'hrefParam'=>$post->hrefParam]) }}" style="text-decoration: none;color:black;"><h2>{{ $post->title }}</h2></a><br>
                                <a href="{{ route('user_post_detail',['confirmation_code'=>"guest",'hrefParam'=>$post->hrefParam]) }}" style="text-decoration: none;color:black;"><h6>{{ $post->author_name }}</h6></a>
                            @endif
                        </li>
                        <li class="img-content">
                            @if (!is_null($accounts))
                                <a href="{{ route('user_post_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$post->hrefParam]) }}" style="text-decoration: none;"><img draggable="false" src="{{ asset('storage/images/post/shortThumbnail/'.$post->shortThumbnail) }}"></a>
                                <button class="btn-link"><a href="{{ route('user_post_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$post->hrefParam]) }}" style="text-decoration: none;">Read more</a></button>
                            @endif
                            @if (is_null($accounts))
                                <a href="{{ route('user_post_detail',['confirmation_code'=>"guest",'hrefParam'=>$post->hrefParam]) }}" style="text-decoration: none;"><img draggable="false" src="{{ asset('storage/images/post/shortThumbnail/'.$post->shortThumbnail) }}"></a>
                                <button class="btn-link"><a href="{{ route('user_post_detail',['confirmation_code'=>"guest",'hrefParam'=>$post->hrefParam]) }}" style="text-decoration: none;">Read more</a></button>
                            @endif
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
        <div class="event">
            <div class="container">
                @foreach ($EventList as $event)
                    <ul class="eventSlides fadein">
                        <li class="txt-content">
                            @if (!is_null($accounts))
                                <a href="{{ route('event-detail', array('confirmation_code'=>$accounts->confirmation_code, 'href_param'=>$event->href_param)) }}" style="text-decoration: none;color:black;"><h2>{{ $event->title }}</h2><br></a>
                                <a href="{{ route('event-detail', array('confirmation_code'=>$accounts->confirmation_code, 'href_param'=>$event->href_param)) }}" style="text-decoration: none;color:black;"><h6>Category: {{ $event->category_name }}</h6></a>
                            @endif
                            @if (is_null($accounts))
                                <a href="{{ route('event-detail', array('confirmation_code'=>"guest", 'href_param'=>$event->href_param)) }}" style="text-decoration: none;color:black;"><h2>{{ $event->title }}</h2><br></a>
                                <a href="{{ route('event-detail', array('confirmation_code'=>"guest", 'href_param'=>$event->href_param)) }}" style="text-decoration: none;color:black;"><h6>Category: {{ $event->category_name }}</h6></a>
                            @endif
                        </li>
                        <li class="img-content">
                            @if (!is_null($accounts))
                                <a href="{{ route('event-detail', array('confirmation_code'=>$accounts->confirmation_code, 'href_param'=>$event->href_param)) }}" style="text-decoration: none;"><img draggable="false" src="{{ asset('storage/images/events/'.$event->image) }}"></a>
                                <button class="btn-link"><a href="{{ route('event-detail', array('confirmation_code'=>$accounts->confirmation_code, 'href_param'=>$event->href_param)) }}" style="text-decoration: none;">Read more</a></button>
                            @endif
                            @if (is_null($accounts))
                                <a href="{{ route('event-detail', array('confirmation_code'=>"guest", 'href_param'=>$event->href_param)) }}" style="text-decoration: none;"><img draggable="false" src="{{ asset('storage/images/events/'.$event->image) }}"></a>
                                <button class="btn-link"><a href="{{ route('event-detail', array('confirmation_code'=>"guest", 'href_param'=>$event->href_param)) }}" style="text-decoration: none;">Read more</a></button>
                            @endif
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop
