<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\management\AuthorService as Service;
use App\Http\Service\management\AccountService as Service_Account;

class AuthorController extends Controller
{
    public $service;
    public $Serv_Account;
    public function __construct(Service $serv,Service_Account $Service_Account){
        $this->service = $serv;
        $this->Serv_Account = $Service_Account;
    }

    //add authors
    public function add($confirmation_code){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        return view('management.author.add',[
            'accounts'=>$accounts
        ]);
    }

    //edit authors
    public function edit($confirmation_code,$id_author){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $author = $this->service->SelectOne($id_author);
        return view('management.author.edit',[
            'author'=>$author,
            'accounts'=>$accounts
        ]);
    }

    //confirm delete authors
    public function delete($confirmation_code,$id_author){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $author = $this->service->SelectOne($id_author);
        return view('management.author.delete',[
            'author'=>$author,
            'accounts'=>$accounts
        ]);
    }

    //upadte database according to "action" (edit/add/delete)
    public function post($confirmation_code,Request $request){
        $action = $request->action;
            switch($action){
                case 'add':{
                    $this->service->validateAdd($request);
                    $this->service->post_add($request);
                    return redirect()->route('admin_author_list',['confirmation_code'=>$confirmation_code]);           
                }
                case 'edit':{
                    $this->service->validateAdd($request);
                    $this->service->post_edit($request);
                    return redirect()->route('admin_author_list',['confirmation_code'=>$confirmation_code]);           
                }
                case 'delete':{
                    $this->service->post_delete($request);
                    return redirect()->route('admin_author_list',['confirmation_code'=>$confirmation_code]);           
                }
            }
    }

    //list all authors
    public function list($confirmation_code){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $authorList = $this->service->listAll();
        $index = 0;
        return view('management.author.list',[
            'authorList'=>$authorList,
            'index'=>$index,
            'accounts'=>$accounts,
            'count'=>count($authorList)
        ]);
    }

    //search authors
    public function search($confirmation_code,Request $request){
        if(is_null($request->search)){
            return redirect()->route('admin_author_list',['confirmation_code'=>$confirmation_code]);           
        }
        else{
            $authorList = $this->service->search($request);
        }
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $index = 0;
        return view('management.author.list',[
            'authorList'=>$authorList,
            'index'=>$index,
            'accounts'=>$accounts,
            'search'=> $request->search,
            'count'=>count($authorList)
        ]);
    } 
}
