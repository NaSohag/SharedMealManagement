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

Route::get('/', [
	'uses' => 'UserController@loginForm',
	'as' => 'root'
]);

//----------------- user login below

Route::get('/dashboard',[
	'uses' => 'UserController@dahsboardView',
	'as' => 'dashboard',
	'middleware' => 'auth'
]);

Route::post('/signup',[
	'uses' => 'UserController@signUp',
	'as' => 'signup'
]);

Route::post('/login',[
	'uses' => 'UserController@logIn',
	'as' => 'login'
]);

Route::get('/logout',[
	'uses' => 'UserController@logOut',
	'as' => 'logout'
]);

//---------------- admin login below


Route::group(['middleware'=>'auth:web'],function(){

	Route::get('/admin',[
		'uses' => 'AdminController@adminLoginForm',
		'as' => 'admin.root',
	]);


	Route::get('/admin-dashboard',[
		'uses' => 'AdminController@adminDahsboardView',
		'as' => 'admin.dashboard',
		'middleware' => 'auth:admin'
	]);

	Route::post('/admin-signup',[
		'uses' => 'AdminController@adminSignUp',
		'as' => 'admin.signup'
	]);

	Route::post('/admin-login',[
		'uses' => 'AdminController@adminLogIn',
		'as' => 'admin.login'
	]);

	Route::get('/admin-logout',[
		'uses' => 'AdminController@adminLogOut',
		'as' => 'admin.logout'
	]);

	//----------------------- manager controller below

	Route::get('/manager-all',[
		'uses' => 'ManagerController@showAllManager',
		'as' => 'show.all.manager'
	]);

	Route::get('/member-all/{manager_id}',[
		'uses' => 'ManagerController@showAllMember',
		'as' => 'show.all.member'
	]);

	Route::get('/all-meal/{manager_id}',[
		'uses' => 'ManagerController@showMembersMeal',
		'as' => 'show.all.meal'
	]);

	Route::get('/all-joma/{manager_id}',[
		'uses' => 'ManagerController@showAllJoma',
		'as' => 'show.all.joma'
	]);

	Route::get('/bazar-expend/{manager_id}',[
		'uses' => 'ManagerController@showBazarExpend',
		'as' => 'show.bazar.expend'
	]);

	Route::get('/extra-expend/{manager_id}',[
		'uses' => 'ManagerController@showExtraExpend',
		'as' => 'show.extra.expend'
	]);

	Route::get('/summary/{manager_id}',[
		'uses' => 'SummaryController@showSummary',
		'as' => 'show.summary'
	]);

	//---------------------- admin access only
	Route::group(['middleware'=>'auth:admin'],function(){

		Route::get('/manager-create',[
			'uses' => 'ManagerController@getCreateManager',
			'as' => 'manager.create.get'
		]);

		Route::post('/manager-create',[
			'uses' => 'ManagerController@postCreateManager',
			'as' => 'manager.create.post'
		]);

		Route::post('/member-add',[
			'uses' => 'ManagerController@addMember',
			'as' => 'member.add'
		]);

		Route::post('/meal-add',[
			'uses' => 'ManagerController@addMeal',
			'as' => 'meal.add'
		]);

		Route::get('/all-meal-edit-date/{manager_id}/{edit_date}',[
			'uses' => 'ManagerController@showMembersMealEditDate',
			'as' => 'show.all.meal.edit.date'
		]);

		Route::post('/add-meal-by-date',[
			'uses' => 'ManagerController@addMealByDate',
			'as' => 'add.meal.by.date'
		]);


		Route::post('/bazar-expend-add',[
			'uses' => 'ManagerController@addBazarExpend',
			'as' => 'add.bazar.expend'
		]);

		Route::post('/extra-expend-add',[
			'uses' => 'ManagerController@addExtraExpend',
			'as' => 'add.extra.expend'
		]);


		Route::post('/add-balance',[
			'uses' => 'ManagerController@addBalance',
			'as' => 'add.balance'
		]);

		Route::post('/edit-extra-expend',[
			'uses' => 'ManagerController@editExtraExpend',
			'as' => 'edit.extra.expend'
		]);

		Route::post('/edit-bazar-expend',[
			'uses' => 'ManagerController@editBazarExpend',
			'as' => 'edit.bazar.expend'
		]);

		Route::get('/delete-balance/{takajoma_id}',[
			'uses' => 'ManagerController@deleteBalance',
			'as' => 'delete.balance'
		]);

		Route::get('/delete-bazar-expend/{bazarexp_id}',[
			'uses' => 'ManagerController@deleteBazarExpend',
			'as' => 'delete.bazar.expend'
		]);

		Route::get('/delete-extra-expend/{extraexp_id}',[
			'uses' => 'ManagerController@deleteExtraExpend',
			'as' => 'delete.extra.expend'
		]);

	});

});