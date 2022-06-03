@extends('layouts.masterLayout')

@section('header','Edit Post')
@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

        {{ Breadcrumbs::render('admin_post_edit',$accounts->confirmation_code,$category->id,$category,$post) }}        

        <form method="post" action="{{ Route('admin_post_post',['confirmation_code'=>$accounts->confirmation_code]) }}" enctype="multipart/form-data">
            <fieldset>
                <legend>Edit Post</legend>
                {{ csrf_field() }}
                @if (count ($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="{{ $post->id }}">
                <input type="hidden" name="id_category_post" value="{{ $post->id_category_post }}">

                <label for="title">Title</label><br>
                <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control"><br>
                <label for="description">Description</label><br>
                <input type="text" name="description" id="description" value="{{ $post->description }}" class="form-control" ><br>
                <label for="id_category_post">Category</label><br>
                <input type="text" value="{{ $category->name}}" id="id_category_post" class="form-control" readonly="true"><br>
                <label for="id_author">Author</label><br>
                <select name="id_author" class="form-control" id="id_author">
                    @foreach ($authorList as $author)
                        <option value="{{ $author->id }}" @selected($author->id == $old_author->id)>{{ $author->name }}</option>
                    @endforeach
                </select><br>
                <label for="content">Content</label><br>
                <textarea cols="30" rows="4" name="content" id="content" class="form-control">{{ $post->content }}</textarea><br>
                <label for="shortThumbnail">shortThumbnail</label><br>
                <div class="thumb">
                    <img id="imgSrc" src="{{ asset('storage/images/post/shortThumbnail/'.$post->shortThumbnail) }}">
                    <div id="uploadCover" class="thumb-cover">         
                        <i class="fa fa-plus-square"></i>
                        <input type="file" name="shortThumbnail" id="imgUpload" accept="image/*" value="{{ $post->imgThumbnail }}" title="Click để thay đổi hình ảnh!" class="form-control">
                    </div>
                </div>  
                <label for="longThumbnail">longThumbnail</label><br>
                <div class="thumb">
                    <img id="imgSrc2" src="{{ asset('storage/images/post/longThumbnail/'.$post->longThumbnail) }}">
                    <div id="uploadCover" class="thumb-cover">         
                        <i class="fa fa-plus-square"></i>
                        <input type="file" name="longThumbnail" id="imgUpload2" accept="image/*" value="{{ $post->imgThumbnail }}" title="Click để thay đổi hình ảnh!" class="form-control">
                    </div>
                </div><br><br>
                <button type="submit" class="btn btn-warning">Edit</button>
                <button type="reset" class="btn btn-warning">Reset</button><br><br>
            </fieldset>
        </form>
        </div>  
    </div>  
@stop

@section('js')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgSrc').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);            
            }
        }
        $("#imgUpload").change(function() {
            readURL(this);  
        });
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgSrc2').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);            
            }
        }
        $("#imgUpload2").change(function() {
            readURL2(this);  
        });
    </script>
@stop