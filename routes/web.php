<?php

use App\Http\Controllers\UserListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.index');
});

Route::get('/', [UserListController::class, 'index']);
Route::resource('/user_list', UserListController::class);
