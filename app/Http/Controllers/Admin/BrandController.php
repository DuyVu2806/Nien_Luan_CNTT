<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brand.index');
    }

    public function viewUsers()
    {
        $users = User::orderBy('role_as','DESC')->get();
        return view('admin.user.index',compact('users'));
    }

    public function postUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->role_as = $request->role_as;
        $user->update();
        return redirect()->back()->with('message','User Update role successfull');
    }
}
