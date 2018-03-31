<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|*/

Route::get('/', function(){
	return view('index', ['result'=>""]);
});


// Route::post('docs', [
// 	'as'=>'search',
// 	'uses'=>'frontend\ViewController@getDocName'
// ]);


//Home
//lists
Route::get('/show', 'UrlsController@getUrls')->name('show');
//add
Route::get('/add', 'UrlsController@add')->name('add');
//edit
Route::get('/edit/{id}', 'UrlsController@editById')->name('editById');
//delete
Route::get('/delete/{id}', 'UrlsController@deleteById')->name('deleteById');
//update
Route::post('/action', 'UrlsController@action')->name('action');
//api-123-link
Route::get('/api-123-link', 'UrlsController@getApiLink')->name('api-123-link');
//New post to View
Route::get('/new-post', 'UrlsController@newPost')->name('new-post');
//call when match auth
Route::get('/auth', 'OAuthenController@blogger')->name('auth');






/*
|--------------------------------------------------------------------------
| My Learn Routes
|--------------------------------------------------------------------------
*/

/*
Route::get('/', function () {

    return view('welcome');

});

Route::get('contact', function(){

	return 'page contact';

});






//Truyen tham so cho Route
Route::get('user/{name}', function($name){

	echo "Chao ban: " . $name;

});

Route::get('sodienthoai/{sdt}', function($sdt){

	echo "So dien thoai: " . $sdt;

})->where(['sdt' => '[0-9]+']);






//Thay doi dinh danh cua Route
Route::get('route1', ['as'=>'r1', function(){

	echo "Day la Route 1";

}]);

Route::get('route2', function(){

	return redirect()->route('r1');

});

Route::get('route3', function(){

	return "Day la route 3";

})->name("r3");

Route::get('route4', function(){

	return redirect()->route('r3');

});


//Route Group
Route::group(['prefix' => 'file'], function(){

	Route::get('{id}', function($id){	

		echo "Tep tin ma so: " . $id;

	})->where(['id' => '[0-9]+']);


	Route::get('{name}', function($name){

		echo "Tep tin ten la: " . $name;

	})->where(['name' => '[a-zA-Z]+']);


	//Controller
	//Goi ham o controller
	Route::get('db/controller', 'MyController@HelloController');

	//Goi ham va truyen du lieu cho controller
	Route::get('db/controller/{item}', 'MyController@GetItem');

	//Chuyen huong qua route 1
	Route::get('db/makeRoute', 'MyController@RedirectRoute');
	
	//Request and Responsive in Controller
	Route::get('db/RepAndRes', 'MyController@ReqAndRes');


});

//Truyen tham so tren URL in Controller
Route::get('getForm', function(){
	return view('postForm');
});
Route::post('postForm', [
	'as'=>'postForm', 
	'uses'=>'MyController@postForm'
]);


//Gui va nhan Cookie trong Request and Response
Route::get('setCookie', 'MyController@setCookie');
Route::get('getCookie', 'MyController@getCookie');

Route::get('upload', function(){
	return view('postFile');
});
Route::post('uploadFile', [
	'as'=>'uploading', 
	'uses'=>'MyController@uploadFile'
]);



//VIEW
Route::get('author/{name}', 'MyController@author');
//view share
View::share('varViewShare', 'Day la bien viewShare');




//BLADE TEMPLATE
Route::get('blade', function(){
	return view('child');
});
*/