<?php
    namespace App\Http\Service;

    use App\Models\management\account;

    class HomeService
    {
        public function home()
        {
            if(isset($_SESSION['token'])){
                $accounts = Account::where('token', $_SESSION['token'])->first();

                return $accounts;
            } elseif (isset($_COOKIE['token'])){
                $accounts = Account::where('token', $_COOKIE['token'])->first();

                return $accounts;
            }
        }
    }