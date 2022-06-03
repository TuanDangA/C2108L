<?php
    namespace App\Http\Service\user;

    use App\Models\management\Booking;
    use App\Models\management\Event;

    class User_BookingService {
        
        //get event by hrefParam
        public function SelectEvent($href_param){
            $event = Event::where('href_param','=',$href_param)->first();
            return $event;
        }

        //select booking by ID
        public function SelectBooking($id){
            $booking = Booking::Find($id);
            return $booking;
        }

        //get event by ID
        public function SelectEventById($id){
            $event = Event::Find($id);
            return $event;
        }

        // add new event bookings
        public function post_add_event($request){
            $booking = new Booking();
            $booking->details = $request->details;
            $booking->quantity = $request->quantity;
            $booking->price = $request->price;
            $booking->id_user = $request->id_user;
            $booking->id_event = $request->id_event;
            $booking->save();
        }

        //  edit event bookings 
        public function post_edit_event($request){
            $booking = $this->SelectBooking($request->id_old_booking_event);
            $booking->details = $request->details;
            $booking->quantity = $request->quantity;
            $booking->price = $request->price;
            $booking->id_user = $request->id_user;
            $booking->id_event = $request->id_event;
            $booking->save();
        }

        //add new visit bookings 
        public function post_add_visit($request){
            if($request->quantity_adults >0){
                $booking = new Booking();
                $booking->details = $request->details;
                $booking->quantity = $request->quantity_adults;
                $booking->price = $request->total_price_adults;
                $booking->id_user = $request->id_user;
                $booking->id_event = 1;
                $booking->arrival_date = $request->arrival_date;
                $booking->save();
            }
            if($request->quantity_children >0){
                $booking = new Booking();
                $booking->details = $request->details;
                $booking->quantity = $request->quantity_children;
                $booking->price = $request->total_price_children;
                $booking->id_user = $request->id_user;
                $booking->id_event = 2;
                $booking->arrival_date = $request->arrival_date;
                $booking->save();
            }
        }

        //edit visit bookings
        public function post_edit_visit($request){
            $booking = $this->SelectBooking($request->id_old_booking_adults);
            if(!is_null($booking)){
                if($request->quantity_adults >0){
                    $booking->details = $request->details;
                    $booking->quantity = $request->quantity_adults;
                    $booking->price = $request->total_price_adults;
                    $booking->id_user = $request->id_user;
                    $booking->id_event = 1;
                    $booking->arrival_date = $request->arrival_date;
                    $booking->updated_at = now();
                    $booking->save();
                }
                if($request->quantity_adults ==0){
                    $booking->delete();
                }
            }
            if(is_null($booking) && $request->quantity_adults>0){
                $booking = new Booking();
                $booking->details = $request->details;
                $booking->quantity = $request->quantity_adults;
                $booking->price = $request->total_price_adults;
                $booking->id_user = $request->id_user;
                $booking->id_event = 1;
                $booking->arrival_date = $request->arrival_date;
                $booking->save();
            }

            $booking = $this->SelectBooking($request->id_old_booking_children);
            if(!is_null($booking)){
                if($request->quantity_children >0){
                    $booking->details = $request->details;
                    $booking->quantity = $request->quantity_children;
                    $booking->price = $request->total_price_children;
                    $booking->id_user = $request->id_user;
                    $booking->id_event = 2;
                    $booking->arrival_date = $request->arrival_date;
                    $booking->updated_at = now();
                    $booking->save();
                }
                if($request->quantity_children ==0){
                    $booking->delete();
                }
            }
            if(is_null($booking) && $request->quantity_children>0){
                $booking = new Booking();
                $booking->details = $request->details;
                $booking->quantity = $request->quantity_children;
                $booking->price = $request->total_price_children;
                $booking->id_user = $request->id_user;
                $booking->id_event = 2;
                $booking->arrival_date = $request->arrival_date;
                $booking->save();
            }
        }

        public function post_delete_event($request){
            $booking = $this->SelectBooking($request->id_old_booking_event);
            if(!is_null($booking)){
                $booking->delete();
            }
        }

        public function post_delete_visit($request){
            $booking = $this->SelectBooking($request->id_old_booking_adults);
            if(!is_null($booking)){
                $booking->delete();
            }

            $booking = $this->SelectBooking($request->id_old_booking_children);
            if(!is_null($booking)){
                $booking->delete();
            }
        }

        //return errors based on user's input to screen
        public function validateAdd_event($request)
        {
            return $request->validate([
                'quantity' => ['required', 'integer' ,'min:0'],
            ]);
        }

        //return errors based on user's input to screen
        public function validateAdd_visit($request)
        {
            return $request->validate([
                'arrival_date' => ['required','date','after_or_equal:today'],
                'quantity_adults' => ['required', 'integer' ,'min:0'],
                'quantity_children' => ['required', 'integer' ,'min:0'],
            ]);
        }

        //select Bookings of a user by id_user
        public function GetBookingsByID($id_user){
            $bookings = Booking::join('events','events.id','=','bookings.id_event')
                ->join('accounts','accounts.id','=','bookings.id_user')
                ->select('bookings.*','events.title','accounts.fullname','accounts.email','accounts.phone','bookings.price as total_price')
                ->where('bookings.id_user','=',$id_user)
                ->orderBy('updated_at','desc')
                ->get();
            return $bookings;
        }
    }