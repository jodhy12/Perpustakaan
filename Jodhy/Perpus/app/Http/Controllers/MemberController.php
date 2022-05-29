<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.member');
    }

    public function api()
    {
        $members = Member::all();
        $datatables = datatables()->of($members)->addIndexColumn();

        return $datatables->make(true);
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
        $this->validate($request, [
            'name' => ['required', 'max:64'],
            'gender' => ['required'],
            'phone_number' => ['required', 'unique:authors,phone_number', 'min:10', 'max:13'],
            'address' => ['required', 'max:255'],
            'email' => ['required', 'unique:authors,email', 'max:64']
        ]);

        Member::create($request->all());

        return redirect('members');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $this->validate($request, [
            'name' => ['required', 'max:64'],
            'gender' => ['required'],
            'email' => ['required', 'unique:publishers,email,' . $member->id . ',id', 'max:64'],
            'phone_number' => ['required', 'unique:publishers,phone_number,' . $member->id . ',id', 'min:10', 'max:13'],
            'address' => ['required', 'max:255']
        ]);

        $member->update($request->all());

        return redirect('members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
    }
}
