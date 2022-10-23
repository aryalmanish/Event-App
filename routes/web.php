<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventHomeController;

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
    //return view('welcome');
    return view('eventhome.create');
});

Auth::routes();
Route::prefix('admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('events', EventController::class);
    Route::get('/finished_events', [App\Http\Controllers\EventController::class, 'finished_events'])->name('home');
    Route::get('/upcoming_events', [App\Http\Controllers\EventController::class, 'upcoming_events'])->name('home');
    Route::get('/upcoming_events_within_seven_days', [App\Http\Controllers\EventController::class, 'upcoming_events_within_seven_days'])->name('home');
    Route::get('/finished_events_within_seven_days', [App\Http\Controllers\EventController::class, 'finished_events_within_seven_days'])->name('home');
    Route::get('/loggedout', [App\Http\Controllers\EventController::class, 'logout'])->name('home');
    Route::delete('events/{id}', 'EventController@destroy')->name('events.destroy');

});
Route::any('/eventdelete/{id}', [App\Http\Controllers\EventController::class, 'eventDelete']);
    
Route::resource('eventhomes', EventHomeController::class);
Route::get('ajax',function() {
    return view('ajax');
});
Route::post('/getmsg','AjaxController@index');
