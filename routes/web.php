<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\UserController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Parameters and Name

Route::get('/show-number/{id}', function ($id) {
    return $id;
})->name('a');

Route::get('/show-string/{id?}', function () {
    return 'Welcome';
})->name('b');

//Route namespace شوف التحديث تبعا الجديد

//Route::namespace('Front')->group(function(){
//    //all route only access controller or methods in  folder name Front
//    Route::get('users',UserController::class,'showAdminName');
//});

//Route prefix for url
Route::prefix('users')->group(function(){
    Route::get('/show', [UserController::class, 'showAdminName']);
    Route::delete('/delete', [UserController::class, 'showAdminName']);
    Route::get('/edit', [UserController::class, 'showAdminName']);
    Route::put('/update', [UserController::class, 'showAdminName']);
});

//Route group
Route::group(['prefix' => 'users','middleware' => 'auth'],function(){
    Route::get('/',function(){
       return 'Work';
    });

    Route::get('/show', [UserController::class, 'showAdminName']);
    Route::delete('/delete', [UserController::class, 'showAdminName']);
    Route::get('/edit', [UserController::class, 'showAdminName']);
    Route::put('/update', [UserController::class, 'showAdminName']);
});

Route::get('check',function (){
   return 'middleware';
})->middleware('auth');

Route::get('second',[App\Http\Controllers\Admin\SecondController::class,'showString']);

Route::middleware('auth')->group(function (){
    Route::get('second',[App\Http\Controllers\Admin\SecondController::class,'showString']);
    Route::get('third',[App\Http\Controllers\Admin\SecondController::class,'showString']);
});

Route::get('second',[App\Http\Controllers\Admin\SecondController::class,'showString0'])->middleware('auth');
Route::get('second1',[App\Http\Controllers\Admin\SecondController::class,'showString1']);
Route::get('second2',[App\Http\Controllers\Admin\SecondController::class,'showString2']);
Route::get('second3',[App\Http\Controllers\Admin\SecondController::class,'showString3']);

//Route::resource('news',[App\Http\Controllers\Admin\NewsController::class]);

/*
 * Route::get('news',[App\Http\Controllers\Admin\NewsController::class,'index']);
 * Route::post('news',[App\Http\Controllers\Admin\NewsController::class,'store']);
 * Route::get('news/create',[App\Http\Controllers\Admin\NewsController::class,'create']);
 * Route::get('news{id}/edit',[App\Http\Controllers\Admin\NewsController::class,'edit']);
 * Route::post('news/{id}',[App\Http\Controllers\Admin\NewsController::class,'update']);
 * Route::delete('news/{id}',[App\Http\Controllers\Admin\NewsController::class,'delete']);
 * */

//php artisan ser --port = 8001

