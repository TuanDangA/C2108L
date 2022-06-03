<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\Rand_BackgroundService as Service_Rand_Background;
use App\Http\Service\user\User_PostService as Service_Post;
use App\Http\Service\user\User_AnimalService as Service_Animal;
use App\Http\Service\user\EventService as Service_Event;
use App\Http\Service\management\AccountService as Service_Account;
use App\Http\Service\HomeService;

class HomeController extends Controller {
    public $Serv_Rand_Background;
    public $Serv_Post;
    public $Serv_Account;
    public $Serv_Animal;
    public $Serv_Event;
    public $homeService;

    public function __construct(Service_Rand_Background $Service_Rand_Background,Service_Post $Service_Post,Service_Account $Service_Account,Service_Animal $Service_Animal,Service_Event $Service_Event,HomeService $homeService){
        $this->Serv_Rand_Background = $Service_Rand_Background;
        $this->Serv_Post = $Service_Post;
        $this->Serv_Account = $Service_Account;
        $this->Serv_Animal = $Service_Animal;
        $this->Serv_Event = $Service_Event;
        $this->homeService = $homeService;
    }

    //initiate home page, if visitors have logged in then send the user's id to the home page and every page after that
    public function home($confirmation_code){
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $PostList = $this->Serv_Post->listAllPost_Home();
        $EventList = $this->Serv_Event->listAllEvents();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        return view('user.home.home',[
            'backgroundname'=>$backgroundname,
            'accounts'=>$accounts,
            'PostList'=>$PostList,
            'EventList'=>$EventList
        ]);
    }

    //show about_us page
    public function about_us($confirmation_code){
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        return view('user.home.about_us',[
            'backgroundname'=>$backgroundname,
            'accounts'=>$accounts
        ]);
    }

    //show contact_us page
    public function contact_us($confirmation_code){
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        return view('user.home.contact_us',[
            'backgroundname'=>$backgroundname,
            'accounts'=>$accounts
        ]);
    }

    //show faqs page
    public function faqs($confirmation_code){
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        return view('user.home.faqs',[
            'backgroundname'=>$backgroundname,
            'accounts'=>$accounts
        ]);
    }

    //show ticket_price page
    public function ticket_price($confirmation_code){
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
        return view('user.home.ticket_price',[
            'backgroundname'=>$backgroundname,
            'accounts'=>$accounts
        ]);
    }

    //general search in animals, news or events
    public function search($confirmation_code,Request $request){
        $backgroundname = $this->Serv_Rand_Background->GetRandomBackground();
        if($request->search == null){
            return redirect()->route('home',['confirmation_code'=>$confirmation_code]);
        }
        else{
            $accounts = $this->Serv_Account->Select_Account_code($confirmation_code);
            $animal_result = $this->Serv_Animal->search_general($request);
            $post_result = $this->Serv_Post->search_general($request);
            $event_result = $this->Serv_Event->search_general($request);
            return view('user.home.search',[
                'backgroundname'=>$backgroundname,
                'accounts'=>$accounts,
                'animal_result'=>$animal_result,
                'post_result'=>$post_result,
                'event_result'=>$event_result,
                'animal_count'=>count($animal_result),
                'post_count'=>count($post_result),
                'event_count'=>count($event_result),
                'search_general'=>$request->search,
            ]);
        }
    }

    public function home_route()
    {
        $accounts = $this->homeService->home();

        if($accounts != null){
            return redirect()->route('home',['confirmation_code'=>$accounts->confirmation_code]);
        } else {
            return redirect()->route('home',['confirmation_code'=>"guest"]);
        }
    }
}