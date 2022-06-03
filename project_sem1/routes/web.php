<?php

use App\Http\Controllers\management\AccountController;
use App\Http\Controllers\Management\AdminController;
use App\Http\Controllers\user\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\management\AnimalController;
use App\Http\Controllers\management\AuthorController;
use App\Http\Controllers\Management\BookingController;
use App\Http\Controllers\management\categoriesAnimalController;
use App\Http\Controllers\management\categoriesPostController;
use App\Http\Controllers\Management\EventCategoryController;
use App\Http\Controllers\Management\EventController;
use App\Http\Controllers\Management\FeedbackCategoryController;
use App\Http\Controllers\Management\FeedbackController;
use App\Http\Controllers\management\home_adminController;
use App\Http\Controllers\management\PostController;
use App\Http\Controllers\management\RangeController;
use App\Http\Controllers\user\User_AnimalController;
use App\Http\Controllers\user\User_PostController;
use App\Http\Controllers\user\User_FeedbackController;
use App\Http\Controllers\management\RandBackgroundController;
use App\Http\Controllers\user\ForgotPasswordController;
use App\Http\Controllers\user\LoginController;
use App\Http\Controllers\user\LogoutController;
use App\Http\Controllers\user\User_BookingsController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\RegisterController;
use App\Http\Controllers\user\UsersEventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('management/{confirmation_code}')->group(function(){

    Route::controller(home_adminController::class)->group(function() {
        Route::get('/home_admin','home_admin')->name('home_admin');
    });

    Route::prefix('animal/')->group(function(){
        Route::controller(AnimalController::class)->group(function() {
            Route::get('/{id_category}','list')->name('admin_animal_list');
            Route::get('/add/{id_category}','add')->name('admin_animal_add');
            Route::get('/edit/{id_animal}','edit')->name('admin_animal_edit');
            Route::get('/delete/{id_animal}','delete')->name('admin_animal_delete');
            Route::any('/post','post')->name('admin_animal_post');
            Route::any('/search','search')->name('admin_animal_search');
        });
    });

    Route::prefix('categoriesAnimal')->group(function(){
        Route::controller(categoriesAnimalController::class)->group(function() {
            Route::get('','list')->name('admin_categoryAnimal_list');
            Route::get('/add','add')->name('admin_categoryAnimal_add');
            Route::get('/edit/{id_category}','edit')->name('admin_categoryAnimal_edit');
            Route::get('/delete/{id_category}','delete')->name('admin_categoryAnimal_delete');
            Route::any('/post','post')->name('admin_categoryAnimal_post');
            Route::any('/search','search')->name('admin_categoryAnimal_search');
        });
    });

    Route::prefix('categoriesPost')->group(function(){
        Route::controller(categoriesPostController::class)->group(function() {
            Route::get('','list')->name('admin_categoriesPost_list');
            Route::get('/add','add')->name('admin_categoriesPost_add');
            Route::get('/edit/{id_category}','edit')->name('admin_categoriesPost_edit');
            Route::get('/delete/{id_category}','delete')->name('admin_categoriesPost_delete');
            Route::any('/post','post')->name('admin_categoriesPost_post');
            Route::any('/search','search')->name('admin_categoryPost_search');
        });
    });

    Route::prefix('post')->group(function(){
        Route::controller(PostController::class)->group(function() {
            Route::get('/{id_category}','list')->name('admin_post_list');
            Route::get('/add/{id_category}','add')->name('admin_post_add');
            Route::get('/edit/{id_post}','edit')->name('admin_post_edit');
            Route::get('/delete/{id_post}','delete')->name('admin_post_delete');
            Route::any('/post','post')->name('admin_post_post');
            Route::any('/search','search')->name('admin_post_search');
        });
    });
    Route::prefix('author')->group(function(){
        Route::controller(AuthorController::class)->group(function() {
            Route::get('','list')->name('admin_author_list');
            Route::get('/add','add')->name('admin_author_add');
            Route::get('/edit/{id_author}','edit')->name('admin_author_edit');
            Route::get('/delete/{id_author}','delete')->name('admin_author_delete');
            Route::any('/post','post')->name('admin_author_post');
            Route::any('/search','search')->name('admin_author_search');
        });
    });

    Route::prefix('range')->group(function(){
        Route::controller(RangeController::class)->group(function() {
            Route::get('','list')->name('admin_range_list');
            Route::get('/add','add')->name('admin_range_add');
            Route::get('/edit/{id_range}','edit')->name('admin_range_edit');
            Route::get('/delete/{id_range}','delete')->name('admin_range_delete');
            Route::any('/post','post')->name('admin_range_post');
            Route::any('/search','search')->name('admin_range_search');
        });
    });

    Route::prefix('rand_background')->group(function(){
        Route::controller(RandBackgroundController::class)->group(function() {
            Route::get('','list')->name('admin_rand_backgrounds_list');
            Route::get('/add','add')->name('admin_rand_backgrounds_add');
            Route::get('/edit/{id_background}','edit')->name('admin_rand_backgrounds_edit');
            Route::get('/delete/{id_background}','delete')->name('admin_rand_backgrounds_delete');
            Route::any('/post','post')->name('admin_rand_backgrounds_post');
            Route::any('/search','search')->name('admin_rand_backgrounds_search');
        });
    });
    
    Route::group(['prefix' => 'new_admin'], function() {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/add', 'add') ->name('new_admin-add');
            Route::post('/insert', 'insert') ->name('new_admin-insert');
        });
    });

    Route::group(['prefix' => 'users'], function() {
        Route::controller(AccountController::class)->group(function () {
            Route::get('/', 'list') ->name('users-list');
            Route::get('/add', 'add') ->name('users-add');
            Route::post('/insert', 'insert') ->name('users-insert');
            Route::get('/edit/{id}', 'edit') ->name('users-edit');
            Route::post('/update', 'update') ->name('users-update');
            Route::post('/delete', 'delete') ->name('users-delete');
        });
    });

    
    Route::group(['prefix' => 'event_category'], function() {
        Route::controller(EventCategoryController::class)->group(function() {
            Route::get('/', 'list') ->name('event_category-list');
            Route::get('/add', 'add') ->name('event_category-add');
            Route::post('/insert', 'insert') ->name('event_category-insert');
            Route::get('/edit/{id}', 'edit') ->name('event_category-edit');
            Route::post('/update', 'update') ->name('event_category-update');
            Route::post('/delete', 'delete') ->name('event_category-delete');
        });
    });


    Route::group(['prefix' => 'events'], function() {
        Route::controller(EventController::class)->group(function() {
            Route::get('/', 'list') ->name('events-list');
            Route::get('/add', 'add') ->name('events-add');
            Route::post('/insert', 'insert') ->name('events-insert');
            Route::get('/edit/{id}', 'edit') ->name('events-edit');
            Route::post('/update', 'update') ->name('events-update');
            Route::post('/delete', 'delete') ->name('events-delete');
        });
    });


    Route::group(['prefix' => 'bookings'], function() {
        Route::controller(BookingController::class)->group(function() {
            Route::get('/', 'list') ->name('bookings-list');
            Route::get('/add', 'add') ->name('bookings-add');
            Route::any('/add/confirm', 'addConfirm') ->name('bookings-add-confirm');
            Route::post('/insert', 'insert') ->name('bookings-insert');
            Route::get('/edit/{id_booking}/{id_event}', 'edit') ->name('bookings-edit');
            Route::any('/edit/confirm', 'editConfirm') ->name('bookings-edit-confirm');
            Route::post('/update', 'update') ->name('bookings-update');
            Route::post('/delete', 'delete') ->name('bookings-delete');
        });
    });


    Route::group(['prefix' => 'feedback_category'], function() {
        Route::controller(FeedbackCategoryController::class)->group(function() {
            Route::get('/', 'list') ->name('feedback_category-list');
            Route::get('/add', 'add') ->name('feedback_category-add');
            Route::post('/insert', 'insert') ->name('feedback_category-insert');
            Route::get('/edit/{id}', 'edit') ->name('feedback_category-edit');
            Route::post('/update', 'update') ->name('feedback_category-update');
            Route::post('/delete', 'delete') ->name('feedback_category-delete');
        });
    });


    Route::group(['prefix' => 'feedbacks'], function() {
        Route::controller(FeedbackController::class)->group(function() {
            Route::get('/', 'list') ->name('feedbacks-list');
            Route::get('/edit/{id}', 'edit') ->name('feedbacks-edit');
            Route::post('/update', 'update') ->name('feedbacks-update');
            Route::post('/delete', 'delete') ->name('feedbacks-delete');
            Route::post('/search', 'search') ->name('feedbacks-search');
        });
    });
});

