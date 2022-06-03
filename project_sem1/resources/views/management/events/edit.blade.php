@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | EDIT EVENT')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('events-edit',$accounts->confirmation_code,$events) }}        

        <form method="post" action="{{ route('events-update', $accounts->confirmation_code) }}" enctype="multipart/form-data">
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

                <input type="hidden" name="id" value="{{ $events->id }}">

                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $events->title }}">
                <label for="content">Content</label>
                <input type="text" class="form-control" name="content" id="content" value="{{ $events->content }}">
                <label for="start_date">Start Date</label>
                <input type="datetime-local" class="form-control" name="start_date" id="start_date" value="{{ date("Y-m-d\TH:i", strtotime($events->start_date)) }}">
                <label for="end_date">End Date</label>
                <input type="datetime-local" class="form-control" name="end_date" id="end_date" value="{{ date("Y-m-d\TH:i", strtotime($events->end_date)) }}">
                <label for="location">Location</label>
                <input type="text" class="form-control" name="location" id="location" value="{{ $events->location }}">
                <label for="price">Price</label>
                <input type="number" class="form-control" name="price" id="price" value="{{ $events->price }}">
                <label for="id_event_category">Event Category</label>
                <select name="id_event_category" id="id_event_category" class="form-control">
                    <option value="">--Select--</option>
                    @foreach ($events_category as $item)
                        <option value="{{ $item->id }}" @if ($events->id_event_category == $item->id) selected @endif>
                            {{ $item->name }}
                        </option>
                    @endforeach 
                </select>
                <br>
                <label>Image</label>
                <div class="thumb">
                    <img id="imgSrc" src="{{ asset('storage/images/events/'.$events->image) }}" width="300px" height="200px">
                    <div id="uploadCover" class="thumb-cover">         
                      <input type="file" name="image" id="imgUpload" class="form-control">
                    </div>
                </div>  
                <br>
                <button class="btn btn-success">Edit</button>
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