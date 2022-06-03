<?php

namespace App\Http\Controllers\user;
session_start();

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout()
    {
        if(isset($_SESSION['token'])){
            unset($_SESSION['token']);
        }

        if(isset($_COOKIE['token'])){
            setcookie('token', '', time() -(7*24*60*60), '/');
        }

        return redirect(route('home',['confirmation_code'=>"guest"]));
    }
}
