<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
        //
    }

    public function store()
    {
        $this->userRepository->create([
            'success' => true,
            'message' => 'کاربر با موفقیت ایجاد شد',
            'data' => [
                'full_name' => 'erfan',
                'email' => 'erfan@gmail.com',
                'mobile' => '0901',
                'password' => '1234'
            ],
        ]);

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
