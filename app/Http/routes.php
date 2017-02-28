<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::group(['middleware' => ['web']], function () {
	Route::auth();

Route::get('/home', 'HomeController@index');

   Route::resource('post', 'PostController');
   Route::get('blog/{slug}', ['as' => 'post.single', 'uses' => 'PageController@showSingle']);
   Route::get('create-category' , ['as' => 'category.create' , 'uses' => 'CategoryController@getForm']);
   Route::post('save-category' , ['as' => 'category.save' , 'uses' => 'CategoryController@postSave']);
   Route::get('create-tag' , ['as' => 'tag.create' , 'uses' => 'TagController@getForm']);
   Route::post('save-tag' , ['as' => 'tag.save' , 'uses' => 'TagController@postSave']);

});

