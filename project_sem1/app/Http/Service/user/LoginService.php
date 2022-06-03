<?php
    namespace App\Http\Service\user;

    session_start();

    use Illuminate\Support\Facades\Hash;
    use App\Models\management\account;
    
    class LoginService
    {
        public function validate($dataForm)
        {
            return $dataForm->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string']
            ]);
        }

        public function login(array $dataForm)
        {
            $accounts = Account::where('email', $dataForm['email'])->first();

            $checkVerify = Account::where('confirmed', 1)
                                    ->where('email', $dataForm['email'])
                                    ->first();

            $checkPwd = null;
            if ($accounts) {
                $checkPwd = Hash::check($dataForm['password'], $accounts->password);
            }

            if($accounts && isset($checkPwd) && $checkPwd){
                $token = md5($accounts['email'].time());
                
                if(isset($dataForm['token'])){
                    $_SESSION['token'] = $token;
    
                    setcookie('token', $token, time()+ 7*24*60*60, '/');
                } else {
                    $_SESSION['token'] = $token;
                }

                $setToken = Account::find($accounts['id']);
                $setToken->token = $token;
                $setToken->save();
            }

            return [
                'accounts' => $accounts,
                'checkVerify' => $checkVerify,
                'checkPwd' => $checkPwd
            ];
        }
    }