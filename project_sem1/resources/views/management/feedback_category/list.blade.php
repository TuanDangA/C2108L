@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | FEEDBACK CATEGORIES LIST')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('feedback_category-list',$accounts->confirmation_code) }}        

        <div style="display: flex; flex-direction: row-reverse; align-items: center; width: 100%; height: 100px;">
            <form action="{{ route('feedback_category-list', $accounts->confirmation_code) }}" method="get" style="position: relative; display: flex; justify-content: flex-end; align-items: center; width: 75%;">
                @csrf
                <input type="search" class="form-control" name="search" placeholder="Search..." style="padding-right: 40px; width: 300px;"
                    @if (isset($search))
                        value="{{ $search }}"
                    @endif
                >
                <button type="submit" style="position: absolute; top: 0px; right: 10px; height: 100%; background-color: transparent; border: none;"><img src="{{ asset('storage/images/home/search_icon.jpeg') }}" alt="" width="16" height="16"></button><br><br>
            </form>
            <span style="font-weight: bold; margin-left: 10px; margin-right:auto;"><i class="fas fa-flag"></i> Result({{ $count }})</span>
            <div style="position: relative; width: auto; margin-right: auto;">
                <a href="{{ route('home_admin',['confirmation_code'=>$accounts->confirmation_code]) }}"><button class="btn btn-primary">Back</button></a>
                <a href="{{ route('feedback_category-add', $accounts->confirmation_code) }}">
                    <button class="btn btn-success">Add</button>
                </a>
            </div>
        </div>
        <br>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Category Name</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $item)
                    <tr>
                        <td>{{ (++$index) }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td style="width: 60px">
                            <a href="{{ route('feedback_category-edit', array('confirmation_code' => $accounts->confirmation_code, 'id'=>$item->id)) }}">
                                <button class="btn btn-warning">Edit</button>
                            </a>
                        </td>
                        <td style="width: 60px">
                            <button class="btn btn-danger" onclick="deleteCategory({{ $item->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@stop

@section('js')
    <script>
        //Confirm from admin to remove category and send id to controller
        function deleteCategory(id) {
            var option = confirm('Are you sure to delete this category?')

            if(!option) return

            $.post('{{ route('feedback_category-delete', $accounts->id) }}', {
                '_token': '{{csrf_token()}}',
                'id': id
            }, function(data) {
                location.reload()
            })
        }
    </script>
@stop