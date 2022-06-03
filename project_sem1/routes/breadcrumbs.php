<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home/
Breadcrumbs::for('home', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->push('Home', route('home',['confirmation_code'=>$confirmation_code]));
});

// Home > about_us/
Breadcrumbs::for('about_us', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('About Us', route('about_us',['confirmation_code'=>$confirmation_code]));
});

// Home > contact_us/
Breadcrumbs::for('contact_us', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Contact Us', route('contact_us',['confirmation_code'=>$confirmation_code]));
});

// Home > feedback/
Breadcrumbs::for('feedback', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Feedback', route('user_feedback_add',['confirmation_code'=>$confirmation_code]));
});

// Home > ticket price/
Breadcrumbs::for('ticket_price', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Ticket Prices', route('ticket_price',['confirmation_code'=>$confirmation_code]));
});

// Home > faqs/
Breadcrumbs::for('faqs', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Frequently-Asked-Questions', route('faqs',['confirmation_code'=>$confirmation_code]));
});

// Home > search/
Breadcrumbs::for('search', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Search-Results', route('search',['confirmation_code'=>$confirmation_code]));
});

// Home > animal_guide/
Breadcrumbs::for('animal_guide', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Animal-Guide', route('user_animal_list',['confirmation_code'=>$confirmation_code]));
});

// animal_guide > user_animal_search/
Breadcrumbs::for('user_animal_search', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('animal_guide',$confirmation_code);
    $trail->push('search', route('user_animal_search',['confirmation_code'=>$confirmation_code]));
});

// animal_guide > animal_detail/
Breadcrumbs::for('animal_detail', function (BreadcrumbTrail $trail,$confirmation_code,$hrefParam) {
    $trail->parent('animal_guide',$confirmation_code);
    $trail->push($hrefParam, route('user_animal_detail',['confirmation_code'=>$confirmation_code,'hrefParam'=>$hrefParam]));
});

// Home > event_list/
Breadcrumbs::for('event_list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Event-Guide', route('event-view',['confirmation_code'=>$confirmation_code]));
});

// event_list > event_detail/
Breadcrumbs::for('event_detail', function (BreadcrumbTrail $trail,$confirmation_code,$href_param) {
    $trail->parent('event_list',$confirmation_code);
    $trail->push($href_param, route('event-detail',['confirmation_code'=>$confirmation_code,'href_param'=>$href_param]));
});

// event_list > event-view-filter/
Breadcrumbs::for('event-view-filter', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('event_list',$confirmation_code);
    $trail->push('Search', route('event-view-filter',['confirmation_code'=>$confirmation_code]));
});

// Home > post_guide /
Breadcrumbs::for('post_guide', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Post-Guide', route('user_post_list',['confirmation_code'=>$confirmation_code]));
});

// post_guide > post_detail /
Breadcrumbs::for('post_detail', function (BreadcrumbTrail $trail,$confirmation_code,$hrefParam) {
    $trail->parent('post_guide',$confirmation_code);
    $trail->push($hrefParam, route('user_post_detail',['confirmation_code'=>$confirmation_code,'hrefParam'=>$hrefParam]));
});

// Home > booking_list /
Breadcrumbs::for('booking_list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Booking List', route('user_booking_list',['confirmation_code'=>$confirmation_code]));
});

// Home > user_visit_booking_details
Breadcrumbs::for('user_visit_booking_details', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Visit-Details', route('user_visit_booking_details',['confirmation_code'=>$confirmation_code]));
});

// user_visit_booking_details > user_visit_booking_form
Breadcrumbs::for('user_visit_booking_form', function (BreadcrumbTrail $trail,$confirmation_code,$id_old_booking_adults,$id_old_booking_children) {
    $trail->parent('user_visit_booking_details',$confirmation_code);
    $trail->push('Form', route('user_visit_booking_form',['confirmation_code'=>$confirmation_code,'id_old_booking_adults'=>$id_old_booking_adults,'id_old_booking_children'=>$id_old_booking_children]));
});

// user_visit_booking_form > user_visit_booking_confirm
Breadcrumbs::for('user_visit_booking_confirm', function (BreadcrumbTrail $trail,$confirmation_code,$id_old_booking_adults,$id_old_booking_children) {
    $trail->parent('user_visit_booking_form',$confirmation_code,$id_old_booking_adults,$id_old_booking_children);
    $trail->push('Confirm', route('user_visit_booking_confirm',['confirmation_code'=>$confirmation_code]));
});

