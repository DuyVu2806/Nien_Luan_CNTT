<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        return view('frontend.user.profile');
    }

    public function updateUserDetail(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|digits:10',
            'pincode' => 'required|digits:6',
            'address' => 'required|string|max:255',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
        ]);

        $user->UserDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'phone' => $request->phone,
                'pincode' => $request->pincode,
                'address' => $request->address,
            ]
        );
        return redirect()->back()->with('message','User Profile Updated');
    }

    public function passwordCreate()
    {
        return view('frontend.user.changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);

        if ($currentPasswordStatus) {
            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('message','Password Updated Successfully');
        }else{
            return redirect()->back()->with('message','Password Updated Fail');
        }

    }
}
