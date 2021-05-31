<?php

use Illuminate\Support\Facades\Route;
use BaltTechnologies\LaravelFirebaseCloudMessaging\Http\Controllers\CloudMessagingController;

Route::post('/', [CloudMessagingController::class, 'save'])->name('cmt-save');
Route::get('/', [CloudMessagingController::class, 'index'])->name('cmt-overview');
Route::delete('/', [CloudMessagingController::class, 'delete'])->name('cmt-delete');