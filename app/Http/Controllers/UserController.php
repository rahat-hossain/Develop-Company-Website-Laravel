<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordValidation;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function profile()
    {
        return view('profile.index');
    }
    public function passwordchange(PasswordValidation $request)
    {
        $user_id = Auth::id();
        $from_database = User::find($user_id)->password;
        if (Hash::check($request->old_password, $from_database)) 
        {
            User::findorFail($user_id)->update([
                'password' => Hash::make($request->new_password),
            ]);
            return back()->with('status', 'Password changed successfully !!');
        } 
        else 
        {
            return back()->with('error_status', 'Current password was incorrect !!');
        }
    }
}
