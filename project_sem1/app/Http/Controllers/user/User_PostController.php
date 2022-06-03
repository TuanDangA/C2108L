<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\user\User_PostService as Service;
use App\Http\Service\management\AccountService as Service_Account;

class User_PostController extends Controller
{
    public $service;
    public $Serv_Account;
    public function __construct(Service $serv,Service_Account $Service_Account){
        $this->service = $serv;
        $this->Serv_Account = $Service_Account; 
    }

    //list all posts(news)
    public function listAll($confirmation_code){
        $PostList = $this->service->listAllPost();
        $backgroundname = $this->service->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $categories = $this->service->listAllCategories();
        return view('user.post.post-guide',[
            'PostList'=>$PostList,
            'backgroundname'=>$backgroundname,
            'accounts'=>$accounts,
            'count'=>count($PostList),
            'categories'=>$categories,
            'old_id_category_post'=>null
        ]);
    }

    //search posts(news)
    public function search($confirmation_code,Request $request){
        if(is_null($request->id_category_post)){
            return redirect()->route('user_post_list',['confirmation_code'=>$confirmation_code]);
        }
        else{
            $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
            $PostList = $this->service->search($request);
            $backgroundname = $this->service->GetRandomBackground();
            $categories = $this->service->listAllCategories();
            return view('user.post.post-guide',[
                'PostList'=>$PostList,
                'categories'=>$categories,
                'old_id_category_post'=>$request->id_category_post,
                'accounts'=>$accounts,
                'count'=>count($PostList),
                'backgroundname'=>$backgroundname,
            ]);
        }
    }

    //send posts details to new page
    public function showDetails($confirmation_code,$hrefParam){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $post = $this->service->select_post_from_hrefParam($hrefParam);
        $related_posts = $this->service->getRelatedPosts($post->id_author);
        $category = $this->service->GetCategory($post->id_category_post);
        return view('user.post.post-detail',[
            'post'=>$post,
            'category'=>$category,
            'accounts'=>$accounts,
            'related_posts'=>$related_posts
        ]);
    }
}
