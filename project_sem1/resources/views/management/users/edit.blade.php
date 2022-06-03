@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | EDIT USERS INFORMATION')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('users-edit',$accounts->confirmation_code,$users) }}        

        <div class="form-group">
            <form method="post" action="{{route('users-update', $accounts->confirmation_code)}}" enctype="multipart/form-data">
                @csrf

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="hidden" name="id" value="{{$id}}">
                <input type="hidden" name="confirmation_code" value="{{ $accounts->confirmation_code }}">
                <label for="fullname"><i class="fas fa-address-card"></i> Fullname</label>
                <input type="text" class="form-control" name="fullname" id="fullname" value="{{$users->fullname}}">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{$users->email}}">
                <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{ $users->phone }}">
                <label for="address"><i class="fas fa-map-marked-alt"></i> Address</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ $users->address}}">
                <label><i class="fas fa-venus-mars"></i> Gender</label>
                <br>
                <input type="radio" name="gender" value="male" @if ($users->gender == 'male') checked @endif>Male
                <input type="radio" name="gender" value="female" @if ($users->gender == 'female') checked @endif>Female
                <br>
                <label><i class="fas fa-calendar-day"></i> DOB</label>
                <input type="date" class="form-control" name="dob" value="{{ $users->dob}}">
                <label><i class="fas fa-portrait"></i> Avatar</label>
                <div class="thumb">
                    <img id="imgSrc" src="{{ asset('storage/images/user_avatar/'.$users->image) }}" width="200px">
                    <div id="uploadCover" class="thumb-cover">         
                      <input type="file" name="image" id="imgUpload" class="form-control">
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Update</button>
            </form>
        </div>
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