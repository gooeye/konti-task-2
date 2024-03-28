<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

// API Resource routes for posts

Route::resource('posts', PostsController::class) 
    ->only(['index', 'show', 'store', 'update', 'destroy']); 