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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::group([
    'middleware' => ['auth','rbac']
], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    // rbac => role
    Route::group([
        'namespace' => 'Rbac',
        'prefix'    => 'role'
    ], function () {
        Route::get('/','RoleController@index')->name('role/index');
        Route::match(['get', 'post'], '/create', 'RoleController@create')->name('role/create');
        Route::match(['get', 'post'], '/update/{id}', 'RoleController@update')->name('role/update');
        Route::get('/del/{id}', 'RoleController@del')->name('role/del');
        Route::get('/recover/{id}', 'RoleController@recover')->name('role/recover');
        Route::get('/{id}/permissions', 'RoleController@permissions')->name('role/permissions');
        Route::post('/{id}/updatePermissions', 'RoleController@updatePermissions')->name('role/updatePermissions');
    });

    // rbac => permission
    Route::group([
        'namespace' => 'Rbac',
        'prefix'    => 'permission'
    ], function () {
        Route::get('/','PermissionController@index')->name('permission/index');
        Route::match(['get', 'post'], '/create', 'PermissionController@create')->name('permission/create');
        Route::match(['get', 'post'], '/update/{id}', 'PermissionController@update')->name('permission/update');
        Route::get('/del/{id}', 'PermissionController@del')->name('permission/del');
        Route::get('/recover/{id}', 'PermissionController@recover')->name('permission/recover');
    });

    // rbac => menu
    Route::group([
        'namespace' => 'Rbac',
        'prefix'    => 'menu'
    ], function () {
        Route::resource('/','MenuController');
    });


});


