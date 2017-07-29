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

use App\Question;

Route::get( '/', function ()
{
    return view( 'welcome' );
} );

Auth::routes();

Route::get( '/home', 'HomeController@index' )->name( 'home' );


Route::get( 'profile/{id}', 'UserController@profile' )->name( 'profile' );


Route::get( '/search', 'UserController@search')->name('search') ;


Route::get( '/question/{id}', function ($id)
{
    $qt = Question::find( $id );
    $answers = $qt->answers;

    return view( 'question' )->with( ['qt' => $qt, 'anws' => $answers] );

} )->name( 'question' );

Route::post( '/new_answer', 'UserController@postAnswer' )->name( 'new_answer' );

Route::post( '/postDisc', 'UserController@postDisc' )->name( 'postDisc' );

Route::get( '/discussions/{topic_id}', 'UserController@chatDiscussion')->name('chat') ;


Route::get( '/askQuestion', 'UserController@askQuestion' )->name( 'askQuestion' );


Route::post( '/postQuestion', 'UserController@postQuestion' )->name( 'postQuestion' );




