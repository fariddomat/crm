<?php

namespace App\Http\Controllers\Agent;

use App\College;
use App\Http\Controllers\Controller;
use App\MailNotify\MailNotify;
use App\Ticket;
use Illuminate\Http\Request;
use App\Profile;
use App\TicketAttachment;
use App\TicketClassification;
use App\TicketLog;
use App\TicketType;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:agent']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filter == 'my') {
            $tickets = Ticket::whenSearch(request()->search)
                ->whenType(request()->type)
                ->whenStatus(request()->status)->where('agent_id', Auth::id())->latest()->paginate(10);
        } else {

            $tickets = Ticket::whenSearch(request()->search)
                ->whenType(request()->type)
                ->whenStatus(request()->status)->latest()->paginate(10);
        }
        $types = TicketType::all();
        return view('agent.tickets.index', compact('tickets', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agent.tickets.create');
    }

    public function profile(Request $request)
    {
        $request->validate([
            'phone_number' => 'required'
        ]);

        $profile = Profile::where('phone_number', $request->phone_number)->get();
        if ($profile->count() > 0) {
            // user already created
            session()->flash('success', 'المستخدم موجود مسبقا !');
            return redirect()->route('agent.profiles.edit', $profile->first()->id);
        } else {
            // create new user
            session()->flash('success', 'مستخدم جديد');
            return redirect()->route('agent.profiles.create', ['phone_number' => $request->phone_number]);
        }
    }

    public function newTicket(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required|unique:profiles,phone_number',
            'aou_number' => 'required|numeric|unique:profiles,aou_number',
            'email' => 'required|email',
            'college_name' => 'required',
            'specialization' => 'required',
            'branch_name' => 'required',
            'language' => 'required',
        ]);
        if($request->id_number){
            $request->validate([
            'id_number' => 'sometimes|numeric|unique:profiles,id_number',
            ]);
        }
        $profile = Profile::create($request->except('ticket_type_id'));
        $profile_id = $profile->id;
        $ticket_type_id = $request->ticket_type_id;
        $classification = TicketClassification::where('ticket_type_id', $ticket_type_id)->get();
        session()->flash('success', 'تم الحفظ بنجاح !');
        return view('agent.tickets.type', compact('profile_id', 'ticket_type_id', 'classification'));
    }

    public function newTicketOldUser(Request $request)
    {
        $profile = Profile::find($request->profile_id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'aou_number' => 'required',

            'aou_number'=>'required|numeric|unique:profiles,aou_number,' . $profile->id,
            'email' => 'required|email',
            'college_name' => 'required',
            'specialization' => 'required',
            'branch_name' => 'required',
            'language' => 'required',
        ]);
        if($request->id_number){
            $request->validate([
            'id_number' => 'sometimes|numeric|unique:profiles,id_number,'. $profile->id,
            ]);
        }
        if ($profile) {
            $profile->update($request->except('ticket_type_id', 'profile_id'));

            $profile_id = $profile->id;
            $ticket_type_id = $request->ticket_type_id;
            $classification = TicketClassification::where('ticket_type_id', $ticket_type_id)->get();

            session()->flash('success', 'تم الحفظ بنجاح !');
            return view('agent.tickets.type', compact('profile_id', 'ticket_type_id', 'classification'));
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->ticket_type_id);
        if ($request->ticket_type_id != "3") {
            $request->validate([
                'ticket_classification_id' => 'required'
            ]);
        } else {
            $request->validate([
                'comments' => 'required'
            ]);
        }
        $ticket = Ticket::create($request->except('attachments'));
        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            foreach ($files as $key => $file) {
                // dd($file);
                $name = $file->hashName() . time() . '.' . $file->extension();
                $file->move(public_path() . '/files/' . $ticket->id . '/', $name);
                TicketAttachment::create([
                    'ticket_id' => $ticket->id,
                    'file' => $name
                ]);
            }
        }
TicketLog::log($ticket->id, 'تم فتح التذكرة ');
session()->flash('success', 'تم الحفظ بنجاح !');
try {

    $ticket = Ticket::find($ticket->id);
    MailNotify::notify($ticket);
    TicketLog::log($ticket->id, 'تم ارسال الايميل ');
} catch (\Throwable $th) {
    TicketLog::log($ticket->id, 'لم يتم ارسال الايميل ');
}
        if ($request->ticket_type_id == '3') {
            $ticket->status = 'closed';
            $ticket->save();
            TicketLog::log($ticket->id, 'تم اغلاق التذكرة');

            return redirect()->route('agent.tickets.index');
        } else {
            return redirect()->route('agent.tickets.edit', $ticket->id);
        }
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
            return view('agent.tickets.edit', compact('ticket', 'profile'));
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
            return redirect()->route('agent.tickets.index');
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

    public function specList(Request $request)
    {
        $parent_id = $request->college_id;
        $colleges = College::where('id', $parent_id)
            ->with('specializations')
            ->get();
        return response()->json([
            'spec' => $colleges
        ]);
    }
}
