<?php
    namespace App\Http\Service\management;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use App\Models\management\account;
    use Illuminate\Support\Str;

    class AccountService{

        //select account by id
        public function SelectAccount($id){
            $account = account::Find($id);
            return $account;
        }

        //Get data from database and return
        public function list()
        {
            $users = account::join('rule_account', 'rule_account.id', '=', 'accounts.id_rule_user')
                                ->select('accounts.*')
                                ->where('rule_account.name','=','user')
                                ->get();

            return $users;
        }

        //validate form
        public function validateAdd($dataForm)
        {
            return $dataForm->validate([
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:accounts'],
                'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:16', 'min:10'],
                'address' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string'],
                'dob' => ['required', 'date'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'password' => ['required', 'string', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/']
            ]);
        }

        //validate form Edit without change email
        public function validateEditWithoutEmail($dataForm)
        {
            return $dataForm->validate([
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:16', 'min:10'],
                'address' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string'],
                'dob' => ['required', 'date'],
                'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
            ]);
        }

        //validate form Edit with change email
        public function validateEditWithEmail($dataForm)
        {
            return $dataForm->validate([
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:accounts'],
                'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:16', 'min:10'],
                'address' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string'],
                'dob' => ['required', 'date'],
                'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
            ]);
        }

        //save data to database
        public function save(array $dataForm, Account $users)
        {
            //Get rule id from rule_account table
            $id_rule = account::rightJoin('rule_account', 'rule_account.id', '=', 'accounts.id_rule_user')
                                ->where('rule_account.name', 'user')
                                ->first('rule_account.id');

            //get file name from input and save file to storage
            if(isset($dataForm['image'])){
                //remove old image in storage
                if($users->image != null){
                    $path_short = public_path().'/storage/images/user_avatar/';

                    $file_old = $path_short.$users->image;
                    unlink($file_old);
                }

                $image = $dataForm['image'];
                $image_name = $dataForm['email'].$image->getClientOriginalName();
                $image-> storeAs('public/images/user_avatar', $image_name);
                $users->image = $image_name;
            }
            
            //save data to database
            $users->fullname = $dataForm['fullname'];
            $users->email = $dataForm['email'];
            $users->phone = $dataForm['phone'];
            $users->address = $dataForm['address'];
            $users->gender = $dataForm['gender'];
            $users->dob = $dataForm['dob'];
            $users->id_rule_user = $id_rule->id;
            $users->confirmed = 1;
            $users->confirmation_code = Str::random(32);

            
            if(isset($dataForm['password'])){
                $users->password = Hash::make($dataForm['password']);
            }

            $users->save();
        }

        //Remove user from database
        public function delete(Account $users)
        {
            //remove old image in storage
            if($users->image != null){
                $path_short = public_path().'/storage/images/user_avatar/';

                $file_old = $path_short.$users->image;
                unlink($file_old);
            }

            $users->delete();
        }

        public function search($dataForm)
        {
            $users = account::where('id_rule_user','=','2')
                                ->where('fullname', 'like', '%'.$dataForm.'%')
                                ->orWhere('email', 'like', '%'.$dataForm.'%')
                                ->orWhere('phone', 'like', '%'.$dataForm.'%')
                                ->orWhere('address', 'like', '%'.$dataForm.'%')
                                ->orWhere('gender', 'like', '%'.$dataForm.'%')
                                ->orWhere('dob', 'like', '%'.$dataForm.'%')
                                ->get();

            return $users;
        }

        public function Select_Account_code($code){
            $accounts = account::where('confirmation_code',$code)->first();
            return $accounts;
        }
    }