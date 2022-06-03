<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\management\feedback;
use App\Http\Service\management\FeedbackService;
use App\Models\management\account;

class FeedbackController extends Controller
{
    public $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    //return and send data to list page
    public function list(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        if(isset($request->search)){
            $feedbacks = $this->feedbackService->search($request->search);
        }else {
            $feedbacks = $this->feedbackService->list();
        }
        
        $index = 0;

        return view('management.feedbacks.list', [
            'feedbacks' => $feedbacks,
            'index' => $index,
            'accounts' => $accounts,
            'search' => $request->search,
            'count'=> count($feedbacks)
        ]);
    }

    //return and send data to edit page
    public function edit(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $feedbacks = $this->feedbackService->edit($request->id);
        
        return view('management.feedbacks.edit', [
            'feedbacks' => $feedbacks,
            'id' => $request->id,
            'accounts' => $accounts
        ]);
    }

    public function update(Request $request)
    {
        $accounts = account::where('confirmation_code',$request->confirmation_code)->first();

        $this->feedbackService->update($request->all());

        return redirect()->route('feedbacks-list', $accounts->confirmation_code);
    }

    public function delete(Request $request)
    {
        $feedbacks = Feedback::find($request->id);

        $this->feedbackService->delete($feedbacks);
    }

}
