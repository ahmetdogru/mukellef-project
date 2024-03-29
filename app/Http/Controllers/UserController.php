<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Services\UserService;
use http\Client\Request;

class UserController extends ApiController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(RegisterRequest $request)
    {
        $userData = $request->only(['name', 'email', 'password', 'payment_provider']);
        $user = $this->userService->saveUser($userData);
        return $this->sonucGetir(true,"İşlem başarılı", $user, 201);

    }
    public function listUsers()
    {
        $list = $this->userService->getUsers();
        return $this->sonucGetir(true,"İşlem başarılı", $list, 201);
    }
    public function allSubTrans($id)
    {
        $kullaniciBilgiler = new \stdClass();
        $kullaniciBilgiler->Subscriptions = Subscription::where('user_id', $id)->get();
        $kullaniciBilgiler->Transactions = Transaction::where('user_id', $id)->get();
        return $this->sonucGetir(true,"İşlem başarılı", $kullaniciBilgiler, 201);
    }

}
