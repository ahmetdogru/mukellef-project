<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected function sonucGetir($success, $message, $data, $statusCode)
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $statusCode);
    }
}
