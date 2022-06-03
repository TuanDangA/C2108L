<?php
    namespace App\Http\Service\management;
    use App\Models\management\range;

    class RangeService{
        //select range by id
        public function SelectOne($criteria){
            $range = range::Find($criteria);
            return $range;
        }

        //select all ranges
        public function listAll(){
            $List = range::all();
            return $List;
        }

        public function ValadateAdd($request){
            return $request->validate([
                'name' => ['required']
            ]);
        }
        
        //update database: add new ranges
        public function post_add($request){
            $range = new range();
            $range->name = $request->name;
            $range->save();
        }

        //update database: edit ranges
        public function post_edit($request){
            $range = range::Find($request->id);
            $range->name = $request->name;
            $range->save();
        }

        //update database: delete ranges
        public function post_delete($request){
            $range = range::Find($request->id)->delete();
        }

        //search ranges
        public function search($request){
            $search = $request->search;
            $ranges = range::where('name', 'like', '%'.$search.'%')
            ->get();
            return $ranges;
        }
    }