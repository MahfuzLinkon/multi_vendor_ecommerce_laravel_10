<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function create()
    {
        return view('admin.setting.password-update');
    }

    public function passwordCheck(Request $request)
    {
//        return $request->all();
        if (Hash::check($request->currentPassword, Auth::guard('admin')->user()->password )){
            return response()->json([
                'status' => 200,
            ]);
        }else{
            return response()->json([
                'status' => 400,
            ]);
        }
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
           'current_password' => 'required|min:6',
           'new_password' => 'required|min:6',
           'password_confirmation' => 'required|same:new_password'
        ],[
            'password_confirmation.same' => 'Confirm password does not match!'
        ]);

        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        if (Hash::check($request->current_password, $admin->password)){
            $admin->password = Hash::make($request->new_password);
            $admin->save();
            return redirect()->back()->with('success', 'Password updated successfully');
        }else{
            return redirect()->back()->with('error', 'Current password does not match!');
        }
    }






}
