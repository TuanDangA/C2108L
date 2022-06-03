<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\management\RangeService as Service;
use App\Http\Service\management\AccountService as Service_Account;

class RangeController extends Controller
{
    public $service;
    public $Serv_Account;
    public function __construct(Service $serv,Service_Account $Service_Account){
        $this->service = $serv;
        $this->Serv_Account = $Service_Account;
    }

    //add ranges
    public function add($confirmation_code){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        return view('management.range.add',[
            'accounts'=>$accounts
        ]);
    }

    //edit ranges
    public function edit($confirmation_code,$id_range){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $range = $this->service->SelectOne($id_range);
        return view('management.range.edit',[
            'range'=>$range,
            'accounts'=>$accounts
        ]);
    }

    //delete ranges
    public function delete($confirmation_code,$id_range){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $range = $this->service->SelectOne($id_range);
        return view('management.range.delete',[
            'range'=>$range,
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
                    return redirect()->route('admin_range_list',['confirmation_code'=>$confirmation_code]);           
                }
                case 'edit':{
                    $this->service->ValadateAdd($request);
                    $this->service->post_edit($request);
                    return redirect()->route('admin_range_list',['confirmation_code'=>$confirmation_code]);           
                }
                case 'delete':{
                    $this->service->post_delete($request);
                    return redirect()->route('admin_range_list',['confirmation_code'=>$confirmation_code]);           
                }
            }
    }

    //list all ranges
    public function list($confirmation_code){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $rangeList = $this->service->listAll();
        $index = 0;
        return view('management.range.list',[
            'rangeList'=>$rangeList,
            'index'=>$index,
            'accounts'=>$accounts,
            'count'=>count($rangeList)
        ]);
    }

    //search ranges
    public function search($confirmation_code,Request $request){
        if(is_null($request->search)){
            return redirect()->route('admin_range_list',['confirmation_code'=>$confirmation_code]);           
        }
        else{
            $rangeList = $this->service->search($request);
        }
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $index = 0;
        return view('management.range.list',[
            'rangeList'=>$rangeList,
            'index'=>$index,
            'accounts'=>$accounts,
            'search'=>$request->search,
            'count'=>count($rangeList)
        ]);
    } 
}
