<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Service\user\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public $loginService;

    //Create a new instance of LoginService in controller
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    //return to login page
    public function showLogin()
    {
        $accounts = null;
        return view('user.login',[
            'accounts'=>$accounts
        ]);
    }

    public function login(Request $request)
    {
        $this->loginService->validate($request);

        $accounts = $this->loginService->login($request->all());

        if($accounts['accounts'] && $accounts['checkPwd'] && $accounts['checkVerify'])
        {
            return redirect(route('home',['confirmation_code'=>$accounts['accounts']->confirmation_code]));
            // array('accounts' => $accounts['accounts'])
        } elseif (!$accounts['accounts'] || !$accounts['checkPwd']) 
        {
            return redirect(route('login-page'))->with('msg', 'Wrong email or password. Please try again!');
        } elseif ($accounts['accounts'] && $accounts['checkPwd'] && !$accounts['checkVerify']) 
        {
            return redirect(route('login-page'))->with('msg', 'You have not verified your account. Please verify email!');
        }
    }
}
