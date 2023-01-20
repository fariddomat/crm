<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Ticket;
use App\TicketClassification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:supervisor']);
    }

    public function index()
    {
        $inquiries=Ticket::where('ticket_type_id',1)->count();
        $inquiries_s=TicketClassification::where('ticket_type_id',1)->withCount('tickets')->get();
        $inquiries_label=[];
        $inquiries_count=[];
        foreach ($inquiries_s as $key => $inquiry) {
            $inquiries_label[$key]=$inquiry->name;
            $inquiries_count[$key]=$inquiry->tickets_count;
        }
        $complaints=Ticket::where('ticket_type_id',2)->count();
        $complaints_s=TicketClassification::where('ticket_type_id',2)->withCount('tickets')->get();
        $complaints_label=[];
        $complaints_count=[];
        foreach ($complaints_s as $key => $inquiry) {
            $complaints_label[$key]=$inquiry->name;
            $complaints_count[$key]=$inquiry->tickets_count;
        }
        $suggestions=Ticket::where('ticket_type_id',3)->count();
        return view('supervisor.index',compact('inquiries', 'complaints', 'suggestions','inquiries_label','inquiries_count', 'complaints_label', 'complaints_count'));
    }
    public function myProfile()
    {
        $user = Auth::user();
        return view('supervisor.myprofile', compact('user'));
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
