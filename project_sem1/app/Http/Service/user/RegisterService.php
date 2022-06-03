<?php
    namespace App\Http\Service\user;

    use Illuminate\Support\Facades\Hash;
    use App\Models\management\account;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Str;

    class RegisterService
    {
        public function validate($dataForm)
        {
            return $dataForm->validate([
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:accounts'],
                'password' => ['required', 'string', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/']
            ]);
        }

        //save data to database
        public function save(array $dataForm)
        {
            //Get rule id from rule_account table
            $id_rule = Account::rightJoin('rule_account', 'rule_account.id', '=', 'accounts.id_rule_user')
                                ->where('rule_account.name', 'user')
                                ->first('rule_account.id');

            $users = new Account();

            $confirmation_code = Str::random(32);

            //save data to database
            $users->fullname = $dataForm['fullname'];
            $users->email = $dataForm['email'];
            $users->id_rule_user = $id_rule->id;
            $users->password = Hash::make($dataForm['password']);
            $users->confirmation_code = $confirmation_code;
            
            $users->save();

            Mail::send('user.verify_email', ['confirmation_code'=>$confirmation_code], function($msg) use ($dataForm) {
                $msg->to($dataForm['email'], $dataForm['fullname'])
                    ->subject('Verify your email address');
            });
        }

        public function verify($code)
        {
            $users = Account::where('confirmation_code', $code);

            if($users->count() > 0){
                $users->update([
                    'confirmed' => 1,
                ]);

                $status = 'You have successfully verified!';

                return $status;
            }
        }
    }