// user_visit_booking_confirm > user_visit_booking_submit
Breadcrumbs::for('user_visit_booking_submit', function (BreadcrumbTrail $trail,$confirmation_code,$id_old_booking_adults,$id_old_booking_children) {
    $trail->parent('user_visit_booking_confirm',$confirmation_code,$id_old_booking_adults,$id_old_booking_children);
    $trail->push('Submit-Successful', route('user_visit_booking_confirm',['confirmation_code'=>$confirmation_code]));
});

// user_visit_booking_confirm > user_visit_booking_edit
Breadcrumbs::for('user_visit_booking_edit', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('user_visit_booking_details',$confirmation_code);
    $trail->push('Edit', route('user_visit_booking_edit',['confirmation_code'=>$confirmation_code]));
});

// booking_list > user_visit_booking_delete
Breadcrumbs::for('user_visit_booking_delete', function (BreadcrumbTrail $trail,$confirmation_code,$id_old_booking_adults,$id_old_booking_children) {
    $trail->parent('booking_list',$confirmation_code);
    $trail->push('Delete', route('user_visit_booking_delete',['confirmation_code'=>$confirmation_code,'id_old_booking_adults'=>$id_old_booking_adults,'id_old_booking_children'=>$id_old_booking_children]));
});

// event_detail > user_event_booking_form /
Breadcrumbs::for('user_event_booking_form', function (BreadcrumbTrail $trail,$confirmation_code,$href_param,$id_old_booking_event) {
    $trail->parent('event_detail',$confirmation_code,$href_param);
    $trail->push('Booking-form', route('user_event_booking_form',['confirmation_code'=>$confirmation_code,'href_param'=>$href_param,'id_old_booking_event'=>$id_old_booking_event]));
});

// user_event_booking_form > user_event_booking_confirm /
Breadcrumbs::for('user_event_booking_confirm', function (BreadcrumbTrail $trail,$confirmation_code,$href_param,$id_old_booking_event) {
    $trail->parent('user_event_booking_form',$confirmation_code,$href_param,$id_old_booking_event);
    $trail->push('Booking-Confirm', route('user_event_booking_confirm',['confirmation_code'=>$confirmation_code,'href_param'=>$href_param]));
});

// user_event_booking_confirm > user_event_booking_submit /
Breadcrumbs::for('user_event_booking_submit', function (BreadcrumbTrail $trail,$confirmation_code,$href_param,$id_old_booking_event) {
    $trail->parent('user_event_booking_confirm',$confirmation_code,$href_param,$id_old_booking_event);
    $trail->push('Booking-Submitted', route('user_event_booking_submit',['confirmation_code'=>$confirmation_code,'href_param'=>$href_param]));
});

// user_event_booking_confirm > user_event_booking_edit /
Breadcrumbs::for('user_event_booking_edit', function (BreadcrumbTrail $trail,$confirmation_code,$href_param,$id_old_booking_event) {
    $trail->parent('user_event_booking_confirm',$confirmation_code,$href_param,$id_old_booking_event);
    $trail->push('Booking-Edit', route('user_event_booking_edit',['confirmation_code'=>$confirmation_code,'href_param'=>$href_param]));
});

// booking_list > user_event_booking_delete /
Breadcrumbs::for('user_event_booking_delete', function (BreadcrumbTrail $trail,$confirmation_code,$href_param,$id_old_booking_event) {
    $trail->parent('booking_list',$confirmation_code);
    $trail->push('Booking-Delete', route('user_event_booking_delete',['confirmation_code'=>$confirmation_code,'href_param'=>$href_param,'id_old_booking_event'=>$id_old_booking_event]));
});

// Home > profile-view /
Breadcrumbs::for('profile-view', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Profile', route('profile-view',['confirmation_code'=>$confirmation_code]));
});

// profile-view > profile-edit /
Breadcrumbs::for('profile-edit', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('profile-view',$confirmation_code);
    $trail->push('Edit', route('profile-edit',['confirmation_code'=>$confirmation_code]));
});