Route::prefix('user/{confirmation_code}')->group(function(){

    //HOME
    Route::controller(HomeController::class)->group(function() {
        Route::get('/home','home')->name('home');
        Route::any('/about-us','about_us')->name('about_us');
        Route::get('/contact-us','contact_us')->name('contact_us');
        Route::get('/faqs','faqs')->name('faqs');
        Route::get('/ticket-price','ticket_price')->name('ticket_price');
        Route::any('/search','search')->name('search');
    });

    //ANIMALS
    Route::prefix('animal')->group(function(){
        Route::controller(User_AnimalController::class)->group(function() {
            Route::get('/animal-guide','listAll')->name('user_animal_list');
            Route::get('/animal/{hrefParam}','showDetails')->name('user_animal_detail');
            Route::any('/animal_search','search')->name('user_animal_search');
        });
    });

    //NEWS
    Route::prefix('post')->group(function(){
        Route::controller(User_PostController::class)->group(function() {
            Route::get('/news','listAll')->name('user_post_list');
            Route::any('/news/search','search')->name('user_post_search');
            Route::get('/news/{hrefParam}','showDetails')->name('user_post_detail');
        });
    });

    //EVENT
    Route::prefix('event')->group(function(){
        Route::controller(UsersEventController::class)->group(function() {
            Route::get('/view', 'view')->name('event-view');
            Route::any('/view/filter', 'view')->name('event-view-filter');
            Route::get('/{href_param}', 'detail')->name('event-detail');
        });
    });

    //FEEDBACKS
    Route::prefix('feedback')->group(function(){
        Route::controller(User_FeedbackController::class)->group(function() {
            Route::get('/new','add')->name('user_feedback_add');
            Route::any('/post','post')->name('user_feedback_post');
        });
    });

    //edit/add/delete booking visit and event
    Route::prefix('booking')->group(function(){
        Route::controller(User_BookingsController::class)->group(function() {
            Route::get('/list','booking_list')->name('user_booking_list');
            Route::get('/edit/{id_booking}/route','route_add_edit')->name('user_booking_edit_route');
            Route::get('/delete/{id_booking}/route','route_delete')->name('user_booking_delete_route');

            Route::prefix('event')->group(function(){
                Route::get('/{href_param}/form/{id_old_booking_event}','booking_event_form')->name('user_event_booking_form');
                Route::any('/{href_param}/form/edit','booking_event_edit')->name('user_event_booking_edit');
                Route::get('/{href_param}/form/{id_old_booking_event}/delete','booking_event_delete')->name('user_event_booking_delete');
                Route::any('/{href_param}/confirm','booking_event_confirm')->name('user_event_booking_confirm');
                Route::any('/{href_param}/submit','booking_event_submit')->name('user_event_booking_submit');
            });   

            Route::prefix('visit')->group(function(){
                Route::get('/details','booking_visit_details')->name('user_visit_booking_details');
                Route::any('/form/{id_old_booking_adults}/{id_old_booking_children}','booking_visit_form')->name('user_visit_booking_form');
                Route::any('/form/edit','booking_visit_edit')->name('user_visit_booking_edit');
                Route::get('/form/{id_old_booking_adults}/{id_old_booking_children}/delete','booking_visit_delete')->name('user_visit_booking_delete');
                Route::any('/confirm','booking_visit_confirm')->name('user_visit_booking_confirm');
                Route::any('/submit','booking_visit_submit')->name('user_visit_booking_submit');
            });   
        });
    });

    //PROFILE
    Route::controller(ProfileController::class)->group(function() {
        Route::group(['prefix' => 'profile'], function() {
            Route::get('/view', 'view')->name('profile-view');
            Route::get('/edit', 'edit')->name('profile-edit');
            Route::post('/edit/save', 'save')->name('profile-edit-save');
            Route::get('/change-password', 'changePwd')->name('profile-change-password');
            Route::post('/change-password/save', 'saveChangePwd')->name('profile-change-password-save');
        });
    });
});

//LOGIN
Route::controller(LoginController::class)->group(function() {
    Route::get('/login/page', 'showLogin')->name('login-page');
    Route::any('/login', 'login')->name('login');
});


//REGISTER
Route::controller(RegisterController::class)->group(function() {
    Route::get('/register/page', 'showRegister')->name('register-page');
    Route::post('/register', 'register')->name('register');
    Route::any('/register/verify/{code}', 'verify')->name('verify');
});


//FORGOT PASWORD
Route::controller(ForgotPasswordController::class)->group(function() {
    Route::get('/forgot-password/page', 'showForgotPwd')->name('forgot-password-page');
    Route::post('/forgot-password/confirm', 'confirmEmail')->name('forgot-password-confirm');
    Route::any('/forgot-password/verify/{code}', 'verify')->name('forgot-password-verify');
    Route::any('/forgot-password/reset', 'resetPwd')->name('forgot-password-reset');
});


//LOGOUT
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');


//HOME_ROUTE
Route::get('/', [HomeController::class, 'home_route'])->name('home_route');
