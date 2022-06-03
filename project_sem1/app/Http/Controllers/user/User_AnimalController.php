<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\user\User_AnimalService as Service;
use App\Http\Service\management\AccountService as Service_Account;

class User_AnimalController extends Controller
{
    public $service;
    public $Serv_Account;
    public function __construct(Service $serv,Service_Account $Service_Account){
        $this->service = $serv;
        $this->Serv_Account = $Service_Account;
    }

    //list all animals
    public function listAll($confirmation_code){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $AnimalList = $this->service->listAllAnimal();
        $categoriesList = $this->service->listAllCategories();
        $ranges = $this->service->listAllRanges();
        $backgroundname = $this->service->GetRandomBackground();
        return view('user.animal.animal-guide',[
            'AnimalList'=>$AnimalList,
            'categoriesList'=>$categoriesList,
            'rangesList'=>$ranges,
            'old_id_range'=>null,
            'old_id_category'=>null,
            'backgroundname'=>$backgroundname,            
            'accounts'=>$accounts,
            'count'=>count($AnimalList)
        ]);  
    }

    //search animals
    public function search($confirmation_code,Request $request){
        if(is_null($request->id_category) && is_null($request->id_range)){
            return redirect()->route('user_animal_list',['confirmation_code'=>$confirmation_code]);
        }
        else{
            $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
            $AnimalList = $this->service->search($request);
            $categoriesList = $this->service->listAllCategories();
            $rangesList = $this->service->listAllRanges();
            $backgroundname = $this->service->GetRandomBackground();
            return view('user.animal.animal-guide',[
                'AnimalList'=>$AnimalList,
                'categoriesList'=>$categoriesList,
                'rangesList'=>$rangesList,
                'old_id_range'=>$request->id_range,
                'old_id_category'=>$request->id_category,
                'backgroundname'=>$backgroundname,
                'accounts'=>$accounts,
                'count'=>count($AnimalList)
            ]);
        }
    }

    //send animal details to new page
    public function showDetails($confirmation_code,$hrefParam){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $animal = $this->service->select_animal_from_hrefParam($hrefParam);
        $related_animals = $this->service->getRelatedAnimals($animal->id_range);
        $category = $this->service->GetCategory($animal->id_category);
        $range = $this->service->GetRange($animal->id_range);
        return view('user.animal.animal-detail',[
            'animal'=>$animal,
            'category'=>$category,
            'range'=>$range,
            'accounts'=>$accounts,
            'related_animals'=>$related_animals
        ]);
    }

}


