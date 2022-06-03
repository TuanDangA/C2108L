@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | HOME-ADMIN')

@section('css-body')
    {{ asset('css/admin/home_admin.css') }}
@stop
    
@section('content')
    <!-- PHAN 2: BODY -->
    <div class="body">

        {{ Breadcrumbs::render('home_admin',$accounts->confirmation_code) }}        

        @if (Session::has('msg'))
            <div class="alert alert-success">
                {{ Session::get('msg') }} 
            </div>
        @endif
        
        <table>
            <tr>
                <td><a href="{{ route('admin_categoryAnimal_list',['confirmation_code'=>$accounts->confirmation_code]) }}"><button>Animals</button></a></td>
                <td><a href="{{ route('admin_categoryAnimal_list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add/Edit/Delete Animals and Animal Categories</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('admin_categoriesPost_list',['confirmation_code'=>$accounts->confirmation_code]) }}"><button>Posts</button></a></td>
                <td><a href="{{ route('admin_categoriesPost_list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add/Edit/Delete Posts and Post Categories</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('admin_range_list',['confirmation_code'=>$accounts->confirmation_code]) }}"><button>Ranges</button></a></td>
                <td><a href="{{ route('admin_range_list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add/Edit/Delete Ranges</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('admin_rand_backgrounds_list',['confirmation_code'=>$accounts->confirmation_code]) }}"><button>Random Backgrounds</button></a></td>
                <td><a href="{{ route('admin_rand_backgrounds_list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add/Edit/Delete Random Backgrounds</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('admin_author_list',['confirmation_code'=>$accounts->confirmation_code]) }}"><button>Authors</button></a></td>
                <td><a href="{{ route('admin_author_list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add/Edit/Delete Authors</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('users-list', $accounts->confirmation_code) }}"><button>Users</button></a></td>
                <td><a href="{{ route('users-list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add/Edit/Delete Users</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('event_category-list', $accounts->confirmation_code) }}"><button>Event Category</button></a></td>
                <td><a href="{{ route('event_category-list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add/Edit/Delete Event Categories</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('events-list', $accounts->confirmation_code) }}"><button>Events</button></a></td>
                <td><a href="{{ route('events-list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add/Edit/Delete Events</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('bookings-list', $accounts->confirmation_code) }}"><button>Bookings</button></a></td>
                <td><a href="{{ route('bookings-list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add/Edit/Delete Bookings</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('feedback_category-list', $accounts->confirmation_code) }}"><button>Feedback Category</button></a></td>
                <td><a href="{{ route('feedback_category-list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add/Edit/Delete Feedback Categories</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('feedbacks-list', $accounts->confirmation_code) }}"><button>Feedbacks</button></a></td>
                <td><a href="{{ route('feedbacks-list',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Edit/Delete Feedbacks</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('new_admin-add', $accounts->confirmation_code)}}"><button>Add New Admin</button></a></td>
                <td><a href="{{ route('new_admin-add',['confirmation_code'=>$accounts->confirmation_code]) }}" style="text-decoration:none">Add a new Admin</a></td>
            </tr>
        </table>
        
    </div>
@endsection