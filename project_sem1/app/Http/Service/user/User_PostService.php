<?php
    namespace App\Http\Service\user;
    use App\Models\management\Post;
    use App\Models\management\categoriesPost;
    use App\Models\rand_background;

    class User_PostService{
        //select all posts
        public function listAllPost(){
            $postList = Post::join('authors', 'posts.id_author', '=', 'authors.id')
            ->join('categories_post', 'posts.id_category_post', '=', 'categories_post.id')
            ->select('posts.*', 'authors.name as author_name','categories_post.name as category_name')
            ->orderBy('updated_at','desc')
            ->simplepaginate(6);
            return $postList;
        }

        //select all post to pass into home
        public function listAllPost_Home(){
            $postList = Post::join('authors', 'posts.id_author', '=', 'authors.id')
            ->join('categories_post', 'posts.id_category_post', '=', 'categories_post.id')
            ->select('posts.*', 'authors.name as author_name','categories_post.name as category_name')
            ->orderBy('updated_at','desc')
            ->get();
            return $postList;
        }

        //select post by hrefParam
        public function select_post_from_hrefParam($hrefParam){
            $post = Post::join('authors', 'posts.id_author', '=', 'authors.id')
            ->select('posts.*', 'authors.name as author_name')
            ->where('hrefParam','=',$hrefParam)
            ->first();
            return $post;
        }

        //select post category by id
        public function GetCategory($id){
            $category = categoriesPost::where('id',$id)->first();
            return $category;
        }

        //select all post categories
        public function listAllCategories(){
            $categoriesList = categoriesPost::get();
            return $categoriesList; 
        }

        //search posts
        public function search($request){
            $postList = Post::join('authors', 'posts.id_author', '=', 'authors.id')
            ->join('categories_post', 'posts.id_category_post', '=', 'categories_post.id')
            ->select('posts.*', 'authors.name as author_name','categories_post.name as category_name')
            ->where('id_category_post',$request->id_category_post)
            ->orderBy('updated_at','desc')->simplepaginate(6);
            return $postList;
        }

        //select first and last backgrounds in the rand_backgrounds table
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
                $background = rand_background::Find($id);
                if(!is_null($background)){
                    break;
                }
            } 
            return $background->name;
        }

        //search keywords in animals, events and posts. 
        public function search_general($request){
            $search = $request->search;
            $postList = Post::join('categories_post', 'categories_post.id', '=', 'posts.id_category_post')
            ->join('authors','authors.id','=','posts.id_author')
            ->select('posts.*','categories_post.name as category_name','authors.name as author_name')
            ->where('posts.title','like', '%'.$search.'%')
            ->orWhere('posts.description','like', '%'.$search.'%')
            ->get();
            return $postList;
        }

        //get posts from the same author as the given one
        public function getRelatedPosts($id_author){
            $postList = Post::where('id_author','=',$id_author)->get();
            return $postList;
        }
    }
?>