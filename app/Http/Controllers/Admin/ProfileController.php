<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.setting.profile-update', [
            'admin' => Admin::find(Auth::guard('admin')->user()->id),
        ]);
    }

    public function update(Request $request)
    {
//        $data = $request->all();
//        echo "<pre>"; print_r($data); die;
       $request->validate([
           'name' => 'required|regex:/^[\pL\s\-]+$/u',
           'mobile' => 'required|numeric',
       ]);

//        $image = $request->image;
//        $imageName =rand(111, 9999).time().'.'.$image->getClientOriginalExtension();
//        $imagePath = 'admin/images/profile/'.$imageName;
//        Image::make($image)->save($imagePath);

        Admin::find(Auth::guard('admin')->user()->id)->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'image' => Helper::uploadImage($request->image,'admin/images/profile/', Auth::guard('admin')->user()->image !== null ? Auth::guard('admin')->user()->image : ''),
        ]);
        return redirect()->back()->with('success', 'Profile information updated!');
    }

//    protected function imageUrl($request){
//
//        $image = $request->image;
//        $imageName =rand(111, 9999).time().'.'.$image->getClientOriginalExtension();
//        $imageUlr = 'admin/images/profile/';
//        $image->move($imageUlr, $imageName);
//        return $imageUlr.$imageName;
//    }
}
