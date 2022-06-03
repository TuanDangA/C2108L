@extends('layouts.masterLayout')

@section('header','NEXUS AQUARIUM | Ticket Price')

@section('css-body')
    {{ asset('css/user/ticket_price.css') }}
@stop

@section('content')
    <!-- PHAN 2: BODY -->
    <div class="body">
        <div class="container">
            @if (!is_null($accounts))
                {{ Breadcrumbs::render('ticket_price', $accounts->confirmation_code) }}        
            @endif
            @if (is_null($accounts))
                {{ Breadcrumbs::render('ticket_price', "guest") }}        
            @endif
            <div class="table1">
                <table>
                    <tr>
                        <th colspan="2"><!-- Định dạng độ dài tính theo cột mà ô này sẽ chiếm để hiển thị -->
                            Admission Ticket Pricing
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Children
                        </td>
                        <td>
                            18$
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Adult
                        </td>
                        <td>
                            25$
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Event
                        </td>
                        <td>
                            Varied with events and seasons
                        </td>
                    </tr>
                </table>
            </div>
            <div class="table3">
                <table>
                    <tr>
                        <th colspan="2"><!-- Định dạng độ dài tính theo cột mà ô này sẽ chiếm để hiển thị -->
                            Essential Add-Ons
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Parking Pass
                        </td>
                        <td>
                            3$
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Combo Meal Voucher
                        </td>
                        <td>
                            12$
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Family Meal Deal
                        </td>
                        <td>
                            40$
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection