<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Service\management\AdminService;
use App\Models\management\account;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function add(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        return view('management.admin.add', [
            'accounts' => $accounts
        ]);
    }

    public function insert(Request $request)
    {
        $this->adminService->validate($request);

        $this->adminService->save($request->all());

        return redirect(route('home_admin', $request->confirmation_code))->with('msg', 'New admin added successfully!');
    }
}
