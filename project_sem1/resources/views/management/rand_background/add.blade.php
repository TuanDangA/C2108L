@extends('layouts.masterLayout')

@section('header','Add Background')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop
    
@section('content')
    <div class="container">
        <div class="body container">

            {{ Breadcrumbs::render('admin_rand_backgrounds_add',$accounts->confirmation_code) }}        

            <form method="post" action="{{ route('admin_rand_backgrounds_post',['confirmation_code'=>$accounts->confirmation_code]) }}" enctype="multipart/form-data">
                <fieldset>
                    <legend>Add Background</legend>
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
                    
                    <input type="hidden" name="action" value="add">
                    
                    <label for="thumbnail">Thumbnail</label><br>
                    <div class="thumb">
                        <img id="imgSrc" src="{{ asset('storage/images/no_thumb.jpeg') }}">
                        <div id="uploadCover" class="thumb-cover">         
                            <i class="fa fa-plus-square"></i>
                            <input type="file" name="thumbnail" id="imgUpload" accept="image/*" title="Click để thay đổi hình ảnh!" class="form-control">
                        </div>
                    </div><br>
                    <button type="submit" class="btn btn-success">Add</button>
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