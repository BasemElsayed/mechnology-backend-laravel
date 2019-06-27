<?php

use Illuminate\Http\Request;

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


Route::post('addService', 'API\ServiceController@create');
Route::get('getServices', 'API\ServiceController@show');
Route::post('editService/{id}', 'API\ServiceController@update');
Route::get('deleteService/{id}', 'API\ServiceController@destroy');


Route::post('addTeam', 'API\TeamController@create');
Route::get('getTeams', 'API\TeamController@show');
Route::get('deleteTeam/{id}', 'API\TeamController@destroy');


Route::post('updateAbout', 'API\AboutController@update');
Route::get('getAbout', 'API\AboutController@show');
Route::post('addMission', 'API\MissionController@create');
Route::get('getMissions', 'API\MissionController@show');



Route::post('addPortfolio', 'API\PortfolioController@create');
Route::get('getPortfolio', 'API\PortfolioController@show');
Route::post('editPortfolio/{id}', 'API\PortfolioController@update');
Route::get('deletePortfolio/{id}', 'API\PortfolioController@destroy');


Route::post('addOffer', 'API\OffersController@create');
Route::get('getOffers', 'API\OffersController@show');



Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('details', 'API\UserController@details');
});


Route::post('updateContact', 'API\ContactController@update');
Route::get('getContact', 'API\ContactController@show');


Route::post('sendMessageCustomer', function (Request $request) {

    $data = array(
        'userName' => $request->name,
        'phoneNumber' => $request->phone,
        'userEmail' => $request->email,
        'Message' => $request->message
    );
    Mail::send('welcome', $data, function ($m) use($data) {
        $m->from($data['userEmail']);
        $m->to(env('MAIL_USERNAME'))->subject('Customer');
    });
    return $request;
});

Route::post('sendMessageCompany', function (Request $request) {

    $data = array(
        'userName' => $request->name,
        'commerical' => $request->commericalRegister,
        'phoneNumber' => $request->phone,
        'userEmail' => $request->email,
        'Message' => $request->message
    );
    Mail::send('welcome', $data, function ($m) use($data) {
        $m->from($data['userEmail']);
        $m->to(env('MAIL_USERNAME'))->subject('Customer');
    });
    return $request;
});


