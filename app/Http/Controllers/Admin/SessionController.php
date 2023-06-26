<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
//        $attributes['status'] = 1;

        if (!Auth::guard('admin')->attempt($attributes)){
            throw ValidationException::withMessages([
                'loginError' => 'Credential does not match !'
            ]);
        }
        session()->regenerate();
        return redirect('/admin/dashboard')->with('success', 'Welcome Back !');
    }

    public function destroy()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }


    public function loginCheck(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if ($admin){
            if (Hash::check($request->password, $admin->password)){
                return response()->json([
                   'status' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => 401,
                ]);
            }
        }else{
            return response()->json([
                'status' => 400,
            ]);
        }
    }










}