// profile-view > profile-change-password /
Breadcrumbs::for('profile-change-password', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('profile-view',$confirmation_code);
    $trail->push('Change-Password', route('profile-change-password',['confirmation_code'=>$confirmation_code]));
});

// Home > login
Breadcrumbs::for('login-page', function (BreadcrumbTrail $trail) {
    $trail->parent('home',"guest");
    $trail->push('Login', route('login-page'));
});

// Home > register-page
Breadcrumbs::for('register-page', function (BreadcrumbTrail $trail) {
    $trail->parent('home',"guest");
    $trail->push('Register', route('register-page'));
});

// register-page > register
Breadcrumbs::for('register', function (BreadcrumbTrail $trail) {
    $trail->parent('register-page');
    $trail->push('Verify-Email', route('register'));
});

// login > forgot-password-page
Breadcrumbs::for('forgot-password-page', function (BreadcrumbTrail $trail) {
    $trail->parent('login-page');
    $trail->push('Forgot-Password', route('forgot-password-page'));
});

// forgot-password-page > forgot-password-confirm
Breadcrumbs::for('forgot-password-confirm', function (BreadcrumbTrail $trail) {
    $trail->parent('forgot-password-page');
    $trail->push('Verify-Email', route('forgot-password-confirm'));
});

// forgot-password-confirm > forgot-password-reset
Breadcrumbs::for('forgot-password-reset', function (BreadcrumbTrail $trail) {
    $trail->parent('forgot-password-page');
    $trail->push('Reset-Password', route('forgot-password-reset'));
});

// Home > home_admin
Breadcrumbs::for('home_admin', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home',$confirmation_code);
    $trail->push('Admin', route('home_admin',['confirmation_code'=>$confirmation_code]));
});

// home_admin > admin_categoryAnimal_list
Breadcrumbs::for('admin_categoryAnimal_list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('Animal-Categories', route('admin_categoryAnimal_list',['confirmation_code'=>$confirmation_code]));
});

// admin_categoryAnimal_list > admin_animal_list
Breadcrumbs::for('admin_animal_list', function (BreadcrumbTrail $trail,$confirmation_code,$id_category,$species) {
    $trail->parent('admin_categoryAnimal_list',$confirmation_code);
    $trail->push($species->name, route('admin_animal_list',['confirmation_code'=>$confirmation_code,'id_category'=>$id_category]));
});

// admin_categoryAnimal_list > admin_categoryAnimal_add
Breadcrumbs::for('admin_categoryAnimal_add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('admin_categoryAnimal_list',$confirmation_code);
    $trail->push('add', route('admin_categoryAnimal_add',['confirmation_code'=>$confirmation_code]));
});

// admin_categoryAnimal_list > admin_categoryAnimal_edit
Breadcrumbs::for('admin_categoryAnimal_edit', function (BreadcrumbTrail $trail,$confirmation_code,$id_category) {
    $trail->parent('admin_categoryAnimal_list',$confirmation_code);
    $trail->push('edit', route('admin_categoryAnimal_edit',['confirmation_code'=>$confirmation_code,'id_category'=>$id_category]));
});

// admin_categoryAnimal_list > admin_categoryAnimal_delete
Breadcrumbs::for('admin_categoryAnimal_delete', function (BreadcrumbTrail $trail,$confirmation_code,$id_category) {
    $trail->parent('admin_categoryAnimal_list',$confirmation_code);
    $trail->push('delete', route('admin_categoryAnimal_delete',['confirmation_code'=>$confirmation_code,'id_category'=>$id_category]));
});

// admin_animal_list > admin_animal_add
Breadcrumbs::for('admin_animal_add', function (BreadcrumbTrail $trail,$confirmation_code,$id_category,$species) {
    $trail->parent('admin_animal_list',$confirmation_code,$id_category,$species);
    $trail->push('add', route('admin_animal_add',['confirmation_code'=>$confirmation_code,'id_category'=>$id_category]));
});

// admin_animal_list > admin_animal_edit
Breadcrumbs::for('admin_animal_edit', function (BreadcrumbTrail $trail,$confirmation_code,$id_category,$species,$animal) {
    $trail->parent('admin_animal_list',$confirmation_code,$id_category,$species);
    $trail->push($animal->normal_name.' / edit', route('admin_animal_edit',['confirmation_code'=>$confirmation_code,'id_animal'=>$animal->id]));
});

