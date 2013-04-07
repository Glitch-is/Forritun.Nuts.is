<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/',function(){
	return View::make('forritun.announcements')
		->with('announcements',Announcement::with('member')->paginate(10));
})->before('auth');

Route::get('/profile',function(){
	return View::make('forritun.profile');
});

Route::post('/profile',function(){
	$member = Auth::user();
	$member->email = Input::get( 'email' );
    $member->name = Input::get('name');
    $member->phone = Input::get('phone');
    if (Input::has('password'))
    {
    	$member->password = Input::get( 'password' );
    	$member->password_confirmation = Input::get( 'password_confirmation' );
    }
    $member->save();
    $error = $member->errors()->all(':message');
    if (empty($error))
    	return Redirect::to('/');
    return Redirect::to('/login')->with('error',$error);
});

Route::get('/faq', function(){
	return View::make('forritun.faq');
});


Route::get('/login','MemberController@getLogin');
Route::post('/login','MemberController@postLogin');
Route::get('/register', 'MemberController@getCreate');
Route::post('/register', 'MemberController@postIndex');
Route::get('/logout','MemberController@getLogout');
Route::get('/forgot','MemberController@getForgot');
Route::post('/forgot','MemberController@postForgot');
Route::get('/reset/{token}','MemberController@getReset');
Route::post('/reset','MemberController@postReset');

Route::controller( 'admin/announcement', 'AnnouncementController');
Route::controller('admin','AdminController');