<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\management\EventService;
use App\Models\management\Event;
use App\Models\management\account;

class EventController extends Controller
{
    public $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    //return and send data to list page
    public function list(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        if(isset($request->search)){
            $events = $this->eventService->search($request->search);
        }else {
            $events = $this->eventService->list();
        }

        $index = 0;

        return view('management.events.list2', [
            'events' => $events,
            'index' => $index,
            'accounts' => $accounts,
            'count'=>count($events),
            'search'=>$request->search
        ]);
    }

    //return to add page
    public function add(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $events = $this->eventService->add();

        return view('management.events.add', [
            'events' => $events,
            'accounts' => $accounts
        ]);
    }

    //validate add field and add data to database by service, then return to list page
    public function insert(Request $request)
    {
        $events = new Event();

        $this->eventService->validateAdd($request);

        $this->eventService->save($request->all(), $events);

        return redirect()->route('events-list', $request->confirmation_code);
    }

    //return and send data to edit page
    public function edit(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $events = Event::find($request->id);

        $events_category = $this->eventService->add();
        
        return view('management.events.edit', [
            'events' => $events,
            'events_category' => $events_category,
            'id' => $request->id,
            'accounts' => $accounts
        ]);
    }

    //validate edit field and update data to database by service, then return to list page
    public function update(Request $request)
    {
       $events = Event::find($request->id);

        $this->eventService->validateEdit($request);
        
        $this->eventService->save($request->all(), $events);

        return redirect()->route('events-list', $request->confirmation_code);
    }

    //Send data to service
    public function delete(Request $request)
    {
        $events = Event::find($request->id);

        $this->eventService->delete($events);
    }
}
