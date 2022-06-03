@extends('layouts.masterLayout')

@section('header','Post List')
@section('css-body')
    {{ asset('css/admin/list2.css') }}
@stop

@section('content')
    <div class="body">
        
        <div class="container">

            {{ Breadcrumbs::render('admin_post_list',$accounts->confirmation_code,$id_category,$category) }}        

            <div style="display: flex; flex-direction: row-reverse; align-items: center; width: 100%; height: 100px;">
                @if (isset($accounts))
                    <form method="post" action="{{ route('admin_post_search',['confirmation_code'=>$accounts->confirmation_code]) }}" style="position: relative; display: flex; justify-content: flex-end; align-items: center; width: 75%;">
                        <br>
                        @csrf
                        <input type="hidden" name="id_category" value="{{ $id_category }}">
                        <input type="search" name="search" placeholder="Search..." class="form-control" style="padding-right: 40px; width: 300px;"
                            @if (isset($search))
                                value="{{ $search }}"
                            @endif
                        >
                        <button type="submit" style="position: absolute; top: 0px; right: 10px; height: 100%; background-color: transparent; border: none;"><img src="{{ asset('storage/images/home/search_icon.jpeg') }}" alt="" width="16" height="16"></button><br><br>
                    </form>
                @endif
                <span style="font-weight: bold; margin-left: 10px; margin-right:auto;"><i class="fas fa-flag"></i> Result({{ $count }})</span>
                <a href="{{ Route('admin_post_add',['id_category'=>$id_category,'confirmation_code'=>$accounts->confirmation_code]) }}" style="position: relative; width: auto; margin-right: auto;"><button class="btn btn-success">Add Post</button></a>
            </div>

            <div class="table1">
                @foreach ($postList as $post)
                <table>
                    <tr>
                        <td rowspan="5">
                            <b>shortThumbnail</b><br>
                            <img src="{{ asset('storage/images/post/shortThumbnail/'.$post->shortThumbnail) }}" alt="" width="300" height="400"><!--thay doi kich thuoc anh <=> thay doi trong file css '.body table tr:first-child td:first-child{ width: ; height: ;}'-->
                        </td>
                        <td class="short-detail">
                        </td>
                        <td class="short-detail">
                        </td>
                        <td rowspan="5">
                            <b>longThumbnail</b><br>
                            <img src="{{ asset('storage/images/post/longThumbnail/'.$post->longThumbnail) }}" alt="" width="250" height="300"><!--thay doi kich thuoc anh <=> thay doi trong file css '.body table tr:first-child td:last-child{ width: ;}'-->
                            <div class="table-button">
                                <a href="{{ Route('admin_post_edit',['id_post'=>$post->id,'confirmation_code'=>$accounts->confirmation_code]) }}"><button class="btn btn-warning">Edit</button></a>                                
                                <a href="{{ Route('admin_post_delete',['id_post'=>$post->id,'confirmation_code'=>$accounts->confirmation_code]) }}"><button class="btn btn-danger">Delete</button></a>                            
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="short-detail">
                            <b>Title:</b><br> 
                            <div>
                                <span>{{ $post->title }}</span>
                            </div>
                        </td>
                        <td class="long-detail" rowspan="2">
                            <div>
                                <p><b>Description:</b><Br>{{ $post->description }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="short-detail">
                            <b>Category:</b><br>
                            <div>
                                <span>{{ $post->category_name }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="short-detail">
                            <b>Author:</b><br>
                            <div>
                                <span>{{ $post->author_name }}</span>
                            </div>
                        </td>
                        <td class="long-detail" rowspan="2">
                            <div>
                                <p><b>Content:</b><Br> {{ $post->content }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="short-detail">
                            <b>HrefParam:</b><br>
                            <div>
                                <span>{{ $post-> hrefParam }}</span>
                            </div>
                        </td>
                    </tr>
                </table>
                @endforeach
            </div>

        </div>

    </div>
@endsection