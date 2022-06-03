<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\Rand_BackgroundService as Service;
use App\Http\Service\management\AccountService as Service_Account;

class RandBackgroundController extends Controller
{    
    public $service;
    public $Serv_Account;
    public function __construct(Service $serv,Service_Account $Service_Account){
        $this->service = $serv;
        $this->Serv_Account = $Service_Account;
    }

    //add random backgrounds
    public function add($confirmation_code){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        return view('management.Rand_Background.add',[
            'accounts'=>$accounts
        ]);
    }

    //edit random backgrounds
    public function edit($confirmation_code,$id_background){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $background = $this->service->GetBackgroundName($id_background);
        return view('management.Rand_Background.edit',[
            'background'=>$background,
            'accounts'=>$accounts
        ]);
    }

    //delete random backgrounds
    public function delete($confirmation_code,$id_background){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $background = $this->service->GetBackgroundName($id_background);
        return view('management.Rand_Background.delete',[
            'background'=>$background,
            'accounts'=>$accounts
        ]);
    }

    //upadte database according to "action" (edit/add/delete)
    public function post($confirmation_code,Request $request){
        $action = $request->action;
        switch($action){
            case 'add':{
                $this->service->ValadateAdd($request);
                $this->service->post_add($request);
                return redirect()->route('admin_rand_backgrounds_list',['confirmation_code'=>$confirmation_code]);      
            }
            case 'edit':{
                $this->service->post_edit($request);
                return redirect()->route('admin_rand_backgrounds_list',['confirmation_code'=>$confirmation_code]);      
            }
            case 'delete':{
                $this->service->post_delete($request);  
                return redirect()->route('admin_rand_backgrounds_list',['confirmation_code'=>$confirmation_code]);      
            }
        }
    }

    //list all random backgrounds
    public function list($confirmation_code){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $backgroundList = $this->service->GetBackGrounds();
        $index = 0;
        return view('management.Rand_Background.list',[
            'backgroundList'=>$backgroundList,
            'index'=>$index,
            'accounts'=>$accounts,
            'count'=>count($backgroundList)
        ]);
    }

    //search random backgrounds
    public function search($confirmation_code,Request $request){
        if(is_null($request->search)){
            return redirect()->route('admin_rand_backgrounds_list',['confirmation_code'=>$confirmation_code]);      
        }
        else{
            $backgroundList = $this->service->search($request);
        }
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $index = 0;
        return view('management.Rand_Background.list',[
            'backgroundList'=>$backgroundList,
            'index'=>$index,
            'accounts'=>$accounts,
            'search'=>$request->search,
            'count'=>count($backgroundList)
        ]);
    } 
}
