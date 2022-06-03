<?php
    namespace App\Http\Service\management;
    use App\Models\management\categoriesPost;

    class categoriesPostService {
        //select post category from id
        public function SelectOne($id){
            $category = categoriesPost::Find($id);
            return $category;
        }

        //select all post categories
        public function listAll(){
            $List = categoriesPost::all();
            return $List;
        }

        public function ValadateAdd($request){
            return $request->validate([
                'name' => ['required'],
            ]);
        }

        //update database: add new post categories
        public function post_add($request){
            $categoryPost = new categoriesPost();
            $categoryPost->name = $request->name;
            $categoryPost->save();
        }
    
        //update database: edit post categories
        public function post_edit($request){
            $categoryPost = categoriesPost::Find($request->id_category);
            $categoryPost->name = $request->name;
            $categoryPost->save();
        }
    
        //update database: delete post categories
        public function post_delete($request){
            $categoryPost = categoriesPost::Find($request->id_category)->delete();
        }

        //search post categories
        public function search($request){
            $search = $request->search;
            $categoryPost = categoriesPost::where('name', 'like', '%'.$search.'%')->get();
            return $categoryPost;
        }
    }
?>