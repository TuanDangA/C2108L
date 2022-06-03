<?php

namespace App\Http\Service\user;

use Illuminate\Http\Request;
use App\Models\management\feedback;
use App\Models\management\feedback_categories;
use App\Models\management\account;

class User_FeedbackService{
    //select all feedback categories
    public function SelectAllCategories(){
        $categoriesList = feedback_categories::get();
        return $categoriesList;
    }

    //update database: add feedback
    public function post_add($request){
        $feedback = new feedback();
        $feedback->content = $request->content;
        $feedback->id_feedback_category = $request->id_feedback_category;
        $feedback->id_user= $request->id_user;
        $feedback->save();
    }

    //select accounts by id
    public function SelectAccount($id){
        $account= account::Find($id);
        return $account;
    }

    //select accounts by confirmation code
    public function Select_Account_code($code){
        $accounts = account::where('confirmation_code',$code)->first();
        return $accounts;
    }
}