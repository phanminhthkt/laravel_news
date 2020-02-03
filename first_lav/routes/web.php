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
/*Frond-End */
Route::get('',['uses' => 'HomeController@index','as' => 'home']);
Route::get('/listing',['uses' => 'ListingController@index','as' => 'listing']);
Route::get('/details',['uses' => 'DetailController@index','as' => 'detail']);
/*End Frond-End */
Route::group(['prefix' => 'backend','middleware' => 'auth'],function(){
	Route::get('/',['uses' => 'BackEnd\DashboardController@index']);
	/*Category */
	Route::get('/category',['uses' => 'BackEnd\CategoryController@index']);
	Route::get('/category/add',['uses' => 'BackEnd\CategoryController@create']);
	Route::get('/category/edit',['uses' => 'BackEnd\CategoryController@edit']);
	/*End Category */

	/*Permission */
	// Route::get('/permission',
	// 	['uses' => 'BackEnd\PermissionController@index'
	// 	 ,'as'	=> 'PermissionList'
	// 	 ,'middleware' => 'permission:Permission List|All'
	// 	]);

	Route::get('/permission',
		['uses' => 'BackEnd\PermissionController@index'
		 ,'as'	=> 'PermissionList'
		]);
	Route::get('/permission/add',
		['uses' => 'BackEnd\PermissionController@create'
		,'as'	=> 'PermissionCreate'
		]);
	Route::get('/permission/edit',['uses' => 'BackEnd\PermissionController@edit']);
	Route::post('/permission/store',['uses' => 'BackEnd\PermissionController@store']);

	Route::get('/permission/edit/{id}',
		['uses' => 'BackEnd\PermissionController@edit'
		,'as'	=> 'PermissionEdit'
		]);
	Route::put('/permission/edit/{id}',
		['uses' => 'BackEnd\PermissionController@update'
		,'as'	=> 'PermissionUpdate'
		]);
	Route::delete('/permission/delete/{id}',
		['uses' => 'BackEnd\PermissionController@destroy'
		,'as'	=> 'PermissionDelete'
		]);
	/*End Permission */

	/*Roles */
	Route::get('/roles',
		['uses' => 'BackEnd\RoleController@index'
		 ,'as'	=> 'RoleList'
		]);
	Route::get('/roles/add',
		['uses' => 'BackEnd\RoleController@create'
		,'as'	=> 'RoleCreate'
		]);
	Route::get('/roles/edit',['uses' => 'BackEnd\RoleController@edit']);
	Route::post('/roles/store',['uses' => 'BackEnd\RoleController@store']);

	Route::get('/roles/edit/{id}',
		['uses' => 'BackEnd\RoleController@edit'
		,'as'	=> 'RoleEdit'
		]);
	Route::put('/roles/edit/{id}',
		['uses' => 'BackEnd\PermissionController@update'
		,'as'	=> 'RoleUpdate'
		]);
	Route::delete('/roles/delete/{id}',
		['uses' => 'BackEnd\RoleController@destroy'
		,'as'	=> 'RoleDelete'
		]);
	/*End Roles */
	/*Author */
	Route::get('/author',
		['uses' => 'BackEnd\AuthorController@index'
		 ,'as'	=> 'AuthorList'
		]);
	Route::get('/author/add',
		['uses' => 'BackEnd\AuthorController@create'
		 ,'as'	=> 'AuthorCreate'
		]);
	Route::post('/author/store',
		['uses' => 'BackEnd\AuthorController@store'
		 ,'as'	=> 'AuthorStore'
		]);
	Route::get('/author/edit/{id}',
		['uses' => 'BackEnd\AuthorController@edit'
		,'as'	=> 'AuthorEdit'
		]);
	Route::put('/author/edit/{id}',
		['uses' => 'BackEnd\AuthorController@update'
		,'as'	=> 'AuthorUpdate'
		]);	
	Route::delete('/author/delete/{id}',
		['uses' => 'BackEnd\AuthorController@destroy'
		,'as'	=> 'AuthorDelete'
		]);
	/*End Author */
});
Route::get('/query',['uses' => 'DBController@index']);
Route::get('/query/join',['uses' => 'DBController@joining']);
Route::get('/model',['uses' => 'DBController@model']);


/*Back-End */
Auth::routes();
Route::get('/home', ['uses' => 'HomeController@index_backend','as' => 'home','middleware' => 'auth']);
/*End Back-End */