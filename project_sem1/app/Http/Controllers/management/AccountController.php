<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use App\Http\Service\management\AccountService;
use App\Models\management\account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public $accountService;

    //Create a new instance of AccountService in controller
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    //return and send data to list page
    public function list(Request $request)
    {
        $accounts = $this->accountService->Select_Account_code($request->confirmation_code);
        $index = 0;

        if(isset($request->search)){
            $users = $this->accountService->search($request->search);
            return view('management.users.list', [
                'search'=>$request->search,
                'users' => $users,
                'index' => $index,
                'accounts' => $accounts,
                'count'=>count($users)
            ]);
        }else {
            $users = $this->accountService->list();
            return view('management.users.list', [
                'users' => $users,
                'index' => $index,
                'accounts' => $accounts,
                'count'=>count($users)
            ]);
        }

        
    }

    //return to add page
    public function add(Request $request)
    {
        $accounts = $this->accountService->Select_Account_code($request->confirmation_code);

        return view('management.users.add', [
            'accounts' => $accounts
        ]);
    }

    //validate add field and add data to database by service, then return to list page
    public function insert(Request $request)
    {
        $accounts = $this->accountService->Select_Account_code($request->confirmation_code);
        
        $users = new Account();

        $this->accountService->validateAdd($request);

        $this->accountService->save($request->all(), $users);

        return redirect()->route('users-list', $accounts->confirmation_code);
    }

    //return and send data to edit page
    public function edit(Request $request)
    {
        $accounts = $this->accountService->Select_Account_code($request->confirmation_code);

        $users = Account::find($request->id);
        
        return view('management.users.edit', [
            'users' => $users,
            'id' => $request->id,
            'accounts' => $accounts
        ]);
    }

    //validate edit field and update data to database by service, then return to list page
    public function update(Request $request)
    {
        $accounts = $this->accountService->Select_Account_code($request->confirmation_code);

        $users = Account::find($request->id);

        if($request->email == $users->email){
            $this->accountService->validateEditWithoutEmail($request);
        }else {
            $this->accountService->validateEditWithEmail($request);
        }

        $this->accountService->save($request->all(), $users);

        return redirect()->route('users-list', $accounts->confirmation_code);
    }

    //Send data to service
    public function delete(Request $request)
    {
        $accounts = $this->accountService->SelectAccount($request->id);

        $this->accountService->delete($accounts);
    }
}
