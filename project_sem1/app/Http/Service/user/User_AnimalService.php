<?php
    namespace App\Http\Service\user;
    use Illuminate\Http\Request;
    use App\Models\management\Animal;
    use App\Models\management\categoriesAnimal;
    use App\Models\management\range;
    use App\Models\rand_background;

    class User_AnimalService{
        //filter animals according to their category and range
        public function search($request){
            if(!is_null($request->id_category) && !is_null($request->id_range)){
                $animalList = Animal::where('id_category',$request->id_category)->where('id_range','=',$request->id_range)->get();
            }
            elseif(!is_null($request->id_category) && is_null($request->id_range)){
                $animalList = Animal::where('id_category',$request->id_category)->get();
            }
            elseif(!is_null($request->id_range) && is_null($request->id_category)){
                $animalList = Animal::where('id_range',$request->id_range)->get();
            }
            return $animalList;
        }

        //select all animals
        public function listAllAnimal(){
            $animalList = Animal::get();
            return $animalList;
        }

        //select all ranges
        public function listAllRanges(){
            $ranges = range::get();
            return $ranges;
        }

        //select all animal categories
        public function listAllCategories(){
            $categoriesList = categoriesAnimal::get();
            return $categoriesList; 
        }

        //select animal by hrefParam
        public function select_animal_from_hrefParam($hrefParam){
            $animal = Animal::where('hrefParam',$hrefParam)->first();
            return $animal;
        }

        //select animal category by animals'id_category
        public function GetCategory($id){
            $category = categoriesAnimal::where('id',$id)->first();
            return $category;
        }

        //select range by id
        public function GetRange($id){
            $range = range::where('id',$id)->first();
            return $range;
        }

        //get the first and last background in the database
        public function GetBackgroundQuantity(){
            $quantity = [];
            $backgrounds = rand_background::get();
            foreach($backgrounds as $background){
                $quantity[]= $background->id;
            }
            return array($quantity[0],array_pop($quantity));
        }

        //select animals from the same range as the given one
        public function getRelatedAnimals($id_range){
            $animalList = Animal::where('id_range','=',$id_range)->get();
            return $animalList;
        }

        //select a random background
        public function GetRandomBackground(){
            list($min,$quantity) = $this->GetBackgroundQuantity();
            while(1){
                $id = rand($min,$quantity);
                $background = rand_background::Find($id);
                if(!is_null($background)){
                    break;
                }
            } 
            return $background->name;
        }

        //search for animals according to keywords specified in $request->search variable
        public function search_general($request){
            $search = $request->search;
            $animalList = Animal::join('categories_animal', 'categories_animal.id', '=', 'animal.id_category')
            ->join('ranges', 'ranges.id', '=', 'animal.id_range')
            ->select('animal.*','categories_animal.name as category_name','ranges.name as range')
            ->where('animal.normal_name','like', '%'.$search.'%')
            ->orWhere('animal.scientific_name','like', '%'.$search.'%')
            ->orWhere('animal.hrefParam','like', '%'.$search.'%')
            ->orWhere('animal.population_status','like', '%'.$search.'%')
            ->get();
            return $animalList;
        }
    }