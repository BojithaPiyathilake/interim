<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Crime_reportController;

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

Route::get('/user/index', 'UserController@index');

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

Route::post('/alterPassword', 'UserController@alterPass');

//Route::get('/roles', [RoleController::class, 'fetchAllRoles']);
//Route::get('/arole', [RoleController::class, 'fetchARole']);
// Route::get('/lighthome', function () {
//     return view('test2');
// });
// Route::get('/dash', function () {
//     return view('test3');
// });



//////////////////HOO ROUTES

Route::get('/headOrg/show/{id}', 'headOrgController@show');

Route::get('/headOrg/edit/{id}', 'headOrgController@edit');

Route::patch('/headOrg/update/{id}', 'headOrgController@update');

Route::get('/headOrg/create', function () {
         return view('headOrg/headOrgCreate');
     });

Route::post('/headOrg/store', 'headOrgController@store'); 



///////////////MANAGER ROUTES

Route::get('/manager/show/{id}', 'managerController@show');

Route::get('/manager/edit/{id}', 'managerController@edit');

Route::patch('/manager/update/{id}', 'managerController@update');

Route::get('/manager/create', function () {
         return view('manager/managerCreate');
     });

Route::post('/manager/store', 'managerController@store');







//////////////////GENERAL MoDULE

// Route::get('/index', [Crime_reportController::class, 'index']);
Route::post('/crimecreate', [Crime_reportController::class, 'create']);
Route::get('/crimehome', fn() => view('general.crimeChome'));
Route::get('/newcrime', fn() => view('general.logComplaint'));
Route::get('/general', fn() => view('general.general'));
Route::get('/trackcrime', [Crime_reportController::class, 'track']);
Route::get('/crimeadmin', [Crime_reportController::class, 'admin']);
//Route::get('/crimehome', [Crime_reportController::class, 'crimehome']);
//Route::get('{id}', 'crime_reportController@edit')->name('edit');
Route::get('/assign/{id}',[Crime_reportController::class, 'show']);
Route::get('crimeassign',fn() => view('general.crimeAssign'));
Route::get('/searchauth', [Crime_reportController::class, 'searchauth']);
Route::post('/assignauth', [Crime_reportController::class, 'assignauth']);