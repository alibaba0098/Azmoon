<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Contracts\APIController;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends APIController
{

    public function __construct(private UserRepositoryInterface $userRepository)
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string',
            'password' => 'required|string'
        ]);

        $this->userRepository->create(
            [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
            ]
        );

        return $this->respondCreated('کاربر با موفقیت ایجاد شد', [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $request->password,
        ]);
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'full_name' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string',
        ]);

        $this->userRepository->update($request->id,
            [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
            ]
        );

        return $this->respondSuccess('کاربر با موفقیت بروزرسانی شد', [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
    }
}
