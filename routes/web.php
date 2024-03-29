<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/register', [UserController::class, 'register']);
Route::get('/tList', [TransactionController::class, 'listTransaction']);
Route::get('/kList', [UserController::class, 'listUsers']);
Route::get('/sList', [SubscriptionController::class, 'listSubscription']);
Route::get('/user/{id}', [UserController::class, 'allSubTrans']);
Route::post('/user/{id}/transaction', [TransactionController::class, 'saveTransaction']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/user/{id}/subscription', [SubscriptionController::class, 'saveSubscription']);
Route::put('/user/{id}/subscription/{subscriptionId}', [SubscriptionController::class, 'updateSubscription']);
Route::delete('/user/{userId}/subscription/{subscriptionId}', [SubscriptionController::class, 'deleteSubscription']);
