@extends('layouts.masterLayout')

@section('header','Nexus Aquarium')

@section('css-body')
    {{ asset('css/user/postdetail.css') }}
@stop

@section('content')
    <!-- phần 2: IMG-->
    <div class="content-img container-fluid ">
        <div class="left-img">

            <div class="text-align container">

                @if (isset($accounts))
                    <a href="{{ route('user_post_list',['confirmation_code'=>$accounts->confirmation_code]) }}" >
                @endif
                @if (!isset($accounts))
                    <a href="{{ route('user_post_list',['confirmation_code'=>"guest"]) }}" >                    
                @endif

                    <button type="submit" class="btn btn-link">
                        <i class="far fa-caret-square-left" style="color:rgb(0, 102, 255) "></i>
                    </button>
                    <span style="color:rgb(0, 102, 255) !important; text-transform: uppercase;">NEWS</span> 
                </a>
                
                <p>{{ $post->title }}</p> 
            </div>
        
        </div>

        <div class="right-img">
            <img src="{{ asset('storage/images/post/longThumbnail/'.$post->longThumbnail) }}" alt="">
        </div>
    </div>

    <div style="margin-left:0px;width:96%;margin-top:20px;">
        @if (!is_null($accounts))
            {{ Breadcrumbs::render('post_detail',$accounts->confirmation_code,$post->hrefParam) }}        
        @endif
        @if (is_null($accounts))
            {{ Breadcrumbs::render('post_detail',"guest",$post->hrefParam) }}        
        @endif
    </div>

    <!-- Phần 3: Text -->
    <div class="content-body container">
        <div class="left-body">
            <h2>Overview</h2>
            <!-- Nội dung bài viết-Overview -->
            <p>{{ $post->content }}</p>
        </div>

        <div class="right-body">
            <div class="posts-icon">
                <i class="fab fa-autoprefixer"></i>
                <p>Author</p>
            </div>
            <ul>
                <li>{{ $post->author_name }}</li>
            </ul>
            <div class="posts-icon">
                <i class="far fa-clock"></i>
                <p>Time</p>
            </div>
            <ul>
                <li>{{ $post->updated_at }}</li>
            </ul>
        </div>

    </div>

    <p class="related-news-header">Related News</p>
    <div class="related-news">
        @foreach ($related_posts as $related_post)
            <div class="news1">
                @if (!is_null($accounts))
                    <a href="{{ route('user_post_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$related_post->hrefParam]) }}">
                        <img src="{{ asset('storage/images/post/shortThumbnail/'.$related_post->shortThumbnail) }}" alt="" width="210" height="140">
                        <p>{{ $related_post->title }}</p>
                    </a>
                @endif
                @if (is_null($accounts))
                    <a href="{{ route('user_post_detail',['confirmation_code'=>"guest",'hrefParam'=>$related_post->hrefParam]) }}">
                        <img src="{{ asset('storage/images/post/shortThumbnail/'.$related_post->shortThumbnail) }}" alt="" width="210" height="140">
                        <p>{{ $related_post->title }}</p>
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