@extends('layouts.masterLayout')

@section('header','Delete Animal')

@section('css-body')
    {{ asset('css/admin/admin.css') }}
@stop

@section('content')
    <div class="container">
        <div class="body container">

            {{ Breadcrumbs::render('admin_animal_delete',$accounts->confirmation_code,$species->id,$species,$animal) }}            

            <form method="post" action="{{ Route('admin_animal_post',['confirmation_code'=>$accounts->confirmation_code]) }}">
                <fieldset>
                    <legend>Delete Animal</legend>
                    {{ csrf_field() }}
                    Are You Sure You Want To Delete This Animal?<br>
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="{{ $animal->id }}">
                    <input type="hidden" name="id_category" value="{{ $animal->id_category }}">
                    <label for="normal_name">Normal Name</label><br>
                    <input type="text" name="normal_name" value="{{ $animal->normal_name }}" class="form-control" readonly="true"><br>
                    <label for="scientific_name">Scientific Name</label><br>
                    <input type="text" name="scientific_name" value="{{ $animal->scientific_name }}" class="form-control" readonly="true"><br>
                    <label for="id_category">Category</label><br>
                    <input type="text" value="{{ $species->name }}" class="form-control" readonly="true"><br>
                    <label for="habitat">Habitat</label><Br>
                    <input type="text" name="habitat" value="{{ $animal->habitat }}" class="form-control" readonly="true"><br>
                    <label for="overview">Overview</label><br>
                    <textarea cols="30" rows="4" name="overview" class="form-control" readonly="true">{{ $animal->overview }}</textarea><br>
                    <label for="range">Range</label><br>
                    <input type="text" name="id_range" id="range" value="{{ $range->name }}" class="form-control" readonly="true"><br>
                    <label for="address">Address</label><br>
                    <input type="text" name="address" value="{{ $animal->address }}" class="form-control" readonly="true"><br>                
                    <label for="diet">Diet</label><br>
                    <input type="text" name="diet" id="diet" value="{{ $animal->diet }}" class="form-control" readonly="true"><br>
                    <label for="size">Size</label><br>
                    <input type="text" name="size" id="size" value="{{ $animal->size }}" class="form-control" readonly="true"><br>
                    <label for="population_status">Population Status</label><br>
                    <input type="text" name="population_status" id="population_status" value="{{ $animal->population_status }}" class="form-control" readonly="true"><br>
                    <label for="hrefParam">HrefParam</label><br>
                    <input type="text" name="hrefParam" id="hrefParam" value="{{ $animal->hrefParam }}" class="form-control" readonly="true"><br>
                    <label for="shortThumbnail">short Thumbnail</label><br>
                    <img id="imgSrc" src="{{ asset('storage/images/animal/shortThumbnail/'.$animal->shortThumbnail) }}" alt="Error!Try Again"><br><br>
                    <label for="longThumbnail">long Thumbnail</label><br>
                    <img id="imgSrc2" src="{{ asset('storage/images/animal/longThumbnail/'.$animal->longThumbnail) }}" alt="Error!Try Again"><br><br>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </fieldset>
            </form><br>
        </div>
    </div>
@stop

