<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\management\Booking;
use App\Http\Service\Rand_BackgroundService as Service_Rand_Background;
use App\Http\Service\user\User_BookingService;
use App\Http\Service\management\AccountService as Service_Account;

class User_BookingsController extends Controller
{
    public $bookingService;
    public $Serv_Rand_Background;
    public $Serv_Account;

    public function __construct(Service_Rand_Background $Service_Rand_Background,User_BookingService $bookingService,Service_Account $Service_Account)
    {
        $this->Serv_Rand_Background = $Service_Rand_Background;
        $this->bookingService = $bookingService;
        $this->Serv_Account = $Service_Account;
    }

    //return user's booking list to view to be edited or canceled
    public function booking_list($confirmation_code){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $bookings = $this->bookingService->GetBookingsByID($accounts->id);
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $index = 0;
        return view('user.bookings.booking_list',[
            'bookings'=>$bookings,
            'accounts' => $accounts,
            'backgroundname'=>$backgroundname,
            'index'=>$index,
        ]);
    }

    // if users are editing event bookings, prior data will be sent back to booking_event_form function, 
    // and if they are editing visit bookings, booking_visit_form function
    public function route_add_edit($confirmation_code,$id_booking)
    {
        $booking = $this->bookingService->SelectBooking($id_booking);
        switch($booking->id_event){
            case 1:{
                $old_booking_children = Booking::where('updated_at','=',$booking->updated_at)->where('id_user','=',$booking->id_user)->where('id_event','=',2)->first();
                if(!is_null($old_booking_children)){
                    return redirect()->route('user_visit_booking_form',['confirmation_code'=>$confirmation_code,'id_old_booking_adults'=>$id_booking,'id_old_booking_children'=>$old_booking_children->id]);
                }
                else{
                    return redirect()->route('user_visit_booking_form',['confirmation_code'=>$confirmation_code,'id_old_booking_adults'=>$id_booking,'id_old_booking_children'=>0]);
                }
                break;
            }
            case 2:{
                $old_booking_adults = Booking::where('updated_at','=',$booking->updated_at)->where('id_user','=',$booking->id_user)->where('id_event','=',1)->first();
                if(!is_null($old_booking_adults)){
                    return redirect()->route('user_visit_booking_form',['confirmation_code'=>$confirmation_code,'id_old_booking_adults'=>$old_booking_adults->id,'id_old_booking_children'=>$id_booking]);
                }
                else{
                    return redirect()->route('user_visit_booking_form',['confirmation_code'=>$confirmation_code,'id_old_booking_adults'=>0,'id_old_booking_children'=>$id_booking]);
                }
                break;
            }
            default:{
                $event = $this->bookingService->SelectEventById($booking->id_event);
                return redirect()->route('user_event_booking_form',['confirmation_code'=>$confirmation_code,'href_param'=>$event->href_param,'id_old_booking_event'=>$booking->id]);
                break;
            }
        }
    }

    // if users are deleting event bookings, prior data will be sent back to booking_event_delete function, 
    // and if they are deleting visit bookings, booking_visit_delete function
    public function route_delete($confirmation_code,$id_booking){
        $booking = $this->bookingService->SelectBooking($id_booking);
        switch($booking->id_event){
            case 1:{
                $old_booking_children = Booking::where('updated_at','=',$booking->updated_at)->where('id_user','=',$booking->id_user)->where('id_event','=',2)->first();
                if(!is_null($old_booking_children)){
                    return redirect()->route('user_visit_booking_delete',['confirmation_code'=>$confirmation_code,'id_old_booking_adults'=>$id_booking,'id_old_booking_children'=>$old_booking_children->id]);
                }
                else{
                    return redirect()->route('user_visit_booking_delete',['confirmation_code'=>$confirmation_code,'id_old_booking_adults'=>$id_booking,'id_old_booking_children'=>0]);
                }
                break;
            }
            case 2:{
                $old_booking_adults = Booking::where('updated_at','=',$booking->updated_at)->where('id_user','=',$booking->id_user)->where('id_event','=',1)->first();
                if(!is_null($old_booking_adults)){
                    return redirect()->route('user_visit_booking_delete',['confirmation_code'=>$confirmation_code,'id_old_booking_adults'=>$old_booking_adults->id,'id_old_booking_children'=>$id_booking]);
                }
                else{
                    return redirect()->route('user_visit_booking_delete',['confirmation_code'=>$confirmation_code,'id_old_booking_adults'=>0,'id_old_booking_children'=>$id_booking]);
                }
                break;
            }
            default:{
                $event = $this->bookingService->SelectEventById($booking->id_event);
                return redirect()->route('user_event_booking_delete',['confirmation_code'=>$confirmation_code,'href_param'=>$event->href_param,'id_old_booking_event'=>$booking->id]);
                break;
            }
        }
    }

