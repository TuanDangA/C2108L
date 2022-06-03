<?php
    namespace App\Http\Service\user;

    use App\Models\Management\account;
    use Illuminate\Support\Facades\Hash;

    class ProfileService
    {
        public function view($id)
        {
            $accounts = account::find($id);

            return $accounts;
        }

        public function Select_Account_code($code){
            $accounts = account::where('confirmation_code','=',$code)->first();
            return $accounts;
        }

        public function validate($dataForm)
        {
            return $dataForm->validate([
                'fullname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:16', 'min:10'],
                'address' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string'],
                'dob' => ['required', 'date']
            ]);
        }

        public function save(array $dataForm)
        {
            $accounts = account::find($dataForm['id']);

            if(isset($dataForm['image'])){
                //remove old image in storage
                if($accounts->image != null){
                    $path_short = public_path().'/storage/images/user_avatar/';

                    $file_old = $path_short.$accounts->image;
                    unlink($file_old);
                }

                $image = $dataForm['image'];
                $image_name = $accounts->email.$image->getClientOriginalName();
                $image-> storeAs('public/images/user_avatar', $image_name);
                $accounts->image = $image_name;
            }
            
            //save data to database
            $accounts->fullname = $dataForm['fullname'];
            $accounts->phone = $dataForm['phone'];
            $accounts->address = $dataForm['address'];
            $accounts->gender = $dataForm['gender'];
            $accounts->dob = $dataForm['dob'];

            $accounts->save();

            return $accounts;
        }

        public function validatePwd($dataForm)
        {
            return $dataForm->validate([
                'password' => ['required', 'string', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/']
            ]);
        }

        public function validateOldPwd(array $dataForm)
        {
            $accounts = account::find($dataForm['id']);

            if(!Hash::check($dataForm['oldPwd'], $accounts->password)){
                return $msg = 'The current password is incorrect. Please try again!';
            }
        }

        public function saveChangePwd(array $dataForm)
        {
            $accounts = account::find($dataForm['id']);

            $accounts->password = Hash::make($dataForm['password']);
            $accounts->save();

            return $accounts;
        }
    }