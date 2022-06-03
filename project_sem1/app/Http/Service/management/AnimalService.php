<?php
    namespace App\Http\Service\management;
    use App\Models\management\Animal;
    use App\Models\management\categoriesAnimal;
    use App\Models\management\range;

    class AnimalService{
        //select animal category by id_category
        public function GetSpecies($id){
            $species = categoriesAnimal::Find($id);
            return $species;
        }

        //select animal range by id_range
        public function GetRange($id){
            $range = range::Find($id);
            return $range;
        }

        //select animals of a category by category_id
        public function Select_animal_by_category($id){
            $animalList = Animal::join('ranges','Animal.id_range','=','ranges.id')
            ->join('categories_animal','Animal.id_category','=','categories_animal.id')
            ->select('Animal.*','ranges.name as range','categories_animal.name as category_name')
            ->where('Animal.id_category',$id)
            ->get();
            return $animalList;
        }

        //select animal by id
        public function GetAnimal($id){
            $animal = Animal::Find($id);
            return $animal;
        }

        public function ValadateAdd($request){
            return $request->validate([
                'shortThumbnail' => ['required'],
                'longThumbnail' => ['required'],
                'normal_name' => ['required'],
                'scientific_name' => ['required'],
                'id_category' => ['required'],
                'habitat' => ['required'],
                'overview' => ['required'],
                'id_range' => ['required'],
                'diet' => ['required'],
                'size' => ['required'],
                'population_status' => ['required'],
            ]);
        }

        //update database: add new animal
        public function post_add($request){
            $animal = new Animal();
            $shortThumbnail = time().$request->file('shortThumbnail')->getClientOriginalName();
            $longThumbnail = time().$request->file('longThumbnail')->getClientOriginalName();
            $animal->normal_name = $request->normal_name;
            $animal->scientific_name = $request->scientific_name;
            $animal->id_category= $request->id_category;
            $animal->habitat= $request->habitat;
            $animal->overview = $request->overview;
            $animal->id_range = $request->id_range;
            $animal->shortThumbnail = $shortThumbnail;
            $animal->longThumbnail = $longThumbnail;
            $animal->diet = $request->diet;
            $animal->size = $request->size;
            $animal->population_status = $request->population_status;
            $animal->hrefParam = $this->exportParam($request->normal_name);
            $request->file('shortThumbnail')->storeAs('public/images/animal/shortThumbnail/',$shortThumbnail);
            $request->file('longThumbnail')->storeAs('public/images/animal/longThumbnail/',$longThumbnail);
            $animal->save();
        }
    
        //update database: edit animals
        public function post_edit($request){
            $animal = Animal::Find($request->id);   
            if(isset($request->shortThumbnail)){ 
                $file = $request->file('shortThumbnail');
                $shortThumbnail = time().$file->getClientOriginalName();
                $path_short = public_path().'/storage/images/animal/shortThumbnail/';
                //code for remove old file
                if($animal->shortThumbnail != ''  && $animal->shortThumbnail != null){
                    $file_old = $path_short.$animal->shortThumbnail;
                    unlink($file_old);
                }
        
                //upload new file
                $file->move($path_short, $shortThumbnail);

                //update image file name in table
                $animal->shortThumbnail = $shortThumbnail;
            }
            if(isset($request->longThumbnail)){ 
                $file = $request->file('longThumbnail');
                $img_name = time().$file->getClientOriginalName();
                $path = public_path().'/storage/images/animal/longThumbnail/';
                //code for remove old file
                if($animal->longThumbnail != ''  && $animal->longThumbnail != null){
                    $file_old = $path.$animal->longThumbnail;
                    unlink($file_old);
                }
        
                //upload new file
                $file->move($path, $img_name);

                //update image file name in table
                $animal->longThumbnail = $img_name;
            }
            //update other information in table
            $animal->normal_name = $request->normal_name;
            $animal->scientific_name = $request->scientific_name;
            $animal->habitat= $request->habitat;
            $animal->overview = $request->overview;
            $animal->id_range = $request->id_range;
            $animal->diet = $request->diet;
            $animal->size = $request->size;
            $animal->population_status = $request->population_status;
            $animal->hrefParam = $this->exportParam($request->normal_name);
            $animal->save();
        }
    
        //update database: delete animals
        public function post_delete($request){
            $path1 = public_path().'/storage/images/animal/shortThumbnail/';
            $path2 = public_path().'/storage/images/animal/longThumbnail/';
            $animal = Animal::Find($request->id);
            if($animal->shortThumbnail != ''  && $animal->shortThumbnail != null){
                $file_old = $path1.$animal->shortThumbnail;
                unlink($file_old);
            }
            if($animal->longThumbnail != ''  && $animal->longThumbnail != null){
                $file_old = $path2.$animal->longThumbnail;
                unlink($file_old);
            }
            $animal->delete();
        }

        //search animals
        public function search($request){
            $id_category = $request->id_category;
            $search = $request->search;
                $animals = Animal::join('categories_animal', 'categories_animal.id', '=', 'animal.id_category')
                ->join('ranges', 'ranges.id', '=', 'animal.id_range')
                ->select('animal.*','categories_animal.name as category_name','ranges.name as range')
                ->where('animal.id_category', '=',$id_category)
                ->where('animal.normal_name', 'like', '%'.$search.'%')
                ->orWhere('animal.scientific_name', 'like', '%'.$search.'%')
                ->orWhere('animal.habitat', 'like', '%'.$search.'%')
                ->orWhere('animal.overview', 'like', '%'.$search.'%')
                ->orWhere('animal.diet', 'like', '%'.$search.'%')
                ->orWhere('animal.size', 'like', '%'.$search.'%')
                ->orWhere('categories_animal.name', 'like', '%'.$search.'%')
                ->orWhere('ranges.name', 'like', '%'.$search.'%')
                ->orWhere('animal.population_status', 'like', '%'.$search.'%')
                ->get();
            return $animals;
        }

        //eport hrefParam based on animal name automatically
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

        //get all ranges
        public function getRangeList(){
            $ranges = range::get();
            return $ranges;
        }
    }
?>