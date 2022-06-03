<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\management\PostService as Service;
use App\Http\Service\management\AccountService as Service_Account;

class PostController extends Controller
{
    public $service;
    public $Serv_Account;
    public function __construct(Service $serv,Service_Account $Service_Account){
        $this->service = $serv;
        $this->Serv_Account = $Service_Account;
    }

    //add post(news)
    public function add($confirmation_code,$id_category){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $category = $this->service->GetPostCategory($id_category);
        $authorList = $this->service->GetAuthorList();        
        return view('management.post.add',[
            'id_category'=>$category->id,
            'category'=>$category,
            'accounts'=>$accounts,
            'authorList'=>$authorList
        ]);
    }

    //edit post(news)
    public function edit($confirmation_code,$id_post){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $post = $this->service->GetPost($id_post);
        $category = $this->service->GetPostCategory($post->id_category_post);
        $author = $this->service->GetAuthor($post->id_author);
        $authorList = $this->service->GetAuthorList();        
        return view('management.post.edit',[
            'post'=>$post,
            'category'=>$category,
            'accounts'=>$accounts,
            'old_author'=>$author,
            'authorList'=>$authorList
        ]);
    }

    //delete post(news)
    public function delete($confirmation_code,$id_post){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $post = $this->service->GetPost($id_post);
        $category = $this->service->GetPostCategory($post->id_category_post);
        $author = $this->service->GetAuthor($post->id_author);
        return view('management.post.delete',[
            'post'=>$post,
            'category'=>$category,
            'accounts'=>$accounts,
            'old_author'=>$author,
        ]);
    }

    //upadte database according to "action" (edit/add/delete)
    public function post($confirmation_code,Request $request){
        $action = $request->action;
        switch($action){
            case 'add':{
                $this->service->ValadateAdd($request);
                $this->service->post_add($request);
                return redirect()->route('admin_post_list',['id_category'=>$request->id_category_post,'confirmation_code'=>$confirmation_code]);
            }
            case 'edit':{
                $this->service->post_edit($request);
                return redirect()->route('admin_post_list',['id_category'=>$request->id_category_post,'confirmation_code'=>$confirmation_code]);          
            }
            case 'delete':{
                $this->service->post_delete($request);
                return redirect()->route('admin_post_list',['id_category'=>$request->id_category_post,'confirmation_code'=>$confirmation_code]);
            }
        }
    }

    //list all posts of a category
    public function list($confirmation_code,$id_category){
        $category = $this->service->GetPostCategory($id_category);
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $postList = $this->service->Select_post_by_category($id_category);
        $index = 0;
        return view('management.post.list2',[
            'postList'=>$postList,
            'index'=>$index,
            'id_category'=>$id_category,
            'category'=>$category,
            'accounts'=>$accounts,
            'count'=>count($postList)
        ]);
    }

    //search posts of a category
    public function search($confirmation_code,Request $request){
        if(is_null($request->search)){
            return redirect()->route('admin_post_list',['id_category'=>$request->id_category,'confirmation_code'=>$confirmation_code]);
        }
        else{
            $postList = $this->service->search($request);
        }
        $category = $this->service->GetPostCategory($request->id_category);
        $index = 0;
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        return view('management.post.list2',[
            'postList'=>$postList,
            'index'=>$index,
            'id_category'=>$request->id_category,
            'category'=>$category,
            'accounts'=>$accounts,
            'search'=>$request->search,
            'count'=>count($postList)
        ]);
    }   
}
