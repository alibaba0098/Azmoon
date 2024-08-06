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

    public function updatePassword(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'password' => 'required|min:6|required_with:password_repeat|same:password_repeat',
            'password_repeat' => 'min:6',
        ]);

        $this->userRepository->update(
            $request->id,
            [
                'password' => Hash::make($request->password),
            ]
        );

        return $this->respondSuccess('رمز کاربر با موفقیت بروزرسانی شد', [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $this->userRepository->delete($request->id);

        return $this->respondSuccess('کاربر با موفقیت حذف شد', []);
    }
}
