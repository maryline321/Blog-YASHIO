<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::prefix('api/v1')->group(function () {
//     Route::prefix('posts')->group(function () {
//         Route::get('/', 'PostController@index');      
//         Route::post('/', 'PostController@store');      
//         Route::get('/{id}', 'PostController@show');    
        
//     });

Route::get('/getpost/{id}', [PostController::class, 'index']);
Route::get('/getposts}', [PostController::class, 'show']);
Route::post('/addpost', [PostController::class, 'store']);

Route::get('/gettags', [TagController::class, 'index']);
Route::post('/addtags', [TagController::class, 'store']);

//     Route::prefix('tags')->group(function () {
//         Route::get('/', 'TagController@index');        
//         Route::post('/', 'TagController@store');      
//     });
// });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
