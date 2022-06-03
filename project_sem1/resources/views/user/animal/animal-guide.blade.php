@extends('layouts.masterLayout')

@section('header','Nexus Aquarium')

@section('css-body')
    {{ asset('css/user/animallist.css') }}
@stop

@section('content')
    <div class="animal container-fluid">

        <div class="animal-header container-fluid" style="background-image: url('{{ asset('storage/images/rand_backgrounds/'.$backgroundname) }}')">
            <h2>ANIMAL GUIDE</h2>
            <p>Whether they’re finned or scaled, deep-sea swimmers or treetop dwellers, each one of the thousands of animals at Nexus Aquarium has a unique story to tell.</p>
            <span>Filter</span>

            <div class="animal-search container">
                @if (!is_null($accounts))
                    <form method="post" action="{{ route('user_animal_search',['confirmation_code'=>$accounts->confirmation_code]) }}">
                @endif
                @if (is_null($accounts))
                    <form method="post" action="{{ route('user_animal_search',['confirmation_code'=>"guest"]) }}">
                @endif
                    {{ csrf_field() }}
                    <div class="search-all">
                        <select name="id_category"> 
                            <option value="">--Filter By Category--</option>
                            @foreach ($categoriesList as $category)
                                <option value="{{ $category->id }}" @selected($old_id_category == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-all">
                        <select name="id_range">
                            <option value="">--Filter By Range--</option>
                            @foreach ($rangesList as $range)
                                <option value="{{ $range->id }}" @selected($old_id_range == $range->id)>{{ $range->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-add">
                        <i class="fab fa-searchengin"></i>
                        <button type="submit" class="btn btn-light">Filter/Show All</button>
                    </div>
                </form>
            </div>  

        </div>

        <div style="margin-top:20px">
            @if (is_null($old_id_range) && is_null($old_id_category))
                @if (!is_null($accounts))
                    {{ Breadcrumbs::render('animal_guide', $accounts->confirmation_code) }}        
                @endif
                @if (is_null($accounts))
                    {{ Breadcrumbs::render('animal_guide', "guest") }}        
                @endif
            @endif
        
            @if (!is_null($old_id_range) || !is_null($old_id_category))
                @if (!is_null($accounts))
                    {{ Breadcrumbs::render('user_animal_search', $accounts->confirmation_code) }}        
                @endif
                @if (is_null($accounts))
                    {{ Breadcrumbs::render('user_animal_search', "guest") }}        
                @endif
            @endif
        </div>

        <div class="animal-body container" style="justify-content: left">
            <h2>Viewing ({{ $count }})</h2>
        </div>

        <div class="animal-photo container" >
            @if ($count > 0)
                <div class="row container-fluid">
                    @foreach($AnimalList as $animal)
                        <div class="col">
                            @if (!is_null($accounts))
                                <center><a href="{{ route('user_animal_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$animal->hrefParam]) }}"><img src="{{ asset('storage/images/animal/shortThumbnail/'.$animal->shortThumbnail) }}" alt="" width="300" height="200"></a></center>
                                <center><a href="{{ route('user_animal_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$animal->hrefParam]) }}"><p>{{ $animal->normal_name }}</p></a></center>
                                <center><a href="{{ route('user_animal_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$animal->hrefParam]) }}">View More</a></center>
                            @endif
                            @if (is_null($accounts))
                                <center><a href="{{ route('user_animal_detail',['confirmation_code'=>"guest",'hrefParam'=>$animal->hrefParam]) }}"><img src="{{ asset('storage/images/animal/shortThumbnail/'.$animal->shortThumbnail) }}" alt="" width="300" height="200"></a></center>
                                <center><a href="{{ route('user_animal_detail',['confirmation_code'=>"guest",'hrefParam'=>$animal->hrefParam]) }}"><p>{{ $animal->normal_name }}</p></a></center>
                                <center><a href="{{ route('user_animal_detail',['confirmation_code'=>"guest",'hrefParam'=>$animal->hrefParam]) }}">View More</a></center>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
            @if ($count == 0)
                <div class="emptyresult">
                    Sorry there is nothing that matches your search!
                </div>
            @endif
        </div><br><br>
    </div>
@stop







