@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | SEARCH')

@section('css-body')
    {{ asset('css/user/search.css') }}
@stop

@section('content')
    <div class="body">

        <div class="container">

            @if (!is_null($accounts))
                {{ Breadcrumbs::render('search', $accounts->confirmation_code) }}        
            @endif
            @if (is_null($accounts))
                {{ Breadcrumbs::render('search', "guest") }}        
            @endif

            @if(count($animal_result) != 0)
                <div class="table-header">ANIMALS ({{ $animal_count }})</div>
                <div class="table1">
                    @foreach ($animal_result as $animal)
                        <table>
                            <tr>
                                <td rowspan="2">
                                    <img src="{{ asset('storage/images/animal/shortThumbnail/'.$animal->shortThumbnail) }}" alt="" width="300" height="300"><!--thay doi kich thuoc anh <=> thay doi trong file css '.body table tr:first-child td:first-child{ width: ; height: ;}'-->
                                </td>
                                <td class="table-title">
                                    <div>
                                        <span>Name: {{ $animal->normal_name }}</span>
                                    </div>
                                </td>
                                <td class="table-title">
                                    <div>
                                        <span>Scientific Name: {{ $animal->scientific_name }}</span>
                                    </div>
                                </td>
                                <td class="table-title">
                                    <div>
                                        <span>Range: {{ $animal->range }}</span>
                                    </div>
                                </td>
                                @if (isset($accounts))
                                    <td rowspan="2"><a href="{{ route('user_animal_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$animal->hrefParam]) }}"><button>Read More</button></a></td>
                                @endif
                                @if (!isset($accounts))
                                    <td rowspan="2"><a href="{{ route('user_animal_detail',['confirmation_code'=>"guest",'hrefParam'=>$animal->hrefParam]) }}"><button>Read More</button></a></td>
                                @endif
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div>
                                        <p>Overview<br>{{ $animal->overview }}</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @endforeach
                </div>
            @endif

            @if (count($post_result) != 0)
                <div class="table-header">NEWS ({{ $post_count }})</div>
                <div class="table2">
                    @foreach ($post_result as $post)
                        <table>
                            <tr>
                                <td rowspan="2">
                                    <img src="{{ asset('storage/images/post/shortThumbnail/'.$post->shortThumbnail) }}" alt="" width="300" height="300"><!--thay doi kich thuoc anh <=> thay doi trong file css '.body table tr:first-child td:first-child{ width: ; height: ;}'-->
                                </td>
                                <td class="table-title">
                                    <div>
                                        <span>Title: {{ $post->title }}</span>
                                    </div>
                                </td>
                                <td class="table-title">
                                    <div>
                                        <span>Category: {{ $post->category_name }}</span>
                                    </div>
                                </td>
                                <td class="table-title">
                                    <div>
                                        <span>Author: {{ $post->author_name }}</span>
                                    </div>
                                </td>
                                @if (!is_null($accounts))
                                    <td rowspan="2"><a href="{{ route('user_post_detail',['confirmation_code'=>$accounts->confirmation_code,'hrefParam'=>$post->hrefParam]) }}"><button>Read More</button></a></td>   
                                @endif
                                @if (is_null($accounts))
                                    <td rowspan="2"><a href="{{ route('user_post_detail',['confirmation_code'=>"guest",'hrefParam'=>$post->hrefParam]) }}"><button>Read More</button></a></td>
                                @endif
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div>
                                        <p>Content:<br>{{ $post->content }}</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @endforeach
                </div>
            @endif

            @if (count($event_result) != 0)
                <div class="table-header">EVENTS ({{ $event_count }})</div>
                <div class="table3">
                    @foreach ($event_result as $event)
                        <table>
                            <tr>
                                <td rowspan="2">
                                    <img src="{{ asset('storage/images/events/'.$event->image) }}" alt="" width="300" height="300"><!--thay doi kich thuoc anh <=> thay doi trong file css '.body table tr:first-child td:first-child{ width: ; height: ;}'-->
                                </td>
                                <td class="table-title">
                                    <div>
                                        <span>Title: {{ $event->title }}</span>
                                    </div>
                                </td>
                                <td class="table-title">
                                    <div>
                                        <span>Category: {{ $event->category_name }}</span>
                                    </div>
                                </td>
                                <td class="table-title">
                                    <div>
                                        <span>Location: {{ $event->location }}</span>
                                    </div>
                                </td>
                                @if (!is_null($accounts))
                                    <td rowspan="2"><a href="{{ route('event-detail', array('confirmation_code'=>$accounts->confirmation_code, 'href_param'=>$event->href_param,'id'=>$event->id)) }}"><button>Read More</button></a></td>
                                @endif
                                @if (is_null($accounts))    
                                    <td rowspan="2"><a href="{{ route('event-detail', array('confirmation_code'=>$accounts->id, 'href_param'=>$event->href_param,'id'=>$event->id)) }}"><button>Read More</button></a></td>
                                @endif
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div>
                                        <p>Content:<br> {{ $event->content }}</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @endforeach
                </div>
            @endif

            @if (count($animal_result) == 0 && count($event_result) == 0 && count($post_result) == 0)
                <b>0</b> results found !!!
            @endif

        </div>
    </div>
@endsection