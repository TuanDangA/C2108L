@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | FEEDBACKS LIST')

@section('css-body')
    {{ asset('css/home.css') }}
@stop

@section('content')
    <div class="container" style="margin-top: 100px">

        {{ Breadcrumbs::render('feedbacks-list',$accounts->confirmation_code) }}        

        <div style="display: flex; flex-direction: row-reverse; align-items: center; width: 100%; height: 100px;">
            <form action="{{ route('feedbacks-list', $accounts->confirmation_code) }}" method="get" style="position: relative; display: flex; justify-content: flex-end; align-items: center; width: 75%;">
                @csrf
                <input type="search" class="form-control" name="search" placeholder="Search..." style="padding-right: 40px; width: 300px;"
                    @if (isset($search))
                        value="{{ $search }}"
                    @endif
                >
                <button type="submit" style="position: absolute; top: 0px; right: 10px; height: 100%; background-color: transparent; border: none;"><img src="{{ asset('storage/images/home/search_icon.jpeg') }}" alt="" width="16" height="16"></button><br><br>
            </form>
            <span style="font-weight: bold; margin-left: 10px; margin-right:auto;"><i class="fas fa-flag"></i> Result({{ $count }})</span>
        </div>
        <br>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Feedback Category</th>
                    <th>Content</th>
                    <th>Email User</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $item)
                    <tr>
                        <td>{{ (++$index) }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->content }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td style="width: 60px">
                            <a href="{{ route('feedbacks-edit', array('confirmation_code' => $accounts->confirmation_code, 'id'=>$item->id)) }}">
                                <button class="btn btn-warning">Edit</button>
                            </a>
                        </td>
                        <td style="width: 60px">
                            <button class="btn btn-danger" onclick="deleteFeedback({{$item->id}})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@stop

@section('js')
    <script>
        //Confirm from admin to remove user and send id to controller
        function deleteFeedback(id) {
            var option = confirm('Are you sure to delete this feedback?')

            if(!option) return

            $.post('{{ route('feedbacks-delete', $accounts->id) }}', {
                '_token': '{{csrf_token()}}',
                'id': id
            }, function(data) {
                location.reload()
            })
        }
    </script>
@stop