<?php
    namespace App\Http\Service\Management;

    use Illuminate\Support\Facades\Hash;
    use App\Models\management\account;
    use Illuminate\Support\Str;

    class AdminService
    {
        public function validate($dataForm)
        {
            return $dataForm->validate([
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:accounts'],
                'password' => ['required', 'string', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/']
            ]);
        }

        public function save(array $dataForm)
        {
            //Get rule id from rule_account table
            $id_rule = Account::rightJoin('rule_account', 'rule_account.id', '=', 'accounts.id_rule_user')
                                ->where('rule_account.name', 'admin')
                                ->first('rule_account.id');

            $admin = new Account();
            $admin->confirmed = 1;
            $admin->id_rule_user = $id_rule->id;
            $admin->fullname = $dataForm['fullname'];
            $admin->email = $dataForm['email'];
            $admin->password = Hash::make($dataForm['password']);
            $admin->confirmation_code = Str::random(32);
            $admin->save();
        }
    }
?>