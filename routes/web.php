<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

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

Route::get('/home', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified']);

Route::get('/general', function(){
    return view('admin/mainview');
});


//////////////////////////ADMINISTRATOR ROUTES

Route::get('/administrator/index', 'AdministratorController@index');

Route::get('/administrator/show/{id}', 'AdministratorController@show');

Route::get('/administrator/edit/{id}', 'AdministratorController@edit');

Route::patch('/administrator/update/{id}', 'AdministratorController@update');

Route::delete('/administrator/delete/{id}', 'AdministratorController@destroy');

Route::get('/administrator/editpriviledge/{id}', 'AdministratorController@privilege');

Route::patch('/administrator/updateprivilege/{id}', 'AdministratorController@updateprivilege');

Route::get('/administrator/selfRegistered', 'AdministratorController@self');

Route::get('/administrator/activate/{id}', 'AdministratorController@activate');

Route::patch('/administrator/doActivate/{id}', 'AdministratorController@doActivate');

Route::get('/administrator/create', function () {
         return view('admin/adminCreate');
     });

Route::post('/administrator/store', 'AdministratorController@store');

Route::get('/passwordReset', function() {
    return view('passwordReset');
});

Route::patch('/resetpassword', 'AdministratorController@passwordReset');

//Route::get('/roles', [RoleController::class, 'fetchAllRoles']);
//Route::get('/arole', [RoleController::class, 'fetchARole']);
// Route::get('/lighthome', function () {
//     return view('test2');
// });
// Route::get('/dash', function () {
//     return view('test3');
// });