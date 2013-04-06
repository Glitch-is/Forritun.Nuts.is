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
	return 'Hello!';
})->before('auth');

Route::get('/members',function(){
	return View::make('forritun.members')->with('members',Member::all());
})->before('auth');


Route::get('/login','MemberController@getLogin');
Route::post('/login','MemberController@postLogin');
Route::get('/register', 'MemberController@getCreate');
Route::post('/register', 'MemberController@postIndex');
Route::get('/logout','MemberController@getLogout');

Route::filter('auth', function()
{
    if ( Auth::guest() ) // If the user is not logged in
    {
        // Set the loginRedirect session variable
        Session::put( 'loginRedirect', Request::url() );

        // Redirect back to user login
        return Redirect::to( '/login' );
    }
});
//Route::controller( 'user', 'MemberController');