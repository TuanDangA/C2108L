<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use App\Http\Service\Rand_BackgroundService as Service_Rand_Background;
use App\Http\Service\management\AccountService as Service_Account;

class home_adminController extends Controller
{
    public $Serv_Rand_Background;
    public $Serv_Account;

    public function __construct(Service_Rand_Background $Service_Rand_Background,Service_Account $Service_Account){
        $this->Serv_Rand_Background = $Service_Rand_Background;
        $this->Serv_Account = $Service_Account;
    }

    //return home_Admin page
    public function home_admin($confirmation_code){
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        
        return view('management.home_admin.home_admin',[
            'backgroundname'=>$backgroundname,
            'accounts'=>$accounts
        ]);
    }
}