// admin_animal_list > admin_animal_delete
Breadcrumbs::for('admin_animal_delete', function (BreadcrumbTrail $trail,$confirmation_code,$id_category,$species,$animal) {
    $trail->parent('admin_animal_list',$confirmation_code,$id_category,$species);
    $trail->push($animal->normal_name.' / delete', route('admin_animal_delete',['confirmation_code'=>$confirmation_code,'id_animal'=>$animal->id]));
});

// home_admin > admin_categoriesPost_list
Breadcrumbs::for('admin_categoriesPost_list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('Post-Categories', route('admin_categoriesPost_list',['confirmation_code'=>$confirmation_code]));
});

// admin_categoriesPost_list > admin_post_list
Breadcrumbs::for('admin_post_list', function (BreadcrumbTrail $trail,$confirmation_code,$id_category,$category) {
    $trail->parent('admin_categoriesPost_list',$confirmation_code);
    $trail->push($category->name, route('admin_post_list',['confirmation_code'=>$confirmation_code,'id_category'=>$id_category]));
});

// admin_categoriesPost_list > admin_categoriesPost_add
Breadcrumbs::for('admin_categoriesPost_add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('admin_categoriesPost_list',$confirmation_code);
    $trail->push('add', route('admin_categoriesPost_add',['confirmation_code'=>$confirmation_code]));
});

// admin_categoriesPost_list > admin_categoriesPost_edit
Breadcrumbs::for('admin_categoriesPost_edit', function (BreadcrumbTrail $trail,$confirmation_code,$id_category,$category) {
    $trail->parent('admin_categoriesPost_list',$confirmation_code);
    $trail->push($category->name.' / edit', route('admin_categoriesPost_edit',['confirmation_code'=>$confirmation_code,'id_category'=>$id_category]));
});

// admin_categoriesPost_list > admin_categoriesPost_delete
Breadcrumbs::for('admin_categoriesPost_delete', function (BreadcrumbTrail $trail,$confirmation_code,$id_category,$category) {
    $trail->parent('admin_categoriesPost_list',$confirmation_code);
    $trail->push($category->name.' / delete', route('admin_categoriesPost_delete',['confirmation_code'=>$confirmation_code,'id_category'=>$id_category]));
});

// admin_post_list > admin_post_add
Breadcrumbs::for('admin_post_add', function (BreadcrumbTrail $trail,$confirmation_code,$id_category,$category) {
    $trail->parent('admin_post_list',$confirmation_code,$id_category,$category);
    $trail->push('add', route('admin_post_add',['confirmation_code'=>$confirmation_code,'id_category'=>$id_category]));
});

// admin_post_list > admin_post_edit
Breadcrumbs::for('admin_post_edit', function (BreadcrumbTrail $trail,$confirmation_code,$id_category,$category,$post) {
    $trail->parent('admin_post_list',$confirmation_code,$id_category,$category);
    $trail->push($post->title.' / edit', route('admin_post_edit',['confirmation_code'=>$confirmation_code,'id_post'=>$post->id]));
});

// admin_post_list > admin_post_delete
Breadcrumbs::for('admin_post_delete', function (BreadcrumbTrail $trail,$confirmation_code,$id_category,$category,$post) {
    $trail->parent('admin_post_list',$confirmation_code,$id_category,$category);
    $trail->push($post->title.' / delete', route('admin_post_delete',['confirmation_code'=>$confirmation_code,'id_post'=>$post->id]));
});

// home_admin > admin_author_list
Breadcrumbs::for('admin_author_list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('Authors', route('admin_author_list',['confirmation_code'=>$confirmation_code]));
});

// admin_author_list > admin_author_add
Breadcrumbs::for('admin_author_add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('admin_author_list',$confirmation_code);
    $trail->push('add', route('admin_author_add',['confirmation_code'=>$confirmation_code]));
});

// admin_author_list > admin_author_edit
Breadcrumbs::for('admin_author_edit', function (BreadcrumbTrail $trail,$confirmation_code,$author) {
    $trail->parent('admin_author_list',$confirmation_code);
    $trail->push($author->name.' / edit', route('admin_author_edit',['confirmation_code'=>$confirmation_code,'id_author'=>$author->id]));
});

