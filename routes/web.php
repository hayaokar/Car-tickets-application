<?php

use App\Http\Controllers\TicketsController;
use App\Models\Cars;
use App\Models\Tickets;
use Illuminate\Support\Facades\Route;

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
Route::get('create',function(){
    $car = Cars::where('carNumber', 111)->firstOrFail();
    $car->tickets()->save(new Tickets(['Paid'=>0]));


});
Route::resource('tickets',TicketsController::class);
Route::get('/', function () {
    return view('welcome');
});
