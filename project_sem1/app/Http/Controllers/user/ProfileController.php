<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Service\user\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function view(Request $request)
    {
        $accounts = $this->profileService->Select_Account_code($request->confirmation_code);

        return view('user.profile.view_profile', [
            'accounts' => $accounts
        ]);
    }

    public function edit(Request $request)
    {
        $accounts = $this->profileService->Select_Account_code($request->confirmation_code);

        return view('user.profile.edit_profile', [
            'accounts' => $accounts
        ]);
    }

    public function save(Request $request)
    {
        $this->profileService->validate($request);

        $accounts = $this->profileService->save($request->all());

        return redirect(route('profile-view', $accounts->confirmation_code))->with('msg', 'Your profile updated successfully!');
    }

    public function changePwd(Request $request)
    {
        $accounts = $this->profileService->Select_Account_code($request->confirmation_code);

        return view('user.profile.change_password', [
            'accounts' => $accounts
        ]);
    }

    public function saveChangePwd(Request $request)
    {
        $msg = $this->profileService->validateOldPwd($request->all());

        if($msg){
            return redirect()->back()->with('msg', $msg);
        }

        $this->profileService->validatePwd($request);

        $accounts = $this->profileService->saveChangePwd($request->all());

        return redirect(route('profile-view', $accounts->confirmation_code))->with('msg', 'Password updated successfully!');
        
        
    }
}