// admin_author_list > admin_author_delete
Breadcrumbs::for('admin_author_delete', function (BreadcrumbTrail $trail,$confirmation_code,$author) {
    $trail->parent('admin_author_list',$confirmation_code);
    $trail->push($author->name.' / delete', route('admin_author_delete',['confirmation_code'=>$confirmation_code,'id_author'=>$author->id]));
});

// home_admin > admin_range_list
Breadcrumbs::for('admin_range_list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('Ranges', route('admin_range_list',['confirmation_code'=>$confirmation_code]));
});

// admin_range_list > admin_range_add
Breadcrumbs::for('admin_range_add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('admin_range_list',$confirmation_code);
    $trail->push('add', route('admin_range_add',['confirmation_code'=>$confirmation_code]));
});

// admin_range_list > admin_range_edit
Breadcrumbs::for('admin_range_edit', function (BreadcrumbTrail $trail,$confirmation_code,$range) {
    $trail->parent('admin_range_list',$confirmation_code);
    $trail->push($range->name.' / edit', route('admin_range_edit',['confirmation_code'=>$confirmation_code,'id_range'=>$range->id]));
});

// admin_range_list > admin_range_delete
Breadcrumbs::for('admin_range_delete', function (BreadcrumbTrail $trail,$confirmation_code,$range) {
    $trail->parent('admin_range_list',$confirmation_code);
    $trail->push($range->name.' / delete', route('admin_range_delete',['confirmation_code'=>$confirmation_code,'id_range'=>$range->id]));
});

// home_admin > admin_rand_backgrounds_list
Breadcrumbs::for('admin_rand_backgrounds_list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('Random-Backgrounds', route('admin_rand_backgrounds_list',['confirmation_code'=>$confirmation_code]));
});

// admin_rand_backgrounds_list > admin_rand_backgrounds_add
Breadcrumbs::for('admin_rand_backgrounds_add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('admin_rand_backgrounds_list',$confirmation_code);
    $trail->push('add', route('admin_rand_backgrounds_add',['confirmation_code'=>$confirmation_code]));
});

// admin_rand_backgrounds_list > admin_rand_backgrounds_edit
Breadcrumbs::for('admin_rand_backgrounds_edit', function (BreadcrumbTrail $trail,$confirmation_code,$background) {
    $trail->parent('admin_rand_backgrounds_list',$confirmation_code);
    $trail->push($background->name.' / edit', route('admin_rand_backgrounds_edit',['confirmation_code'=>$confirmation_code,'id_background'=>$background->id]));
});

// admin_rand_backgrounds_list > admin_rand_backgrounds_delete
Breadcrumbs::for('admin_rand_backgrounds_delete', function (BreadcrumbTrail $trail,$confirmation_code,$background) {
    $trail->parent('admin_rand_backgrounds_list',$confirmation_code);
    $trail->push($background->name.' / delete', route('admin_rand_backgrounds_delete',['confirmation_code'=>$confirmation_code,'id_background'=>$background->id]));
});

// home_admin > new_admin-add
Breadcrumbs::for('new_admin-add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('New Admin', route('new_admin-add',['confirmation_code'=>$confirmation_code]));
});

// home_admin > users-list
Breadcrumbs::for('users-list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('User-list', route('users-list',['confirmation_code'=>$confirmation_code]));
});

// users-list > users-add
Breadcrumbs::for('users-add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('users-list',$confirmation_code);
    $trail->push('add-user', route('users-add',['confirmation_code'=>$confirmation_code]));
});

// users-list > users-edit
Breadcrumbs::for('users-edit', function (BreadcrumbTrail $trail,$confirmation_code,$users) {
    $trail->parent('users-list',$confirmation_code);
    $trail->push($users->fullname.' / edit', route('users-edit',['confirmation_code'=>$confirmation_code,'id'=>$users->id]));
});

// home_admin > event_category-list
Breadcrumbs::for('event_category-list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('Event-Categories', route('event_category-list',['confirmation_code'=>$confirmation_code]));
});

// event_category-list > event_category-add
Breadcrumbs::for('event_category-add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('event_category-list',$confirmation_code);
    $trail->push('add', route('event_category-add',['confirmation_code'=>$confirmation_code]));
});

