<?php

use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;


Route::get('/feeds',[FeedController::class,'index'])->name('feeds');

Route::post('/feed/create',[FeedController::class,'create'])->name('feed.create');

Route::put('/feed/update/{feed}',[FeedController::class,'update'])->name('feed.update');


Route::get('/feed/show/{feed}',[FeedController::class,'show'])->name('feed.show');