<?php

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


Route::get( '/', function ()
{
    return view( 'welcome' );
} );

// authentication route
//  login  -- register -- logout

Auth::routes();

// home routes
Route::get( '/home', 'HomeController@index' )->name( 'home' );

Route::get( '/search', 'HomeController@search')->name('search') ;

// profile route

Route::get( 'profile/{id}', 'UserController@profile' )->name( 'profile' );

// allow only Admin to see all users and infos
Route::get('/users' , [
    'uses' => 'UserController@users' ,
    'middleware' => 'admin'
])->name('users') ;

// question controller

Route::get( '/askQuestion', 'QuestionController@create' )->name( 'askQuestion' );

Route::post( '/postQuestion', 'QuestionController@store' )->name( 'postQuestion' );

Route::get( '/question/{id}', 'QuestionController@show' )->name( 'question' );

// route for answers .

Route::post( '/new_answer', 'QuestionController@postAnswer' )->name( 'new_answer' );

Route::post( '/postDisc', 'UserController@postDisc' )->name( 'postDisc' );

Route::get( '/discussions/{topic_id}', 'UserController@chatDiscussion')->name('chat') ;

Route::post('/delete/question/{id}' , 'QuestionController@destroy' )->name('deleteQuestion') ;






