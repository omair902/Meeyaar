<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function profile_setting()
    {
        return view('admin.settings.profile_setting');
    }

    public function update_profile(ProfileRequest $request)
    {
        $user=User::find(Auth::user()->id);
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->profile_pic != null)
        {
            if(Auth::user()->profile_pic != null)
            {
                @unlink('profile_images/'.Auth::user()->profile_pic);
            }
            $image=$request->profile_pic;
            $filename=$image->getClientOriginalName();
            $destination=public_path('/profile_images');
            $image->move($destination,$filename);
            $user->profile_pic=$filename;
        }
        $user->update();
        if($user)
        {
            Session::flash('updated','Updated Sucessfully');
            return redirect()->back();
        }
    }

    public function password_setting()
    {
        return view('admin.settings.password_setting');
    }

    public function update_password(PasswordRequest $request)
    {
        $user=User::find(Auth::user()->id);
        $user->password=Hash::make($request->password);
        $user->update();
        if($user)
        {
            Session::flash('updated','Updated Sucessfully');
            return redirect()->back();
        }
    }
}
