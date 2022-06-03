<?php

    namespace App\Http\Controllers\management;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Http\Service\management\categoriesPostService as Service;
    use App\Http\Service\management\AccountService as Service_Account;


    class categoriesPostController extends Controller
    {
        public $service;
        public $Serv_Account;

        public function __construct(Service $newServ,Service_Account $Service_Account){
            $this->service = $newServ;
            $this->Serv_Account = $Service_Account;
        }

        //add post category
        public function add($confirmation_code){
            $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
            return view('management.categories_post.add',[
                'accounts'=>$accounts,
            ]);
        }

        //edit post category
        public function edit($confirmation_code,$id_category){
            $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
            $categoryPost = $this->service->SelectOne($id_category);
            return view('management.categories_post.edit',[
                'category'=>$categoryPost,
                'accounts'=>$accounts,
            ]);
        }

        //delete post category
        public function delete($confirmation_code,$id_category){
            $categoryPost = $this->service->SelectOne($id_category);
            $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
            return view('management.categories_post.delete',[
                'category'=>$categoryPost,
                'accounts'=>$accounts
            ]);
        }

        //upadte database according to "action" (edit/add/delete)
        public function post($confirmation_code,Request $request){
            $action = $request->action;
            switch($action){
                case 'add':{
                    $this->service->ValadateAdd($request);
                    $this->service->post_add($request);
                    return redirect()->route('admin_categoriesPost_list',['confirmation_code'=>$confirmation_code]);           
                }
                case 'edit':{
                    $this->service->ValadateAdd($request);
                    $this->service->post_edit($request);
                    return redirect()->route('admin_categoriesPost_list',['confirmation_code'=>$confirmation_code]);           
                }
                case 'delete':{
                    $this->service->post_delete($request);
                    return redirect()->route('admin_categoriesPost_list',['confirmation_code'=>$confirmation_code]);           
                }
            }
        }

        //list all post categories
        public function list($confirmation_code){
            $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
            $categoriesList = $this->service->listAll();
            $index = 0;
            return view('management.categories_post.list',[
                'categoriesList'=>$categoriesList,
                'accounts'=>$accounts,
                'index'=>$index,
                'count'=>count($categoriesList)
            ]);
        }

        //search post categories
        public function search($confirmation_code,Request $request){
            if(is_null($request->search)){
                return redirect()->route('admin_categoriesPost_list',['confirmation_code'=>$confirmation_code]);           
            }
            else{
                $categoriesList = $this->service->search($request);
            }
            $index = 0;
            $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
            return view('management.categories_post.list',[
                'categoriesList'=>$categoriesList,
                'accounts'=>$accounts,
                'index'=>$index,
                'search'=>$request->search,
                'count'=>count($categoriesList)
            ]);
        } 
    }
?>
