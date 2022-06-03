@extends('layouts.masterLayout')

@section('header','Animal List')

@section('css-body')
    {{ asset('css/admin/list2.css') }}
@stop
        
@section('content')
    <div class="body">
        <div class="container">

            {{ Breadcrumbs::render('admin_animal_list',$accounts->confirmation_code,$id_category,$species) }}            

            <div style="display: flex; flex-direction: row-reverse; align-items: center; width: 100%; height: 100px;">
                <form method="post" action="{{ route('admin_animal_search',['confirmation_code'=>$accounts->confirmation_code]) }}" style="position: relative; display: flex; justify-content: flex-end; align-items: center; width: 75%;">
                    <br>
                    @csrf
                    <input type="hidden" name="id_category" value="{{ $id_category }}">
                    <input type="search" name="search" placeholder="Search..." class="form-control" style="padding-right: 40px; width: 300px;"
                        @if (isset($search))
                            value="{{ $search }}"
                        @endif
                    >
                    <button type="submit" style="position: absolute; top: 0px; right: 10px; height: 100%; background-color: transparent; border: none;"><img src="{{ asset('storage/images/home/search_icon.jpeg') }}" alt="" width="16" height="16"></button><br><br>
                </form>
                <span style="font-weight: bold; margin-left: 10px; margin-right:auto;"><i class="fas fa-flag"></i> Result({{ $count }})</span>
                <a href="{{ Route('admin_animal_add',['id_category'=>$id_category,'confirmation_code'=>$accounts->confirmation_code]) }}" style="position: relative; width: auto; margin-right: auto;"><button class="btn btn-success">Add Animal</button></a>
            </div>
            <div class="table1">
                @foreach ($animalList as $animal)
                <table>
                    <tr>
                        <td rowspan="4">
                            <b>shortThumbnail</b><br>
                            <img src="{{ asset('storage/images/animal/shortThumbnail/'.$animal->shortThumbnail) }}" alt="" width="300" height="400"><!--thay doi kich thuoc anh <=> thay doi trong file css '.body table tr:first-child td:first-child{ width: ; height: ;}'-->
                        </td>
                        <td class="short-detail">
                            <div>
                                <span><b>Normal name:</b> {{ $animal->normal_name }}</span>
                            </div>
                        </td>
                        <td class="short-detail">
                            <div>
                                <span><b>Scientific name:</b> {{ $animal->scientific_name }}</span>
                            </div>
                        </td>
                        <td rowspan="4">
                            <b>longThumbnail</b><br>
                            <img src="{{ asset('storage/images/animal/longThumbnail/'.$animal->longThumbnail) }}" alt="" width="250" height="300"><!--thay doi kich thuoc anh <=> thay doi trong file css '.body table tr:first-child td:last-child{ width: ;}'-->
                            <div class="table-button">
                                <a href="{{ route('admin_animal_edit',['confirmation_code'=>$accounts->confirmation_code,'id_animal'=>$animal->id]) }}"><button class="btn btn-warning">Edit</button></a>
                                <a href="{{ route('admin_animal_delete',['confirmation_code'=>$accounts->confirmation_code,'id_animal'=>$animal->id]) }}"><button class="btn btn-danger">Delete</button></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="short-detail">
                            <div>
                                <span><b>Category:</b> {{ $animal->category_name }}</span>
                            </div>
                        </td>
                        <td class="short-detail">
                            <div>
                                <span><b>Range:</b>{{ $animal-> range }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="long-detail">
                            <div>
                                <p><b>Diet:</b><Br> {{ $animal->diet }}</p>
                            </div>
                        </td>
                        <td class="long-detail">
                            <div>
                                <p><b>Size:</b><Br> {{ $animal->size }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="long-detail">
                            <div>
                                <p><b>Habitat:</b><Br> {{ $animal->habitat }}</p>
                            </div>
                        </td>
                        <td class="long-detail">
                            <div>
                                <p><b>Population status:</b><br> {{ $animal->population_status }}</p>
                            </div>
                        </td>
                    </tr>
                </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection