<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedAiController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
    })->name('home');

Route::get('/signin', function () {
    return view('auth.signin');
});

// Route Param
Route::get('/user/{name}', function ($name) {
    return 'User adalah : '.$name;
});

// Name Route
Route::get('/user/profile', function () {
    return 'User Profile';
})->name('user.profile');

// alias of a routre user.profile = /pengguna/profile

// Redirect route to named route
Route::get('/redirect-to-profile',function(){
    return redirect()->route('user.profile');
});

// Route Group
Route::prefix('food')->group(function (){

        Route::get('/details',function (){
            return 'Food details are following';
        });

        Route::get('/home',function (){
            return 'Food home page';
        });
});



//Combination of all (Route, Named Route, Route Param, Route Group. Route Prefix)
Route::name('job')->prefix('job')->group(function() {
    
    Route::get('/home', function () {
        return 'Job home page';
    })->name('.name');
    
    Route::get('/details', function () {
        return 'Job details are following';
    })->name('.description');

});

Route::get('/home/{name}',function ($name){
        return view('home',['name'=>$name]);
});


Route::get('/about', function () {
    return view('about');
})->name('about');




require __DIR__.'/feed/web.php';

Route::middleware('guest')->group(function() {
    Route::get('/auth/signup',[AuthController::class,'signup'])->name('auth.signup');
    Route::post('/auth/store',[AuthController::class,'storeUser'])->name('auth.store');
    Route::post('/auth/login',[AuthController::class,'authenticate'])->name('auth.login');
    Route::get('/auth/signin',[AuthController::class,'signin'])->name('auth.signin');
});

Route::get('/auth/logout',[AuthController::class,'signOut'])->name('auth.logout');

Route::get('/ai/feed',[FeedAiController::class,'feedAi'])->name('ai.feed');

