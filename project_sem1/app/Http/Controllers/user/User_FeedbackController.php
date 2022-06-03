<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\user\User_FeedbackService as Service;

class User_FeedbackController extends Controller
{
    public $service;
    public function __construct(Service $serv){
        $this->service = $serv;
    }

    //add feedbacks
    public function add($confirmation_code){
        $categoriesList = $this->service->SelectAllCategories();
        $accounts = $this->service->Select_Account_code($confirmation_code);
        return view('user.home.feedback.add',[
            'categoriesList'=>$categoriesList,
            'accounts'=>$accounts,
        ]);
    }

    //update database
    public function post($confirmation_code,Request $request){
        $action = $request->action;
        switch($action){
            case 'add':{
                $this->service->post_add($request);
                return redirect()->route('home',['confirmation_code'=>$confirmation_code]);           
            }
        }
    }
}
