<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }

    public function index()
    {
        return view('admin.index');
    }

    public function myProfile()
    {
        $user = Auth::user();
        return view('admin.myprofile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user=User::find(Auth::id());
        $request->validate([
            'name' => 'required',
            'email'=>'required|email|unique:users,email,' . Auth::id(),
        ]);
        if ($request->password != "") {

            $request->validate([
                'password' => 'required|confirmed',
            ]);
            $request->merge(['password' => bcrypt($request->password)]);
            $user->update($request->all());
        }else{
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,

            ]);

        }
        Session::flash('success','Successfully updated !');
        return redirect()->back();
    }
}