// event_category-list > event_category-edit
Breadcrumbs::for('event_category-edit', function (BreadcrumbTrail $trail,$confirmation_code,$category) {
    $trail->parent('event_category-list',$confirmation_code);
    $trail->push($category->name.' / edit', route('event_category-edit',['confirmation_code'=>$confirmation_code,'id'=>$category->id]));
});

// home_admin > events-list
Breadcrumbs::for('events-list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('Events', route('events-list',['confirmation_code'=>$confirmation_code]));
});

// events-list > events-add
Breadcrumbs::for('events-add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('events-list',$confirmation_code);
    $trail->push('add', route('events-add',['confirmation_code'=>$confirmation_code]));
});

// events-list > events-edit
Breadcrumbs::for('events-edit', function (BreadcrumbTrail $trail,$confirmation_code,$events) {
    $trail->parent('events-list',$confirmation_code);
    $trail->push($events->title.' / edit', route('events-edit',['confirmation_code'=>$confirmation_code,'id'=>$events->id]));
});

// home_admin > bookings-list
Breadcrumbs::for('bookings-list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('Bookings', route('bookings-list',['confirmation_code'=>$confirmation_code]));
});

// bookings-list > bookings-add
Breadcrumbs::for('bookings-add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('bookings-list',$confirmation_code);
    $trail->push('add', route('bookings-add',['confirmation_code'=>$confirmation_code]));
});

// bookings-add > bookings-add-confirm
Breadcrumbs::for('bookings-add-confirm', function (BreadcrumbTrail $trail,$confirmation_code,$id_event) {
    $trail->parent('bookings-add',$confirmation_code);
    $trail->push('confirm', route('bookings-add-confirm',['confirmation_code'=>$confirmation_code,'id_event'=>$id_event]));
});

// bookings-list > bookings-edit
Breadcrumbs::for('bookings-edit', function (BreadcrumbTrail $trail,$confirmation_code,$id_booking,$id_event) {
    $trail->parent('bookings-list',$confirmation_code);
    $trail->push('edit', route('bookings-edit',['confirmation_code'=>$confirmation_code,'id_booking'=>$id_booking,'id_event'=>$id_event]));
});

// bookings-edit > bookings-edit-confirm
Breadcrumbs::for('bookings-edit-confirm', function (BreadcrumbTrail $trail,$confirmation_code,$id_booking,$id_event) {
    $trail->parent('bookings-edit',$confirmation_code,$id_booking,$id_event);
    $trail->push('confirm', route('bookings-edit-confirm',['confirmation_code'=>$confirmation_code,'id_booking'=>$id_booking,'id_event'=>$id_event]));
});

// home_admin > feedback_category-list
Breadcrumbs::for('feedback_category-list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('Feedback-Categories', route('feedback_category-list',['confirmation_code'=>$confirmation_code]));
});

// feedback_category-list > feedback_category-add
Breadcrumbs::for('feedback_category-add', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('feedback_category-list',$confirmation_code);
    $trail->push('add', route('feedback_category-add',['confirmation_code'=>$confirmation_code]));
});

// feedback_category-list > feedback_category-edit
Breadcrumbs::for('feedback_category-edit', function (BreadcrumbTrail $trail,$confirmation_code,$category) {
    $trail->parent('feedback_category-list',$confirmation_code);
    $trail->push($category->name.' / edit', route('feedback_category-edit',['confirmation_code'=>$confirmation_code,'id'=>$category->id]));
});

// home_admin > feedbacks-list
Breadcrumbs::for('feedbacks-list', function (BreadcrumbTrail $trail,$confirmation_code) {
    $trail->parent('home_admin',$confirmation_code);
    $trail->push('Feedbacks', route('feedbacks-list',['confirmation_code'=>$confirmation_code]));
});

// feedbacks-list > feedbacks-edit
Breadcrumbs::for('feedbacks-edit', function (BreadcrumbTrail $trail,$confirmation_code,$feedbacks) {
    $trail->parent('feedbacks-list',$confirmation_code);
    $trail->push('id:'.$feedbacks->id.' / edit', route('feedbacks-edit',['confirmation_code'=>$confirmation_code,'id'=>$feedbacks->id]));
});






 