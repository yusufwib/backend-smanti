<?php

//use Illuminate\Http\Request;

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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::resource('posting','PostingController');

//Route::prefix('v1')->group(function() {
//    //
//    Route::post('/insert/posting', 'PostingController@store');
//});

Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function () {
    //POST

    Route::post('/insert/posting', 'PostingController@storePosting');
    Route::post('/insert/gallery', 'PostingController@storeGallery');
    Route::post('/insert/jadwal', 'PostingController@storeJadwal');
    Route::post('/insert/kontak', 'PostingController@storeKontak');

    Route::post('/insert/ip', 'PostingController@storeVisitor');
    //GET
    Route::get('/get/posting', 'GetController@indexPosting');
    Route::get('/get/gallery', 'GetController@indexGallery');
    Route::get('/get/jadwal', 'GetController@indexJadwal');
    Route::get('/get/kontak', 'GetController@indexKontak');

    Route::get('/get/ip', 'GetController@indexVisitor');
    //UPDATE
    Route::post('/update/posting/{id}', 'UpdateController@updatePosting');
    Route::post('/update/jadwal/{id}', 'UpdateController@updateJadwal');
    //DELETE
    Route::get('/delete/posting/{id}', 'DeleteController@deletePosting');
    Route::get('/delete/gallery/{id}', 'DeleteController@deleteGallery');
    //LOGIN
    Route::post('/user/register', 'AuthController@store');
    Route::post('/user/signin', 'AuthController@signin');


});