<?php
    namespace App\Http\Service\user;

    use App\Models\management\Event;
    use App\Models\management\event_categories;

    class EventService
    {
        public function view()
        {
            $events = Event::where('id_event_category', '<>', 1)
                                ->get();

            $categories = event_categories::where('id', '<>', 1)
                                            ->get('name');

            return [
                'events' => $events,
                'categories' => $categories
            ];
        }

        public function filter($dataForm)
        {
            $events = Event::join('event_categories', 'event_categories.id', '=', 'events.id_event_category')
                                ->select('events.*', 'event_categories.name')
                                ->where('event_categories.name', $dataForm)
                                ->get();
            
            $categories = event_categories::where('id', '<>', 1)
                                            ->get('name');

            return [
                'events' => $events,
                'categories' => $categories
            ];
        }

        //get events in the same category as the given one
        public function getRelatedEvents($id){
            $eventList = Event::where('id_event_category','=',$id)->get();
            return $eventList;
        }

        //select event by id
        public function detail($id)
        {
            return $events = Event::find($id);
        }

        public function detail_href_param($href_param){
            $event = Event::where('href_param',$href_param)->first();
            return $event;
        }

        //search for events according to keywords specified in $request->search variable
        public function search_general($request){
            $search = $request->search;
            $events = Event::join('event_categories', 'event_categories.id', '=', 'events.id_event_category')
            ->select('events.*', 'event_categories.name as category_name')
            ->where('events.id','<>',1)
            ->where('events.id','<>',2)
            ->where('events.title','like', '%'.$search.'%')
            ->orWhere('events.content','like', '%'.$search.'%')
            ->orWhere('events.location','like', '%'.$search.'%')
            ->orWhere('event_categories.name','like', '%'.$search.'%')
            ->get();
            return $events;
        }

        //select all events
        public function listAllEvents(){
            $events = Event::join('event_categories', 'event_categories.id', '=', 'events.id_event_category')
            ->select('events.*', 'event_categories.name as category_name')
            ->where('events.id','<>',1)
            ->where('events.id','<>',2)
            ->get();
            return $events;
        }
    }