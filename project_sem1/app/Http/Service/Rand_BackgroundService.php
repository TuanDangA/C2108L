<?php
    namespace App\Http\Service;
    use Illuminate\Http\Request;
    use App\Models\rand_background;

    class Rand_BackgroundService{
        //get background by id
        public function GetBackgroundName($id){
            $background = rand_background::Find($id);
            return $background;
        }

        //get all backgrounds
        public function GetBackGrounds(){
            $backgrounds = rand_background::get();
            return $backgrounds;
        }

        //update database: add new background
        public function post_add($request){
            $background = new rand_background();
            $name = $request->file('thumbnail')->getClientOriginalName();
            $background->name = $name;
            //save image file into laravel
            $request->file('thumbnail')->storeAs('public/images/rand_backgrounds/',$name);
            $background->save();
        }

        public function ValadateAdd($request){
            return $request->validate([
                'thumbnail' => ['required']
            ]);
        }

        //select the first and last background.
        public function GetBackgroundQuantity(){
            $quantity = [];
            $backgrounds = rand_background::get();
            foreach($backgrounds as $background){
                $quantity[]= $background->id;
            }
            return array($quantity[0],array_pop($quantity));
        }

        //select a random background
        public function GetRandomBackground(){
            list($min,$quantity) = $this->GetBackgroundQuantity();
            while(1){
                $id = rand($min,$quantity);
                $background = $this->GetBackgroundName($id);
                if(!is_null($background)){
                    break;
                }
            } 
            return $background->name;
        }
        
        //update database: edit existing backgrounds
        public function post_edit($request){
            $background = rand_background::Find($request->id);   
            if(isset($request->thumbnail)){ 
                $file = $request->file('thumbnail');
                $thumbnail = $file->getClientOriginalName();
                $path = public_path().'/storage/images/rand_backgrounds/';
                //code for remove old file
                if($background->name != ''  && $background->name != null){
                    $file_old = $path.$background->name;
                    unlink($file_old);
                }
        
                //upload new file
                $file->move($path, $thumbnail);

                //update image file name in table
                $background->name = $thumbnail;
            }
            $background->save();
        }
    
        //update databse: delete backgrounds
        public function post_delete($request){
            $path1 = public_path().'/storage/images/rand_backgrounds/';
            $background = rand_background::Find($request->id);
            if($background->name != ''  && $background->name != null){
                $file_old = $path1.$background->name;
                unlink($file_old);
            }
            $background->delete();
        }

        //search backgrounds
        public function search($request){
            $search = $request->search;
            $backgrounds = rand_background::where('name', 'like', '%'.$search.'%')->get();
            return $backgrounds;
        }
    }