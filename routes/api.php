<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::apiResources([
    'users' => UserController::class
]);
