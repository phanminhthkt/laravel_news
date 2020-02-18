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

	/*Permission */
	Route::get('/permission',
		['uses' => 'BackEnd\PermissionController@index'
		 ,'as'	=> 'PermissionList'
		 // ,'middleware' => ['role:Master Admin']
		 //Phân theo name Role
		 ,'middleware' => 'permission:Permission List|All' 
		 // Roles nào có permission All mới xem được module Permission List
		]);

	// Route::get('/permission',
	// 	['uses' => 'BackEnd\PermissionController@index'
	// 	 ,'as'	=> 'PermissionList'
	// 	]);
	Route::get('/permission/add',
		['uses' => 'BackEnd\PermissionController@create'
		,'as'	=> 'PermissionCreate'
		,'middleware' => 'permission:Permission List|All'
		]);
	Route::get('/permission/edit',
		['uses' => 'BackEnd\PermissionController@edit'
		,'as' => 'PermissionEdit'
		,'middleware' => 'permission:Permission List|All'
		]);
	Route::post('/permission/store',['uses' => 'BackEnd\PermissionController@store']);

	Route::get('/permission/edit/{id}',
		['uses' => 'BackEnd\PermissionController@edit'
		,'as'	=> 'PermissionEdit'
		,'middleware' => 'permission:Permission List|All'
		]);
	Route::put('/permission/edit/{id}',
		['uses' => 'BackEnd\PermissionController@update'
		,'as'	=> 'PermissionUpdate'
		,'middleware' => 'permission:Permission List|All'
		]);
	Route::delete('/permission/delete/{id}',
		['uses' => 'BackEnd\PermissionController@destroy'
		,'as'	=> 'PermissionDelete'
		,'middleware' => 'permission:Permission List|All'
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
		['uses' => 'BackEnd\RoleController@update'
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

	/*Category */
	Route::get('/category',
		['uses' => 'BackEnd\CategoryController@index'
		 ,'as'	=> 'CategoryList'
		 // ,'middleware' => ['role:Master Admin']
		 //Phân theo name Role
		 // ,'middleware' => 'permission:Permission List|All' 
		 // Roles nào có permission All mới xem được module Permission List
		]);

	// Route::get('/permission',
	// 	['uses' => 'BackEnd\CategoryController@index'
	// 	 ,'as'	=> 'CategoryList'
	// 	]);
	Route::get('/category/add',
		['uses' => 'BackEnd\CategoryController@create'
		,'as'	=> 'CategoryCreate'
		// ,'middleware' => 'permission:Permission List|All'
		]);
	
	Route::post('/category/store',['uses' => 'BackEnd\CategoryController@store']);
	Route::get('/category/edit/{id}',
		['uses' => 'BackEnd\CategoryController@edit'
		,'as' => 'CategoryEdit'
		// ,'middleware' => 'permission:Permission List|All'
		]);
	Route::put('/category/edit/{id}',
		['uses' => 'BackEnd\CategoryController@update'
		,'as'	=> 'CategoryUpdate'
		// ,'middleware' => 'permission:Permission List|All'
		]);
	Route::delete('/category/delete/{id}',
		['uses' => 'BackEnd\CategoryController@destroy'
		,'as'	=> 'CategoryDelete'
		// ,'middleware' => 'permission:Permission List|All'
		]);
	Route::put('/category/status/{id}',
		['uses' => 'BackEnd\CategoryController@status'
		,'as'	=> 'CategoryStatus'
		// ,'middleware' => 'permission:Permission List|All'
		]);
	/*End Category */

	/*Post */
	Route::get('/post',
		['uses' => 'BackEnd\PostController@index'
		 ,'as'	=> 'PostList'
		 // ,'middleware' => ['role:Master Admin']
		 //Phân theo name Role
		 ,'middleware' => 'permission:Post List|All' 
		 // Roles nào có permission All mới xem được module Permission List
		]);

	// Route::get('/permission',
	// 	['uses' => 'BackEnd\PostController@index'
	// 	 ,'as'	=> 'CategoryList'
	// 	]);
	Route::get('/post/add',
		['uses' => 'BackEnd\PostController@create'
		,'as'	=> 'PostCreate'
		,'middleware' => 'permission:Post List|All'
		]);
	
	Route::post('/post/store',
		['uses' => 'BackEnd\PostController@store']
	);
	Route::get('/post/edit/{id}',
		['uses' => 'BackEnd\PostController@edit'
		,'as' => 'PostEdit'
		,'middleware' => 'permission:Post List|All'
		]);
	Route::put('/post/edit/{id}',
		['uses' => 'BackEnd\PostController@update'
		,'as'	=> 'PostUpdate'
		,'middleware' => 'permission:Post List|All'
		]);
	Route::delete('/post/delete/{id}',
		['uses' => 'BackEnd\PostController@destroy'
		,'as'	=> 'PostDelete'
		,'middleware' => 'permission:Post List|All'
		]);
	// Route::get('/post/delete/{id}',
	// 	['uses' => 'BackEnd\PostController@destroy'
	// 	,'as'	=> 'PostDelete'
	// 	,'middleware' => 'permission:Post List|All'
	// 	]);
	Route::put('/post/status/{id}',
		['uses' => 'BackEnd\PostController@status'
		,'as'	=> 'PostStatus'
		,'middleware' => 'permission:Post List|All'
		]);
	Route::put('/post/hot_news/{id}',
		['uses' => 'BackEnd\PostController@hot_news'
		,'as'	=> 'PostHotNews'
		,'middleware' => 'permission:Post List|All'
		]);
	/*End Post */

	/*End Comment */
	Route::get('/comment/add/{id}',
		['uses' => 'BackEnd\CommentController@create'
		,'as'	=> 'CommentCreate'
		,'middleware' => 'permission:Comment List|All'
		]);
	Route::get('/comment/{id}',
		['uses' => 'BackEnd\CommentController@index'
		,'as' => 'CommentList'
		,'middleware' => 'permission:Comment List|All'
		]);
	// Route::put('/comment/reply/{id}',
	// 	['uses' => 'BackEnd\CommentController@reply'
	// 	,'as'	=> 'CommentReply'
	// 	,'middleware' => 'permission:Comment List|All'
	// 	]);
	Route::put('/comment/status/{id}',
		['uses' => 'BackEnd\CommentController@status'
		,'as'	=> 'CommentStatus'
		,'middleware' => 'permission:Comment List|All'
		]);	
	Route::get('/comment/reply/{id}',
		['uses' => 'BackEnd\CommentController@reply'
		,'as'	=> 'CommentView'
		,'middleware' => 'permission:Comment List|All'
		]);
	Route::post('/comment/reply',
		['uses' => 'BackEnd\CommentController@store'
		,'as'	=> 'CommentReply'
		,'middleware' => 'permission:Comment List|All'
		]);
	
	/*End Comment */

});
Route::get('/query',['uses' => 'DBController@index']);
Route::get('/query/join',['uses' => 'DBController@joining']);
Route::get('/model',['uses' => 'DBController@model']);


/*Back-End */
Auth::routes();
Route::get('/home', ['uses' => 'HomeController@index_backend','as' => 'home','middleware' => 'auth']);
/*End Back-End */