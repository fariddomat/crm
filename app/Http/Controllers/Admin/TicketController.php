<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MailNotify\MailNotify;
use App\Profile;
use App\Ticket;
use App\TicketLog;
use App\TicketType;
use App\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $types = TicketType::all();
        $tickets = '';
        if ($request->id) {
            $user = User::find($request->id);
            if ($user->hasRole('agent')) {
                $tickets = Ticket::where('agent_id', $request->id)->latest()->paginate(10);
                // dd($tickets);
            } elseif ($user->hasRole('back_office')) {
                $tickets = Ticket::where('back_office_id', $request->id)->latest()->paginate(10);
            } else {
                abort(404);
            }
        } else {
            $tickets = Ticket::whenSearch(request()->search)
                ->whenType(request()->type)
                ->whenStatus(request()->status)->latest()->paginate(10);
        }

        return view('admin.tickets.index', compact('tickets', 'types'));
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
        if ($ticket) {
            $profile = Profile::find($ticket->profile->id);
            // dd($profile->specialization_name);
            return view('admin.tickets.edit', compact('ticket', 'profile'));
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
            if ($ticket->status == 'progress') {
                TicketLog::log($ticket->id, 'تم تحويل التذكرة إلى back Office');
            } else {
                TicketLog::log($ticket->id, 'تم اغلاق التذكرة');
                try {
                    $ticket = Ticket::find($ticket->id);
                    MailNotify::notify($ticket);
                    TicketLog::log($ticket->id, 'تم ارسال الايميل ');
                } catch (\Throwable $th) {
                    TicketLog::log($ticket->id, 'لم يتم ارسال الايميل ');
                }
            }
            session()->flash('success', 'تم التعديل بنجاح !');
            return redirect()->route('admin.tickets.index');
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
