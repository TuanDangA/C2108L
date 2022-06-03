<?php
    namespace App\Http\Service\Management;

use App\Models\management\Event;
use App\Models\management\event_categories;

class EventService {
    //Get data from database
    public function list()
    {
        $events = Event::join('event_categories', 'event_categories.id', '=', 'events.id_event_category')
                            ->select( 'events.*', 'event_categories.name as category_name')
                            ->where('events.id_event_category','<>',1)
                            ->get();

        return $events;
    }

    //Get data from event_categories table
    public function add()
    {
        $events = event_categories::select('name', 'id')->get();

        return $events;
    }

    //validate add form
    public function validateAdd($dataForm)
    {
        return $dataForm->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'id_event_category' => ['required', 'integer'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);
    }

    //validate edit form
    public function validateEdit($dataForm)
    {
        return $dataForm->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'id_event_category' => ['required', 'integer'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);
    }

    //save data to database
    public function save(array $dataForm, Event $events)
    {
        //get file name from input and save file to storage
        if(isset($dataForm['image'])){
            //remove old image in storage
                if($events->image != null){
                    $path_short = public_path().'/storage/images/events/';

                    $file_old = $path_short.$events->image;
                    unlink($file_old);
                }

            $image = $dataForm['image'];
            $image_name = time().$image-> getClientOriginalName();
            $image-> storeAs('public/images/events', $image_name);
            $events->image = $image_name;
        }
        
        //save data to database
        $events->title = $dataForm['title'];
        $events->content = $dataForm['content'];
        $events->start_date = $dataForm['start_date'];
        $events->end_date = $dataForm['end_date'];
        $events->location = $dataForm['location'];
        $events->price = $dataForm['price'];
        $events->id_event_category = $dataForm['id_event_category'];

        $href_param = $this->exportParam($dataForm['title']);
        $events->href_param = $href_param;

        $events->save();
    }

    //Remove event from database
    public function delete(Event $events)
    {
        //remove old image in storage
            if($events->image != null){
                $path_short = public_path().'/storage/images/events/';

                $file_old = $path_short.$events->image;
                unlink($file_old);
            }

        $events->delete();
    }

    public function search($dataForm)
    {
        $events = Event::join('event_categories', 'event_categories.id', '=', 'events.id_event_category')
                            ->select('events.*', 'event_categories.name')
                            ->where('events.title', 'like', '%'.$dataForm.'%')
                            ->orWhere('events.start_date', 'like', '%'.$dataForm.'%')
                            ->orWhere('events.end_date', 'like', '%'.$dataForm.'%')
                            ->orWhere('events.price', 'like', '%'.$dataForm.'%')
                            ->orWhere('events.location', 'like', '%'.$dataForm.'%')
                            ->orWhere('event_categories.name', 'like', '%'.$dataForm.'%')
                            ->get();

        return $events;
    }


    public function exportParam($str) {
        $str = trim($str);
        $str = $this->stripVN($str);
        $str = strtolower($str);
        $str = str_replace("_", " ", $str);
        $str = str_replace(".", " ", $str);
        $str = str_replace("[", " ", $str);
        $str = str_replace("]", " ", $str);
        $str = str_replace("-", " ", $str);
        $str = trim($str);
        $str = preg_replace('!\s+!', ' ', $str);
        $str = str_replace(" ", "-", $str);
        $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);

        return $str;
    }

    public function stripVN($str) {
        $str = strtolower($str);

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }
}