    //return old event booking data to event_booking_form page/add new bookings
    public function booking_event_form($confirmation_code,$href_param,$id_old_booking_event)
    {
        $old_booking_event = $this->bookingService->SelectBooking($id_old_booking_event);
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $event = $this->bookingService->SelectEvent($href_param);

        return view('user.bookings.event.event_booking_form', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'event' => $event,
            'old_booking_event' => $old_booking_event
        ]);
    }

    //confirm booking data before uploading to the database
    public function booking_event_confirm($confirmation_code,$href_param,Request $request)
    {
        $this->bookingService->validateAdd_event($request);
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $event = $this->bookingService->SelectEvent($href_param);
        return view('user.bookings.event.event_booking_confirm', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'event' => $event,
            'request'=>$request
        ]);
    }

    //show uploaded booking details
    public function booking_event_submit($confirmation_code,$href_param,Request $request)
    {
        switch($request->action){
            case "add":{
                $this->bookingService->post_add_event($request);
                break;
            }
            case "edit":{
                $this->bookingService->post_edit_event($request);
                break;
            }
            case "delete":{
                $this->bookingService->post_delete_event($request);
                return redirect()->route('user_booking_list',['confirmation_code'=>$confirmation_code]);
                break;
            }
        };
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $event = $this->bookingService->SelectEvent($href_param);

        return view('user.bookings.event.event_booking_submit', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'event' => $event,
            'request'=>$request
        ]);
    }

    //show visit boong details which include price, working hours, ticket information,....
    public function booking_visit_details($confirmation_code){
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $visit_adults = $this->bookingService->SelectEventById(1);
        $visit_children = $this->bookingService->SelectEventById(2);
        return view('user.bookings.visit.visit_booking_details', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'visit_adults'=>$visit_adults,
            'visit_children'=>$visit_children
        ]);
    }

    //add/edit booking details
    public function booking_visit_form($confirmation_code,$id_old_booking_adults,$id_old_booking_children)
    {
        $old_booking_adults = $this->bookingService->SelectBooking($id_old_booking_adults);
        $old_booking_children = $this->bookingService->SelectBooking($id_old_booking_children);
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $visit_adults = $this->bookingService->SelectEventById(1);
        $visit_children = $this->bookingService->SelectEventById(2);
        return view('user.bookings.visit.visit_booking_form', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'visit_adults'=>$visit_adults,
            'visit_children'=>$visit_children,
            'old_booking_adults'=>$old_booking_adults,
            'old_booking_children'=>$old_booking_children
        ]);
    }

    //confirm booking details before uploading to the database
    public function booking_visit_confirm($confirmation_code,Request $request)
    {
        $this->bookingService->validateAdd_visit($request);
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $index = 0;
        $visit_adults = $this->bookingService->SelectEventById(1);
        $visit_children = $this->bookingService->SelectEventById(2);
        return view('user.bookings.visit.visit_booking_confirm', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'request'=>$request,
            'index'=>$index,
            'visit_adults'=>$visit_adults,
            'visit_children'=>$visit_children
        ]);
    }

    //show uploaded data
    public function booking_visit_submit($confirmation_code,Request $request)
    {
        switch($request->action){
            case "add":{
                $this->bookingService->post_add_visit($request);
                break;
            }
            case "edit":{
                $this->bookingService->post_edit_visit($request);
                break;
            }
            case "delete":{
                $this->bookingService->post_delete_visit($request);
                return redirect()->route('user_booking_list',['confirmation_code'=>$confirmation_code]);
                break;
            }
        }
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $index = 0;
        return view('user.bookings.visit.visit_booking_submit', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'request'=>$request,
            'index'=>$index
        ]);
    }

    public function booking_visit_delete($confirmation_code,$id_old_booking_adults,$id_old_booking_children){
        $old_booking_adults = $this->bookingService->SelectBooking($id_old_booking_adults);
        $old_booking_children = $this->bookingService->SelectBooking($id_old_booking_children);
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $visit_adults = $this->bookingService->SelectEventById(1);
        $visit_children = $this->bookingService->SelectEventById(2);
        return view('user.bookings.visit.visit_booking_delete', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'visit_adults'=>$visit_adults,
            'visit_children'=>$visit_children,
            'old_booking_adults'=>$old_booking_adults,
            'old_booking_children'=>$old_booking_children
        ]);
    }

    public function booking_visit_edit($confirmation_code,Request $request){
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $visit_adults = $this->bookingService->SelectEventById(1);
        $visit_children = $this->bookingService->SelectEventById(2);
        return view('user.bookings.visit.visit_booking_form_edit', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'visit_adults'=>$visit_adults,
            'visit_children'=>$visit_children,
            'request'=>$request,
            'old_booking_adults'=>null,
            'old_booking_children'=>null
        ]);
    }

    public function booking_event_delete($confirmation_code,$href_param,$id_old_booking_event)
    {
        $old_booking_event = $this->bookingService->SelectBooking($id_old_booking_event);
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $event = $this->bookingService->SelectEvent($href_param);

        return view('user.bookings.event.event_booking_delete', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'event' => $event,
            'old_booking_event' => $old_booking_event
        ]);
    }

    public function booking_event_edit($confirmation_code,$href_param,Request $request){
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $event = $this->bookingService->SelectEvent($href_param);
        return view('user.bookings.event.event_booking_form_edit', [
            'backgroundname'=>$backgroundname,
            'accounts' => $accounts,
            'event' => $event,
            'old_booking_event' => null,
            'request'=>$request
        ]);
    }
}
