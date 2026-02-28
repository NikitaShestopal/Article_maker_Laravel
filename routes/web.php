<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodcastController;

Route::get('/podcast/{id}', [PodcastController::class, 'show']);

Route::get('/', [PodcastController::class, 'index']);

Route::post('newproduct', [PodcastController::class, 'showDouble']);

Route::match(['get', 'post'], '/podcast/{id}/edit', [PodcastController::class, 'editOrUpdate']);
