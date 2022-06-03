@extends('layouts.masterLayout')

@section('header','Edit Animal')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop
        
@section('content')
    <div class="container">
        <div class="body container">

        {{ Breadcrumbs::render('admin_animal_edit',$accounts->confirmation_code,$species->id,$species,$animal) }}            

        <form method="post" action="{{ Route('admin_animal_post',['confirmation_code'=>$accounts->confirmation_code]) }}" enctype="multipart/form-data">
            <fieldset>
                <legend>Edit Animal</legend>
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
                <input type="hidden" name="id" value="{{ $animal->id }}">
                <input type="hidden" name="id_category" value="{{ $animal->id_category }}">
                <label for="normal_name">Normal Name</label><br>
                <input type="text" name="normal_name" id="normal_name" value="{{ $animal->normal_name }}" class="form-control"><br>
                <label for="scientific_name">Scientific Name</label><br>
                <input type="text" id="scientific_name" name="scientific_name" value="{{ $animal->scientific_name }}" class="form-control"><br>
                <label for="id_category">Category</label><br>
                <input type="text" id="id_category" value="{{ $species->name }}" class="form-control" readonly="true"><br>
                <label for="habitat">Habitat</label><Br>
                <input type="text" name="habitat" id="habitat" value="{{ $animal->habitat }}" class="form-control"><br>
                <label for="overview">Overview</label><br>
                <textarea cols="30" rows="4" name="overview" id="overview" class="form-control">{{ $animal->overview }}</textarea><br>
                <label for="range">Range</label><br>
                <select name="id_range" id="range">
                    @foreach ($ranges as $range)
                        <option value="{{ $range->id }}" @selected($animal->id_range == $range->id)>{{ $range->name }}</option>
                    @endforeach
                </select><br>              
                <label for="diet">Diet</label><br>
                <input type="text" name="diet" id="diet" value="{{ $animal->diet }}" class="form-control"><br>
                <label for="size">Size</label><br>
                <input type="text" name="size" id="size" value="{{ $animal->size }}" class="form-control"><br>
                <label for="population_status">Population Status</label><br>
                <input type="text" name="population_status" id="population_status" value="{{ $animal->population_status }}" class="form-control"><br>
                <label for="shortThumbnail">short Thumbnail</label><br>
                <div class="thumb">
                    <img id="imgSrc" src="{{ asset('storage/images/animal/shortThumbnail/'.$animal->shortThumbnail) }}">
                    <div id="uploadCover" class="thumb-cover">         
                        <i class="fa fa-plus-square"></i>
                        <input type="file" name="shortThumbnail" id="imgUpload" accept="image/*" title="Click để thay đổi hình ảnh!" class="form-control">
                    </div>
                </div><br>
                <label for="longThumbnail">long Thumbnail</label><br>
                <div class="thumb">
                    <img id="imgSrc2" src="{{ asset('storage/images/animal/longThumbnail/'.$animal->longThumbnail) }}">
                    <div id="uploadCover" class="thumb-cover">         
                        <i class="fa fa-plus-square"></i>
                        <input type="file" name="longThumbnail" id="imgUpload2" accept="image/*" title="Click để thay đổi hình ảnh!" class="form-control">
                    </div>
                </div><br>
                <button type="submit" class="btn btn-info">Edit</button>
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

            