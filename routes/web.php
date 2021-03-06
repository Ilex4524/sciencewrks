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

Route::resource('employees', 'EmployeeController');
Route::resource('staff-types', 'StaffTypeController');
Route::resource('departments', 'DepartmentController');

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::get('/signup', 'Auth\SignupController@showSignupForm')->name('signup');
Route::post('/signup', 'Auth\SignupController@signup')->name('signup.submit');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');   
    Route::get('/', 'AdminController@getIndex')->name('admin.dashboard'); 
});

Route::prefix('get')->group(function() {
    Route::resource('user_employees', 'User\EmployeeController');  
    Route::resource('researches', 'User\ResearchController'); 
    Route::get('/researches/{id}/download', 'User\ResearchController@download')->name('researches.download');
});

Route::get('/home', 'HomeController@index')->name('home');


