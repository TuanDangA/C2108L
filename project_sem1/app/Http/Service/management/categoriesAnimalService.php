<?php
    namespace App\Http\Service\management;
    use App\Models\management\categoriesAnimal;

    class categoriesAnimalService {
        //select animal category by id
        public function SelectOne($criteria){
            $category = categoriesAnimal::Find($criteria);
            return $category;
        }

        //select all animal categories
        public function listAll(){
            $List = categoriesAnimal::all();
            return $List;
        }
    
        public function ValadateAdd($request){
            return $request->validate([
                'name' => ['required']
            ]);
        }

        //update database: add new animal categories
        public function post_add($request){
            $category = new categoriesAnimal();
            $category->name = $request->name;
            $category->save();
        }
    
        //update database: edit animal categories
        public function post_edit($request){
            $category = categoriesAnimal::Find($request->id_category);
            $category->name = $request->name;
            $category->save();
        }
    
        //update database: delete animal categories
        public function post_delete($request){
            $category = categoriesAnimal::Find($request->id_category)->delete();
        }

        //search animal categories
        public function search($request){
            $search = $request->search;
            $categories = categoriesAnimal::where('name', 'like', '%'.$search.'%')->get();
            return $categories;
        }
    }
?>