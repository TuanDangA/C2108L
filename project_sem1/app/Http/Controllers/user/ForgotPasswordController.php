<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Service\user\ForgotPasswordService;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public $forgotPasswordService;

    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    public function showForgotPwd()
    {
        $accounts = null;
        return view('user.forgot_password',[
            'accounts'=>$accounts
        ]);
    }

    public function confirmEmail(Request $request)
    {   
        $this->forgotPasswordService->validate($request);

        $status = $this->forgotPasswordService->confirmEmail($request->email);

        if($status){
            return redirect(route('forgot-password-page'))->with('status', $status);
        } else {
            $status = 'Your email have not been registered or verified. Please try again!';

            return redirect(route('forgot-password-page'))->with('msg', $status);
        }
    }

    public function verify(Request $request)
    {   
        $status = $this->forgotPasswordService->verify($request->code);

        return redirect(route('forgot-password-page'))->with([
            'confirm'=> $status['status'],
            'email'=> $status['email'],
            'status'=>"done"
        ]);
    }

    public function resetPwd(Request $request)
    {
        $this->forgotPasswordService->validatePwd($request);

        $this->forgotPasswordService->save($request->all());

        return redirect(route('login-page'))->with('message', 'Password has been reset successfully!');
    }
}
