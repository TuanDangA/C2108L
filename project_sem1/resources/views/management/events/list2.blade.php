@extends('layouts.masterLayout')

@section('header','Event List')

@section('css-body')
    {{ asset('css/admin/list2.css') }}
@stop
        
@section('content')
    <div class="body">
        <div class="container">

            {{ Breadcrumbs::render('events-list',$accounts->confirmation_code) }}        

            <div style="display: flex; flex-direction: row-reverse; align-items: center; width: 100%; height: 100px;">
                    <form action="{{ route('events-list', $accounts->confirmation_code) }}" method="get" style="position: relative; display: flex; justify-content: flex-end; align-items: center; width: 75%;">
                        @csrf
                        <input type="hidden" name="id_user" value="{{ $accounts->id }}">
                        <input type="hidden" name="confirmation_code" value="{{ $accounts->confirmation_code }}">

                        <input type="search" class="form-control" name="search" placeholder="Search..." style="padding-right: 40px; width: 300px;"
                            @if (isset($search))
                                value="{{ $search }}"
                            @endif
                        >
                        <button type="submit" style="position: absolute; top: 0px; right: 10px; height: 100%; background-color: transparent; border: none;"><img src="{{ asset('storage/images/home/search_icon.jpeg') }}" alt="" width="16" height="16"></button><br><br>
                    </form>
                <span style="font-weight: bold; margin-left: 10px; margin-right:auto;"><i class="fas fa-flag"></i> Result({{ $count }})</span>
                <a href="{{ route('events-add', $accounts->confirmation_code) }}" style="position: relative; width: auto; margin-right: auto;"><button class="btn btn-success">Add Event</button></a>
            </div>

            <div class="table1">
                @foreach ($events as $item)
                <table>
                    <tr>
                        <td class="short-detail" style="width: 50%; height: auto; padding-right: 40px;">
                            <div style="width:100%;">
                                <span><b>Title:</b> {{ $item->title }}</span>
                            </div>
                        </td>
                        <td class="short-detail" style="width: 50%; height: auto; padding-right: 40px;">
                            <div style="width:100%;">
                                <span><b>Category name:</b> {{ $item->category_name }}</span>
                            </div>
                        </td>
                        <td rowspan="4">
                            <b>Image</b><br>
                            <img src="{{ asset('storage/images/events/'.$item->image) }}" alt="" width="360" height="240"><!--thay doi kich thuoc anh <=> thay doi trong file css '.body table tr:first-child td:first-child{ width: ; height: ;}'-->
                            <div class="table-button">
                                <a href="{{ route('events-edit', array('confirmation_code' => $accounts->confirmation_code, 'id'=>$item->id)) }}">
                                    <button class="btn btn-warning">Edit</button>
                                </a>                                
                                <button class="btn btn-danger" onclick="deleteEvent({{$item->id}})">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="short-detail" style="width: 50%; height: auto; padding-right: 40px;">
                            <div style="width:100%;">
                                <span><b>Price ($):</b> {{ $item->price }}</span>
                            </div>
                        </td>
                        <td class="short-detail" style="width: 50%; height: auto; padding-right: 40px;">
                            <div style="width:100%;">
                                <span><b>Location:</b>{{ $item-> location }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="short-detail" style="width: 50%; height: auto; padding-right: 40px;">
                            <div style="width:100%;">
                                <p><b>Start Date:</b> {{ $item->start_date }}</p>
                            </div>
                        </td>
                        <td class="short-detail" style="width: 50%; height: auto; padding-right: 40px;">
                            <div style="width:100%;">
                                <p><b>End Date:</b> {{ $item->end_date }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="long-detail" colspan="2" style="padding-right: 40px;">
                            <div style="width:100%;height:50%;max-height:200px">
                                <p><b>Content:</b><Br> {{ $item->content }}</p>
                            </div>
                        </td>
                    </tr>
                </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //Confirm from admin to remove user and send id to controller
        function deleteEvent(id) {
            var option = confirm('Are you sure to delete this event?')

            if(!option) return

            $.post('{{ route('events-delete', $accounts->id) }}', {
                '_token': '{{csrf_token()}}',
                'id': id
            }, function(data) {
                location.reload()
            })
        }
    </script>
@stop