<?php

namespace App\Http\Controllers\Agent;

use App\Branch;
use App\College;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Specialization;
use App\TicketType;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
    public function index()
    {

        $profiles=Profile::whenSearch(request()->search)->paginate(10);
        return view('agent.profile.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $phone_number = $request->phone_number;
        $colleges = College::all();
        $specializations = Specialization::all();
        $branches = Branch::all();
        $ticketTypes = TicketType::all();
        return view('agent.profile.create', compact('phone_number', 'colleges', 'specializations', 'branches', 'ticketTypes'));
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
        $profile=Profile::find($id);
        if ($profile) {
            return view('agent.profile.show', compact('profile'));
        }else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::find($id);
        if ($profile) {
            $colleges = College::all();
            $specializations = Specialization::all();
            $branches = Branch::all();
            $ticketTypes = TicketType::all();
            return view('agent.profile.edit', compact('profile', 'colleges', 'specializations', 'branches', 'ticketTypes'));
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
        //
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
