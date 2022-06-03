@extends('layouts.masterLayout')

@section('header','Nexus Aquarium')

@section('css-body')
    {{ asset('css/user/animaldetail.css') }}
@stop


@section('content')
    <!-- phần 2: IMG-->
    <div class="content-img container-fluid mt-2">
        <div class="left-img">
            <div class="text-align container">
                @if (!is_null($accounts))
                    <a href="{{ route('user_animal_list',['confirmation_code'=>$accounts->confirmation_code]) }}" >
                @endif
                @if (is_null($accounts))
                    <a href="{{ route('user_animal_list',['confirmation_code'=>"guest"]) }}" >
                @endif
                    <button type="submit" class="btn btn-link">
                        <i class="far fa-caret-square-left"></i>
                    </button> 
                    <span style="color:rgb(0, 102, 255) !important; text-transform: uppercase;">Animals</span> 
                </a> 
                <p>{{ $animal->normal_name }}</p> 
                <span>{{ $category->name }}</span>
            </div>
        
        </div>

        <div class="right-img">
            <!-- chèn ảnh con vật vào img: LongThumbnail -->
            <img src="{{ asset('storage/images/animal/longThumbnail/'.$animal->longThumbnail) }}" alt="">
        </div>
    </div>

    <!-- Phần 3: Text -->
    <div style="margin-left:0px;width:96%;margin-top:20px;">

        @if (!is_null($accounts))
            {{ Breadcrumbs::render('animal_detail',$accounts->confirmation_code,$animal->hrefParam) }}        
        @endif
        @if (is_null($accounts))
            {{ Breadcrumbs::render('animal_detail',"guest",$animal->hrefParam) }}        
        @endif

    </div>

    <div class="content-body container">

        <div class="left-body">
            <h2>Overview</h2>
            <!-- Nội dung con vật-Overview -->
            <p>{{ $animal->overview }}</p>
        </div>

        <div class="right-body">
            <div class="animal-icon">
                <i class="fab fa-envira"></i>
                <p>Animal type</p>
            </div>
            <ul>
                <li>{{ $category->name }}</li>
            </ul>
            <div class="animal-icon">
                <i class="fas fa-map-marker-alt"></i>
                <p>Range</p>
            </div>
            <ul>
                <li>{{ $range->name }}</li>
            </ul>
        </div>

    </div>

    <!-- Phần 4: Img & JS text -->
    <div class="slide-body container">
        <img src="CSS/img/booter-img 2.jpg" class="rounded-thumbnail" alt="">
    </div>

    <div class="content-end container">
        <h2>Quick Facts</h2>
        <span>Learn more about {{ $animal->normal_name }}!</span>

        <div class="content-box">
            <button type="button" id="box1" class="btn">
                <i class="fas fa-angle-double-down"></i>
            </button> 
            <span>Habitat</span>
            <p id="pbox1" style="display: none;">{{ $animal->habitat }}</p>
        </div>

        <div class="content-box">
            <button type="button" id="box2" class="btn">
                <i class="fas fa-angle-double-down"></i>
            </button> 
            <span>Diet</span>
            <p id="pbox2" style="display: none;">{{ $animal->diet }}</p>
        </div>

        <div class="content-box">
            <button type="button" id="box3" class="btn">
                <i class="fas fa-angle-double-down"></i>
            </button> 
            <span>Size</span>
            <p id="pbox3" style="display: none;">{{ $animal->size }}</p>
        </div>

        <div class="content-box">
            <button type="button" id="box4" class="btn">
                <i class="fas fa-angle-double-down"></i>          
            </button>
            <span>Population Status</span>
            <p id="pbox4" style="display: none;">{{ $animal->population_status }}</p>
        </div>
    </div>
    <br>
    
    <p class="related-animal-header">Related Animals</p>
    <div class="related-animal">
        @foreach ($related_animals as $related_animal)
            <div class="animal1">
                @if (!is_null($accounts))
                    <a href="{{ route('user_animal_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$related_animal->hrefParam]) }}">
                        <img src="{{ asset('storage/images/animal/shortThumbnail/'.$related_animal->shortThumbnail) }}" alt="" width="210" height="140">
                        <p>{{ $related_animal->normal_name }}</p>
                    </a>
                @endif
                @if (is_null($accounts))
                    <a href="{{ route('user_animal_detail',['confirmation_code'=>"guest",'hrefParam'=>$related_animal->hrefParam]) }}">
                        <img src="{{ asset('storage/images/animal/shortThumbnail/'.$related_animal->shortThumbnail) }}" alt="" width="210" height="140">
                        <p>{{ $related_animal->normal_name }}</p>
                    </a>
                @endif
            </div>
        @endforeach
    </div>
    <div class="comment">
        <p>Your comment:</p>
        <textarea class="form-control" rows="8" placeholder="Note...."></textarea>
        <button>Send</button>
    </div>
@stop