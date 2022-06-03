<?php
    namespace App\Http\Service\management;
    use App\Models\management\Post;
    use App\Models\management\categoriesPost;
    use App\Models\management\author;

    
    class PostService{
        //select all authors
        public function GetAuthorList(){
            $authorList = author::get();
            return $authorList;
        }

        //select authors by id
        public function GetAuthor($id){
            $author = author::Find($id);
            return $author;
        }

        //select post categories by id
        public function GetPostCategory($id){
            //find post's category
            $Postcategory = categoriesPost::find($id);;
            return $Postcategory;
        }

        //select posts of a category
        public function Select_post_by_category($id){
            //find posts in the same category
            $postList = Post::join('authors', 'authors.id', '=', 'posts.id_author')
            ->join('categories_post', 'posts.id_category_post', '=', 'categories_post.id')
            ->select('posts.*', 'authors.name as author_name','categories_post.name as category_name')
            ->where('posts.id_category_post','=',$id)
            ->get();
            return $postList;
        }

        //select posts by id
        public function GetPost($id){
            //find row
            $post = Post::Find($id);
            return $post;
        }

        public function ValadateAdd($request){
            return $request->validate([
                'title' => ['required'],
                'shortThumbnail' => ['required'],
                'longThumbnail' => ['required'],
                'description' => ['required'],
                'id_category_post' => ['required'],
                'id_author' => ['required'],
                'content' => ['required']
            ]);
        }

        //update database: add post
        public function post_add($request){
            $post = new Post();

            //get the image files'name
            $shortThumbnail = time().$request->file('shortThumbnail')->getClientOriginalName();
            $longThumbnail = time().$request->file('longThumbnail')->getClientOriginalName();

            //insert data into new row
            $post->title = $request->title;
            $post->description = $request->description;
            $post->id_category_post= $request->id_category_post;
            $post->id_author = $request->id_author;
            $post->content = $request->content;
            $post->shortThumbnail = $shortThumbnail;
            $post->longThumbnail = $longThumbnail;
            $post->hrefParam = $this->exportParam($request->title);

            //save new image files into public
            $request->file('shortThumbnail')->storeAs('public/images/post/shortThumbnail/',$shortThumbnail);
            $request->file('longThumbnail')->storeAs('public/images/post/longThumbnail/',$longThumbnail);
            $post->save();
        }
    
        //update database: edit posts
        public function post_edit($request){
            $post = Post::find($request->id);

            //edit shortThumbnail
            if(isset($request->shortThumbnail)){    
                $file = $request->file('shortThumbnail');
                $shortThumbnail = time().$file->getClientOriginalName();
                $path_short = public_path().'/storage/images/post/shortThumbnail/';
                //code for remove old image file
                if($post->shortThumbnail != ''  && $post->shortThumbnail != null){
                    $file_old = $path_short.$post->shortThumbnail;
                    unlink($file_old);
                }

                //upload new image file    
                $file->move($path_short, $shortThumbnail);
                
                //update image file name in table
                $post->shortThumbnail = $shortThumbnail;
            }

            //edit longThumbnail
            if(isset($request->longThumbnail)){ 
                $file = $request->file('longThumbnail');
                $longThumbnail = time().$file->getClientOriginalName();
                $path = public_path().'/storage/images/post/longThumbnail/';
                //code for remove old file
                if($post->longThumbnail != ''  && $post->longThumbnail != null){
                    $file_old = $path.$post->longThumbnail;
                    unlink($file_old);
                }
        
                //upload new file
                $file->move($path, $longThumbnail);

                //update image file name in table
                $post->longThumbnail = $longThumbnail;
            }

            //update other information in table
            $post->title = $request->title;
            $post->description = $request->description;
            $post->id_author = $request->id_author;
            $post->content = $request->content;
            $post->hrefParam = $this->exportParam($request->title);
            $post->save();
        }
        
        //update database: delete posts
        public function post_delete($request){
            $path1 = public_path().'/storage/images/post/shortThumbnail/';
            $path2 = public_path().'/storage/images/post/longThumbnail/';
            
            //find the row
            $post = Post::Find($request->id);

            //delete image file before delete row
            if($post->shortThumbnail != ''  && $post->shortThumbnail != null){
                $file_old = $path1.$post->shortThumbnail;
                unlink($file_old);
            }
            if($post->longThumbnail != ''  && $post->longThumbnail != null){
                $file_old = $path2.$post->longThumbnail;
                unlink($file_old);
            }

            //delete row
            $post->delete();
        }

        //search posts
        public function search($request){
            $id_category = $request->id_category;
            $search = $request->search;
            $postList = Post::join('categories_post', 'categories_post.id', '=', 'posts.id_category_post')
                            ->join('authors', 'authors.id', '=', 'posts.id_author')
                            ->select('posts.*','categories_post.name as category_name','authors.name as author_name')
                            ->where('posts.id_category_post', '=',$id_category)
                            ->where('posts.title', 'like', '%'.$search.'%')
                            ->orWhere('posts.description', 'like', '%'.$search.'%')
                            ->orWhere('authors.name', 'like', '%'.$search.'%')
                            ->orWhere('posts.content', 'like', '%'.$search.'%')
                            ->get();
            return $postList;
        }

        //return hrefParam based on posts title automatically
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
?>