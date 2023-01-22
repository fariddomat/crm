<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Profile;
use App\Ticket;
use App\TicketType;
use App\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:supervisor']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tickets = '';
        if ($request->filter == 'progress') {
            $tickets = Ticket::whenSearch(request()->search)
            ->whenType(request()->type)
            ->whenStatus(request()->status)->where('status', 'progress')->latest()->paginate(10);
        }
        else {
            $tickets = Ticket::whenSearch(request()->search)
            ->whenType(request()->type)
            ->whenStatus(request()->status)->latest()->paginate(10);
        }

        $types = TicketType::all();
        return view('supervisor.tickets.index', compact('tickets', 'types'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $back_offices=  $users=User::whereRole(['back_office'])->get();
        if ($ticket) {
            $profile = Profile::find($ticket->profile->id);
            // dd($profile->specialization_name);
            return view('supervisor.tickets.edit', compact('ticket', 'profile','back_offices'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        if ($ticket) {
            $ticket->update($request->all());
            session()->flash('success','تم التعديل بنجاح !');
            return redirect()->route('supervisor.tickets.index');
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
