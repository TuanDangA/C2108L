<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\management\account;
use Illuminate\Http\Request;
use App\Http\Service\user\User_AnimalService as Service;
use App\Http\Service\user\EventService;

class UsersEventController extends Controller
{
    public $eventService;
    public $service;

    public $accounts = null;

    public function __construct(EventService $eventService,Service $serv)
    {
        $this->service = $serv;
        $this->eventService = $eventService;
    }

    public function view(Request $request)
    {
        $backgroundname = $this->service->GetRandomBackground();
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        if(isset($request->category) && $request->category != null){
            $events = $this->eventService->filter($request->category);
            return view('user.event.events_list', [
                'accounts' => $accounts,
                'events' => $events['events'],
                'categories' => $events['categories'],
                'backgroundname'=>$backgroundname,
                'count'=>count($events['events']),
                'old_category'=>$request->category          
            ]);
        } else {
            $events = $this->eventService->view();
            return view('user.event.events_list', [
                'accounts' => $accounts,
                'events' => $events['events'],
                'categories' => $events['categories'],
                'backgroundname'=>$backgroundname,
                'count'=>count($events['events'])            
            ]);
        }
           
    }

    //send event details to a new page
    public function detail($confirmation_code,$href_param)
    {
        $accounts = account::where('confirmation_code',$confirmation_code)->first();
        $events = $this->eventService->detail_href_param($href_param);
        $related_events = $this->eventService->getRelatedEvents($events->id_event_category);

        return view('user.event.event_detail', [
            'accounts' => $accounts,
            'events' => $events,
            'related_events'=>$related_events,       
        ]);

    }
}
