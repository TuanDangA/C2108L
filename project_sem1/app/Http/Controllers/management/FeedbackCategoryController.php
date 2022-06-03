<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Service\management\FeedbackCategoryService;
use Illuminate\Http\Request;
use App\Models\management\feedback_categories;
use App\Models\management\account;



class FeedbackCategoryController extends Controller
{
    public $feedbackCategorytService;

    //Create a new instance of FeedbackCategoryService in controller
    public function __construct(FeedbackCategoryService $feedbackCategorytService)
    {
        $this->feedbackCategorytService = $feedbackCategorytService;
    }

    //return and send data to list page
    public function list(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        if(isset($request->search)){
            $category = $this->feedbackCategorytService->search($request->search);
        }else {
            $category = $this->feedbackCategorytService->list();
        }
        $index = 0;

        return view('management.feedback_category.list', [
            'category' => $category,
            'index' => $index,
            'accounts' => $accounts,
            'search' => $request->search,
            'count'=>count($category)
        ]);
    }

    //return to add page
    public function add(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        return view('management.feedback_category.add', [
            'accounts' => $accounts
        ]);
    }

    //validate add field and add data to database by service, then return to list page
    public function insert(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $category = new feedback_categories();

        $this->feedbackCategorytService->validate($request);

        $this->feedbackCategorytService->save($request->all(), $category);

        return redirect()->route('feedback_category-list', $accounts->confirmation_code);
    }

    //return and send data to edit page
    public function edit(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $category = feedback_categories::find($request->id);
        
        return view('management.feedback_category.edit', [
            'category' => $category,
            'id' => $request->id,
            'accounts' => $accounts
        ]);
    }

    //validate edit field and update data to database by service, then return to list page
    public function update(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $category = feedback_categories::find($request->id);

        $this->feedbackCategorytService->validate($request);

        $this->feedbackCategorytService->save($request->all(), $category);

        return redirect()->route('feedback_category-list', $accounts->confirmation_code);
    }

    //Send data to service
    public function delete(Request $request)
    {
        $category = feedback_categories::find($request->id);

        $this->feedbackCategorytService->delete($category);
    }
}
