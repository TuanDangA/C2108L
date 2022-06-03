<?php
    namespace App\Http\Service\user;

    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Str;
    use App\Models\management\account;

    class ForgotPasswordService
    {
        public function confirmEmail($dataForm)
        {
            $users = account::where('email', $dataForm)
                                ->where('confirmed', 1)
                                ->first();

            $confirmation_code = Str::random(32);

            if($users != null){
                Mail::send('user.verify_forgot_password', ['confirmation_code'=>$confirmation_code], function($msg) use ($users) {
                    $msg->to($users['email'], $users['fullname'])
                        ->subject('Verify Account To Reset Your Password');
                });

                $users->confirmation_code = $confirmation_code;
                $users->save();

                return $status = 'Please check your email and click the link to reset password!';
            }
        }

        public function verify($code)
        {
            $users = account::where('confirmation_code', $code)->first();

            if($users != null){
                $users->confirmation_code = null;
                $users->save();

                $status = 'You have successfully verified! Now set your new password.';
            }

            return [
                'email' => $users->email,
                'status' => $status
            ];
        }

        public function validate($dataForm)
        {
            return $dataForm->validate([
                'email' => ['required', 'string', 'email', 'max:255']
            ]);
        }

        public function validatePwd($dataForm)
        {
            return $dataForm->validate([
                'password' => ['required', 'string', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/']
            ]);
        }

        public function save(array $dataForm)
        {
            $users = account::where('email', $dataForm['email']);

            $users->update(['password' => Hash::make($dataForm['password'])]);
        }
    }