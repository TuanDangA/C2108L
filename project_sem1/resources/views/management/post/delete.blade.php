@extends('layouts.masterLayout')

@section('header','Delete Post')
@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

        {{ Breadcrumbs::render('admin_post_delete',$accounts->confirmation_code,$category->id,$category,$post) }}        

        <form method="post" action="{{ Route('admin_post_post',['confirmation_code'=>$accounts->confirmation_code]) }}">
            <fieldset>
                <legend>Delete Post</legend>
                {{ csrf_field() }}
                Are You Sure You Want To Delete This Post?<br>
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="{{ $post->id }}">
                <input type="hidden" name="id_category_post" value="{{ $post->id_category_post }}">
                <label for="title">Title</label><br>
                <input type="text" value="{{ $post->title }}" class="form-control" Readonly="true"><br>
                <label for="description">Description</label><Br>
                <input Readonly="true" value="{{ $post->description }}" class="form-control"><br>
                <label for="id_category_post">Category</label><br>
                <input type="text" value="{{ $category->name }}" class="form-control" readonly><br>
                <label for="author">author</label><Br>
                <input type="text" value="{{ $old_author->name }}" class="form-control" Readonly="true"><br>
                <label for="content">Content</label><Br>
                <input type="text" value="{{ $post->content }}" class="form-control" Readonly="true"><br>
                <label for="shortThumbnail">shortThumbnail</label><Br>
                <img src="{{ asset('storage/images/post/shortThumbnail/'.$post->shortThumbnail) }}" alt="X"><br>
                <label for="longThumbnail">longThumbnail</label><Br>
                <img src="{{ asset('storage/images/post/longThumbnail/'.$post->longThumbnail) }}" alt="X"><br>
            </fieldset>
        </form>
        </div>
    </div>
@stop