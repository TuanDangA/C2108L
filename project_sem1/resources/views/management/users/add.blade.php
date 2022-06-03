@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | ADD NEW USER')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('users-add',$accounts->confirmation_code) }}        

        <form method="post" action="{{ route('users-insert', $accounts->confirmation_code) }}" enctype="multipart/form-data">
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

                <label for="fullname"><i class="fas fa-address-card"></i> Fullname</label>
                <input type="text" class="form-control" name="fullname" id="fullname">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="text" class="form-control" name="email" id="email">
                <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                <input type="text" class="form-control" name="phone" id="phone">
                <label for="address"><i class="fas fa-map-marked-alt"></i> Address</label>
                <input type="text" class="form-control" id="address" name="address">
                <label><i class="fas fa-venus-mars"></i> Gender</label>
                <br>
                <input type="radio" name="gender" value="male">Male
                <input type="radio" name="gender" value="female">Female
                <br>
                <label for="dob"><i class="fas fa-calendar-day"></i> DOB</label>
                <input type="date" class="form-control" name="dob" id="dob">
                <label for="password"><i class="fas fa-key"></i> Password</label>
                <input type="password" class="form-control" name="password" id="password">
                <label for="password_confirmation"><i class="fas fa-key"></i> Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                <label><i class="fas fa-portrait"></i> Avatar</label>
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