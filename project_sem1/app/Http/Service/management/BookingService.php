<?php
    namespace App\Http\Service\Management;

    use App\Models\management\account;
    use App\Models\management\Booking;
    use App\Models\management\Event;

    class BookingService {
        
        //Get data from database
        public function list()
        {
            $bookings = Booking::join('accounts', 'accounts.id', '=', 'bookings.id_user')
                                ->join('events', 'events.id', '=', 'bookings.id_event')
                                ->join('event_categories', 'event_categories.id', '=', 'events.id_event_category')
                                ->select( 'bookings.*', 'accounts.email', 'events.title', 'event_categories.name')
                                ->get();

            return $bookings;                                                     
        }

        //Get data from events table
        public function add()
        {
            $bookings = Event::select('title', 'id', 'price')->get();

            return $bookings;
        }

        //get data from events and accounts table
        public function addConfirm(string $id)
        {
            $events = Event::select('price', 'title', 'id')
                                ->where('id', $id)
                                ->first();
           
            $users = account::select('email', 'id')
                                ->where('id_rule_user', '<>', 1)
                                ->get();

            return ['users' => $users,
                    'events' => $events];
        }

        public function editConfirm($id_booking, $id_event)
        {
            $events = Event::select('price', 'title', 'id')
                                ->where('id', $id_event)
                                ->first();

            $users = account::select('email', 'id')
                                ->get();

            $bookings = Booking::find($id_booking);

            return ['users' => $users,
                    'events' => $events,
                    'bookings' => $bookings
                ];
        }

        //validate add booking form
        public function validateAdd($dataForm)
        {
            return $dataForm->validate([
                'id_event' => ['required', 'integer'],
            ]);
        }

        //validate add confirm form
        public function validateAddConfirm($dataForm)
        {
            return $dataForm->validate([
                'arrival_date' => ['nullable', 'date', 'after:today'],
                'quantity' => ['required', 'integer'],
                'id' => ['required', 'integer'],
                'price' => ['required'],
                'id_event' => ['required']
            ]);
        }

        //save data to database
        public function save(array $dataForm, Booking $bookings)
        {
            //save data to database
            $bookings->id_event = $dataForm['id_event'];
            $bookings->details = $dataForm['details'];
            $bookings->quantity = $dataForm['quantity'];
            $bookings->price = $dataForm['price'];
            $bookings->id_user = $dataForm['id'];
            
            if(isset($dataForm['arrival_date'])){
                $bookings->arrival_date = $dataForm['arrival_date'];
            }

            $bookings->save();
        }

        //Remove event from database
        public function delete(Booking $bookings)
        {
            $bookings->delete();
        }

        public function search($dataForm)
        {
            $bookings = Booking::join('accounts', 'accounts.id', '=', 'bookings.id_user')
                                ->join('events', 'events.id', '=', 'bookings.id_event')
                                ->join('event_categories', 'event_categories.id', '=', 'events.id_event_category')
                                ->select( 'bookings.*', 'accounts.email', 'events.title', 'event_categories.name')
                                ->where('events.title', 'like', '%'.$dataForm.'%')
                                ->orWhere('event_categories.name','like','%'.$dataForm.'%')
                                ->orWhere('bookings.details', 'like', '%'.$dataForm.'%')
                                ->orWhere('bookings.quantity', 'like', '%'.$dataForm.'%')
                                ->orWhere('bookings.price', 'like', '%'.$dataForm.'%')
                                ->orWhere('accounts.email', 'like', '%'.$dataForm.'%')
                                ->orWhere('bookings.created_at', 'like', '%'.$dataForm.'%')
                                ->orWhere('bookings.updated_at', 'like', '%'.$dataForm.'%')
                                ->get();

            return $bookings;
        }
    }