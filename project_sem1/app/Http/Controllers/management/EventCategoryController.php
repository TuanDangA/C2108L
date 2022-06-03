<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Service\management\EventCategoryService;
use Illuminate\Http\Request;
use App\Models\management\event_categories;
use App\Models\management\account;


class EventCategoryController extends Controller
{
    public $eventCategorytService;

    //Create a new instance of EventCategoryService in controller
    public function __construct(EventCategoryService $eventCategoryService)
    {
        $this->eventCategoryService = $eventCategoryService;
    }

    //return and send data to list page
    public function list(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        if(isset($request->search)){
            $category = $this->eventCategoryService->search($request->search);
        }else {
            $category = $this->eventCategoryService->list();
        }       
        
        $index = 0;

        return view('management.event_category.list', [
            'category' => $category,
            'index' => $index,
            'accounts' => $accounts,
            'search'=>$request->search,
            'count'=>count($category)
        ]);
    }

    //return to add page
    public function add(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        return view('management.event_category.add', ['accounts' => $accounts]);
    }

    //validate add field and add data to database by service, then return to list page
    public function insert(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $category = new event_categories();

        $this->eventCategoryService->validate($request);

        $this->eventCategoryService->save($request->all(), $category);

        return redirect()->route('event_category-list',$accounts->confirmation_code);
    }

    //return and send data to edit page
    public function edit(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $category = event_categories::find($request->id);
        
        return view('management.event_category.edit', [
            'category' => $category,
            'id' => $request->id,
            'accounts' => $accounts
        ]);
    }

    //validate edit field and update data to database by service, then return to list page
    public function update(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $category = event_categories::find($request->id);

        $this->eventCategoryService->validate($request);

        $this->eventCategoryService->save($request->all(), $category);

        return redirect()->route('event_category-list', $accounts->confirmation_code);
    }

    //Send data to service
    public function delete(Request $request)
    {
        $category = event_categories::find($request->id);

        $this->eventCategoryService->delete($category);
    }
}
