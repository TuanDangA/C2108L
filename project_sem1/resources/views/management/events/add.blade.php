@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | ADD NEW EVENT')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('events-add',$accounts->confirmation_code) }}        

        <form method="post" action="{{ route('events-insert', $accounts->confirmation_code) }}" enctype="multipart/form-data">
            <div class="form-group">
                @csrf

                @if (count ($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <input type="hidden" name="confirmation_code" value="{{ $accounts->confirmation_code }}">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title">
                <label for="content">Content</label>
                <input type="text" class="form-control" name="content" id="content">
                <label for="start_date">Start Date</label> 
                <input type="datetime-local" class="form-control" name="start_date" id="start_date">
                <label for="end_date">End Date</label>
                <input type="datetime-local" class="form-control" name="end_date" id="end_date">
                <label for="location">Location</label>
                <input type="text" class="form-control" name="location" id="location">
                <label for="price">Price</label>
                <input type="number" class="form-control" name="price" id="price">
                <label for="id_event_category">Event Category</label>
                <select name="id_event_category" id="id_event_category" class="form-control">
                    <option value="">--Select--</option>
                    @foreach ($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
                <br>
                <label>Image</label>
                <div class="thumb">
                    <img id="imgSrc" src="" width="200px">
                    <div id="uploadCover" class="thumb-cover">         
                      <input type="file" name="image" id="imgUpload" class="form-control">
                    </div>
                </div>  
                <br>
                <button class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script type="text/javascript">
    //Get file when user upload
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgSrc').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);            
            }
        }
            
        //Display photo immediately
        $("#imgUpload").change(function() {
                readURL(this);  
        });
    </script>
@stop