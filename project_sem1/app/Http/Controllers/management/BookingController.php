<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\management\Booking;
use App\Http\Service\management\BookingService;
use App\Models\management\account;

class BookingController extends Controller
{
    public $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    //return and send data to list page
    public function list(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        if(isset($request->search)){
            $bookings = $this->bookingService->search($request->search);
        }else {
            $bookings = $this->bookingService->list();
        }
        $index = 0;

        return view('management.bookings.list', [
            'bookings' => $bookings,
            'index' => $index,
            'accounts' => $accounts,
            'search'=>$request->search,
            'count'=>count($bookings)
        ]);
    }

    //return to add page
    public function add(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $bookings = $this->bookingService->add();

        return view('management.bookings.add', [
            'bookings' => $bookings,
            'accounts' => $accounts
        ]);
    }

    //send id event to service and return to confirm add page
    public function addConfirm(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $this->bookingService->validateAdd($request);

        $bookings = $this->bookingService->addConfirm($request->id_event);

        return view('management.bookings.confirm_add', [
            'bookings' => $bookings,
            'accounts' => $accounts
        ]);
    }

    //validate add field and add data to database by service, then return to list page
    public function insert(Request $request)
    {
        $bookings = new Booking();

        $this->bookingService->validateAddConfirm($request);

        $this->bookingService->save($request->all(), $bookings);

        return redirect()->route('bookings-list', $request->confirmation_code);
    }

    //send data and return to edit page
    public function edit(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $bookings = $this->bookingService->add();
        
        return view('management.bookings.edit', [
            'bookings' => $bookings,
            'id_booking' => $request->id_booking,
            'id_event' => $request->id_event,
            'accounts' => $accounts
        ]);
    }

    //validate edit event field and send id booking, event to service, then send data and return to confirm edit page
    public function editConfirm(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $this->bookingService->validateAdd($request);

        $bookings = $this->bookingService->editConfirm($request->id_booking, $request->id_event);

        return view('management.bookings.confirm_edit', [
            'bookings' => $bookings,
            'accounts' => $accounts
        ]);
    }

    //validate edit field and update data to database by service, then return to list page
    public function update(Request $request)
    {
        $bookings = Booking::find($request->old_id_booking);

        $this->bookingService->validateAddConfirm($request);

        $this->bookingService->save($request->all(), $bookings);

        return redirect()->route('bookings-list', $request->confirmation_code);
    }

    //Send data to service
    public function delete(Request $request)
    {
        $bookings = Booking::find($request->id);

        $this->bookingService->delete($bookings);
    }
}
