@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | EDIT PROFILE')

@section('css-body')
    {{ asset('css/user/editprofile.css') }}
@stop


@section('content')
<div class="body">
    <div class="container">

        <div style="margin-left:70px;">
            @if (!is_null($accounts))
                {{ Breadcrumbs::render('profile-edit', $accounts->confirmation_code) }}        
            @endif
            @if (is_null($accounts))
                {{ Breadcrumbs::render('profile-edit', "guest") }}        
            @endif
        </div>

        <form method="post" action="{{ route('profile-edit-save', $accounts->confirmation_code) }}" enctype="multipart/form-data">
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

            <input type="hidden" name="id" value="{{ $accounts->id }}">
            <div>
                <label for="fullname">Fullname:</label>
                <input required type="text" name="fullname" id="fullname" value="{{ $accounts->fullname }}" placeholder="Enter your fullname">
            </div>
            <div>
                <label for="phone">Phone number:</label>
                <input required type="text" name="phone" id="phone" value="{{ $accounts->phone }}" placeholder="Enter your phone number">
            </div>
            <div>
                <label for="address">Address:</label>
                <input required type="text" name="address" id="address" value="{{ $accounts->address }}" placeholder="Enter your address">
            </div>
            <div>
                <label for="gender">Gender:</label>
                <select name="gender" id="gender">
                    <option value="default">---Select---</option>
                    <option value="male" @if ($accounts->gender == 'male') selected @endif>Male</option>
                    <option value="female" @if ($accounts->gender == 'female') selected @endif>Female</option>
                </select>
            </div>
            <div>
                <label for="dob">Date of birth:</label>
                <input required type="date" name="dob" id="dob" value="{{ $accounts->dob }}">
            </div>
            <div>
            <div class="thumb">
                <label for="image">Avatar:</label>
                @if (isset($accounts->image))
                    <img id="imgSrc" src="{{asset('storage/images/user_avatar/'.$accounts->image)}}" width="200px">
                @else
                    <img id="imgSrc" src="" width="200px" alt="Your avatar">
                @endif
                <div id="uploadCover" class="thumb-cover">         
                    <input type="file" name="image" id="imgUpload" class="form-control">
                </div>
            </div>
            </div>  
            <button type="submit">Save</button>
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
