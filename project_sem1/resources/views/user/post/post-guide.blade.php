@extends('layouts.masterLayout')

@section('header','Nexus Aquarium')

@section('css-body')
    {{ asset('css/user/postlist.css') }}
@stop

@section('content')
    <div class="posts container-fluid">

        {{-- <div class="posts-header container-fluid" style="background-image: url('{{ asset('storage/images/user_animal/booter_img_7.jpeg') }}')"> --}}
        <div class="posts-header container-fluid" style="background-image: url('{{ asset('storage/images/rand_backgrounds/'.$backgroundname) }}')">
            <h2>NEWS</h2>
            <p>Discover the wonder of the aquatic animal world with our fantastic news.</p>
            <span>Filter</span>
            <div class="post-search container">
                @if (!is_null($accounts))
                    <form method="post" action="{{ route('user_post_search',['confirmation_code'=>$accounts->confirmation_code]) }}">
                @endif
                @if (is_null($accounts))
                    <form method="post" action="{{ route('user_post_search',['confirmation_code'=>"guest"]) }}">
                @endif      
                   
                {{ csrf_field() }}
                <div class="search-all">
                        <select name="id_category_post"> 
                            <option value="">FILTER BY CATEGORY</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($old_id_category_post == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-add">
                        <i class="fab fa-searchengin"></i>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div> 
        </div>  

        <div style="margin-top:20px;">
            @if (!is_null($accounts))
                {{ Breadcrumbs::render('post_guide', $accounts->confirmation_code) }}        
            @endif
            @if (is_null($accounts))
                {{ Breadcrumbs::render('post_guide', "guest") }}        
            @endif
        </div>

        <div>
            <h2>Viewing ({{ $count }})</h2>
        </div>

        <div class="posts-photo container" >
            @foreach($PostList as $post)

                <div class="list">
                    @if (!is_null($accounts))
                        <a href="{{ route('user_post_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$post->hrefParam]) }}"><img src="{{ asset('storage/images/post/shortThumbnail/'.$post->shortThumbnail) }}" alt=""></a>
                        <a href="{{ route('user_post_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$post->hrefParam]) }}">
                    @endif
                    @if (is_null($accounts))
                        <a href="{{ route('user_post_detail',['confirmation_code'=>"guest",'hrefParam'=>$post->hrefParam]) }}"><img src="{{ asset('storage/images/post/shortThumbnail/'.$post->shortThumbnail) }}" alt=""></a>
                        <a href="{{ route('user_post_detail',['confirmation_code'=>"guest",'hrefParam'=>$post->hrefParam]) }}">
                    @endif
                        <span id="title">{{ $post->title }}</span>
                        @if(!is_null($post->description))
                            <span id="description">{{ $post->description }}</span><br>
                        @endif
                        <div class="related-info">
                            <span id="updated_at"><i class="fas fa-clock"></i> {{ $post->updated_at }}</span>
                            <span id="category"><i class="fas fa-tag"></i> {{ $post->category_name }}</span>
                        </div>
                    </a>
                </div>

            @endforeach
        </div>

        <center>{!! $PostList->links() !!}</center>
    </div>
@stop