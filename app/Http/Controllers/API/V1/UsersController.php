<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function store()
    {
        $token = csrf_token();
        return response()->json(
            [
                'success' => true,
                'message' => 'کاربر با موفقیت ایجاد شد',
                'data' => [
                    'full_name' => 'erfan',
                    'email' => 'erfan@gmail.com',
                    'mobile' => '0901',
                    'password' => '1234'
                ],
            ],
            201
        );
    }
}
