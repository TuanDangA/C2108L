<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\management\AnimalService as Service;
use App\Http\Service\management\AccountService as Service_Account;

class AnimalController extends Controller
{
    public $service;
    public $Serv_Account;
    public function __construct(Service $serv,Service_Account $Service_Account){
        $this->service = $serv;
        $this->Serv_Account = $Service_Account;
    }

    //add animals
    public function add($confirmation_code,$id_category){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $species = $this->service->GetSpecies($id_category);
        $ranges = $this->service->getRangeList();
        return view('management.Animal.add',[
            'id_category'=>$id_category,
            'species'=>$species,
            'ranges'=>$ranges,
            'accounts'=>$accounts
        ]);
    }

    //edit animals
    public function edit($confirmation_code,$id_animal){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $animal = $this->service->GetAnimal($id_animal);
        $species = $this->service->GetSpecies($animal->id_category);
        $ranges = $this->service->getRangeList();
        return view('management.animal.edit',[
            'animal'=>$animal,
            'species'=>$species,
            'ranges'=>$ranges,
            'accounts'=>$accounts
        ]);
    }

    //confirm deleting animals
    public function delete($confirmation_code,$id_animal){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $animal = $this->service->GetAnimal($id_animal);
        $species = $this->service->GetSpecies($animal->id_category);
        $range = $this->service->GetRange($animal->id_range);
        return view('management.animal.delete',[
            'animal'=>$animal,
            'species'=>$species,
            'range'=>$range,
            'accounts'=>$accounts
        ]);
    }

    //update the database according to "action" (add/edit/delete)
    public function post($confirmation_code,Request $request){
        $action = $request->action;
        switch($action){
            case 'add':{
                $this->service->ValadateAdd($request);
                $this->service->post_add($request);
                return redirect()->route('admin_animal_list',['id_category'=>$request->id_category,'confirmation_code'=>$confirmation_code]);      
            }
            case 'edit':{
                $this->service->post_edit($request);
                return redirect()->route('admin_animal_list',['id_category'=>$request->id_category,'confirmation_code'=>$confirmation_code]);      
            }
            case 'delete':{
                $this->service->post_delete($request);  
                return redirect()->route('admin_animal_list',['id_category'=>$request->id_category,'confirmation_code'=>$confirmation_code]);      
            }
        }
    }
    
    //list all animals of a category
    public function list($confirmation_code,$id_category){
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        $animalList = $this->service->Select_animal_by_category($id_category);
        $species = $this->service->GetSpecies($id_category);
        $index = 0;
        return view('management.animal.list2',[
            'animalList'=>$animalList,
            'index'=>$index,
            'id_category'=>$id_category,
            'accounts'=>$accounts,
            'species'=>$species,
            'count'=>count($animalList)
        ]);
    }

    //search animal 
    public function search($confirmation_code,Request $request){
        if(!is_null($request->id_category) && is_null($request->search)){
            return redirect()->route('admin_animal_list',['id_category'=>$request->id_category,'confirmation_code'=>$confirmation_code]);      
        }
        else{
            $animalList = $this->service->search($request);
        }
        $species = $this->service->GetSpecies($request->id_category);
        $index = 0;
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        return view('management.animal.list2',[
            'animalList'=>$animalList,
            'index'=>$index,
            'id_category'=>$request->id_category,
            'accounts'=>$accounts,
            'species'=>$species,
            'search'=>$request->search,
            'count'=>count($animalList)
        ]);
    } 
}
