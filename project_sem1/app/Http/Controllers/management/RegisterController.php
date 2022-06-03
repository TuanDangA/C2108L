<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\user\RegisterService;

class RegisterController extends Controller
{
    public $registerService;

    //Create a new instance of LoginService in controller
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function showRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $this->registerService->validate($request);

        $this->registerService->save($request->all());

        return redirect(route('login-page'))->with('status', 'Please verify email!');
    }

    public function verify(Request $request)
    {
        $status = $this->registerService->verify($request->code);

        return redirect(route('login-page'))->with('status', $status);
    }
}
