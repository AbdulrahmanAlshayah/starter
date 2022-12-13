<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\OfferController;
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


Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('fillable',[CrudController::class,'getOffers']);

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function (){

    Route::group(['prefix' => 'offers'],function(){
        Route::get('create',[CrudController::class,'create']);
        Route::post('store',[CrudController::class,'store'])->name('offers.store');

        Route::get('edit/{offer_id}',[CrudController::class,'editOffer']);
        Route::post('update/{offer_id}',[CrudController::class,'updateOffer'])->name('offers.update');
        Route::get('delete/{offer_id}',[CrudController::class,'deleteOffer'])->name('offers.delete');
        Route::get('all',[CrudController::class,'getAllOffers'])->name('offers.all');

    });

     Route::get('youtube',[CrudController::class,'getVideo']);

});

####################### Begin ajax routes ###################
Route::group(['prefix' => 'ajax-offers'],function(){
    Route::get('create',[OfferController::class,'create']);
    Route::post('store',[OfferController::class,'store'])->name('ajax.offers.store');
    Route::get('all',[OfferController::class,'all'])->name('ajax.offers.all');
    Route::post('delete',[OfferController::class,'delete'])->name('ajax.offers.delete');
    Route::get('edit/{offer_id}',[OfferController::class,'editOffer'])->name('ajax.offer.edit');
    Route::post('update',[OfferController::class,'updateOffer'])->name('ajax.offers.update');

});




####################### End ajax routes ###################

