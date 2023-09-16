<?php

use App\Http\Controllers\usersController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\TicketsController;
use App\Models\Cars;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('create',function(){
    $car = Cars::where('CarNumber',123)->get();

    return $car;
});





Route::get('payMyTicket/{id}',function($id){

    $ticket = Tickets::findOrFail($id);
    $ticket->update(['Paid'=>'1']);
    return $ticket;

});

Route::get('unpayMyTicket/{id}',function($id){

    $ticket = Tickets::findOrFail($id);
    $ticket->update(['Paid'=>'0']);
    return $ticket;

});

Route::get('activate/{id}',function($id){

    $user = User::findOrFail($id);
    $user->update(['activate'=>'1']);
    return $user;

});

Route::get('/search/{carnumber}',function($carnumber){


    $ticket = Tickets::where('CarNumber',$carnumber)->get();

    return $ticket;

});



Route::resource('cars',usersController::class);
Route::resource('tickets',TicketsController::class);
Route::post('login','App\Http\Controllers\loginController@login');
Route::post('register','App\Http\Controllers\loginController@register');
Route::middleware(['auth:api'])->group(function(){
    Route::get('user','App\Http\Controllers\loginController@index');
    Route::post('logout','App\Http\Controllers\loginController@logout');
    Route::get('showMyTicket/',function(){

        $user=Auth::user();
        $id= $user->getAuthIdentifier();
        $car=User::findOrFail($id);
        return $car->tickets;

    });



});
