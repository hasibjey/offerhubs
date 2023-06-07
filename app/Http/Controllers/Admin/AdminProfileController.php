<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class AdminProfileController extends Controller
{
    /**
     * view admin profile page
     */
    public function index()
    {
        $auth = Auth::guard('admin')->user();
        return view('admin.pages.profile.profile', compact('auth'));
    }

    /**
     * update name, email and image
     */
    public function update(Request $request)
    {
        $auth = Auth::guard('admin')->user();
        $request->validate([
            'image'     => 'required',
        ]);

        if ($request->hasFile('image')) {
            if (!empty($auth->image)) {
                $old_image_name = $auth->image;
                $old_image_name = explode("/", $old_image_name);
                $old_image_name = $old_image_name[sizeof($old_image_name) - 1];
                unlink(public_path('images/admins/' . $old_image_name));
            }
            $image_name = str_replace(' ', '_', $auth->name) . "_" . date('YmdHis') . '.webp';
            $image_url = 'images/admins/' . str_replace(' ', '_', $auth->name) . "_" . date('YmdHis') . '.webp';
            Image::make($request->image)->encode('webp', 90)->save(public_path('images/admins/' . $image_name));
        }

        Admin::find($auth->id)->update([
            'image' => $image_url
        ]);

        toast('Profile data updated successfully!', 'success');
        return redirect()->back();
    }

    /**
     * check password
     */
    public function check($password)
    {
        $message = 0;
        if (password_verify($password, Auth::guard('admin')->user()->password)) {
            $message = 1;
        } else {
            $message = 0;
        }

        return response()->json($message);
    }

    /**
     * change password
     */
    public function change(Request $request)
    {
        $request->validate([
            'password'     => 'required',
        ]);

        Admin::find(Auth::guard('admin')->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        toast('Password change successfully!', 'success');
        return redirect()->back();
    }
}
