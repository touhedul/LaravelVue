<?php

namespace App\Http\Controllers\User;

use App\Helpers\CommonHelper;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Auth;
use Illuminate\Http\Request;



class ProfileController extends Controller
{

    public function profileView()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function profileChange(UserUpdateRequest $request)
    {

        $user = Auth::user();
        $imageName = FileHelper::uploadImage($request, $user);
        $user->fill(array_merge($request->validated(), ['image' => $imageName, 'email' => $user->email]))->save();
        return back()->with('success', 'Update Successful.');
    }

    public function changePasswordView()
    {
        return view('user.change_password');
    }

    public function changePassword(Request $request)
    {
        $message = CommonHelper::changePassword($request, "User");
        return back()->with('success', $message);
    }
}
