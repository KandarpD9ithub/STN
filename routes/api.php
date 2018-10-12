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

/*
    Encryption keys generated successfully.
    Personal access client created successfully.
    Client ID: 1
    Client Secret:  MGKHsA6i1lDSyZI5zGs1QcapFy7XUrqqJe4r0SKA
    Password grant client created successfully.
    Client ID: 2
    Client Secret: z7lXoUJIsX2Ymh7aADMY2NvQ3BMqZSVkskmh54sy
*/


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/login', function () {
    // return view('welcome');
    return view('users.login');
});
Route::post('/login', 'Login\LoginController@login');

Route::group(['middleware' => 'auth:api'], function(){
    // resource Controller for Book
    Route::resource('usersBook', 'Api\UsersBookController');

    // resource Controller for Book
    Route::resource('myLibrary', 'Api\MyLibraryController');

    // upload pdf
    Route::post('uploadPdf', 'Api\CustomController@uploadPdf');

    Route::get('stateAndCity', 'Api\CustomController@stateAndCity');

    Route::post('magazineProfile', 'Admin\UsersController@magazineProfile');
    Route::get('getMagazineProfile', 'Admin\UsersController@getMagazineProfile');
    Route::post('generatePDF', 'Api\CustomController@generatePDF');
    // Route::post('details', 'API\UserController@details');
});