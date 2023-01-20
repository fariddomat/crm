<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Profile;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:agent']);
    }

    public function index()
    {
        $tickets=Ticket::count();
        $opendTickets=Ticket::where('status','open')->count();
        $myTickets=Ticket::where('agent_id',auth()->id())->count();
        $customers=Profile::count();
        return view('agent.index',compact('tickets', 'opendTickets', 'myTickets', 'customers'));
    }
    public function myProfile()
    {
        $user = Auth::user();
        return view('agent.myprofile', compact('user'));
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
        session()->flash('success','تم التعديل بنجاح !');
        return redirect()->back();
    }
}
