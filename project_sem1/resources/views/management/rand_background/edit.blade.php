@extends('layouts.masterLayout')

@section('header','Edit Background')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop
        
@section('content')
    <div class="container">
        <div class="body container">

            {{ Breadcrumbs::render('admin_rand_backgrounds_edit',$accounts->id,$background) }}        

            <form method="post" action="{{ Route('admin_rand_backgrounds_post',['confirmation_code'=>$accounts->confirmation_code]) }}" enctype="multipart/form-data">
                <fieldset>
                    <legend>Edit Background</legend>
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
                    <input type="hidden" name="id" value="{{ $background->id }}">
                    <label for="thumbnail">Thumbnail</label><br>
                    <div class="thumb">
                        <img id="imgSrc" src="{{ asset('storage/images/rand_backgrounds/'.$background->name) }}">
                        <div id="uploadCover" class="thumb-cover">         
                            <i class="fa fa-plus-square"></i>
                            <input type="file" name="thumbnail" id="imgUpload" accept="image/*" title="Click để thay đổi hình ảnh!" class="form-control">
                        </div>
                    </div><br>
                    <button type="submit" class="btn btn-warning">Edit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </fieldset>
            </form><br>
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
    </script>
@stop

            