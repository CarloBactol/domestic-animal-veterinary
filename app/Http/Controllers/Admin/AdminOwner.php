<?php

namespace App\Http\Controllers\Admin;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminOwner extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner = Owner::orderBy('first_name', 'ASC')->get();
        return view('admin.owner.index', compact('owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.owner.create');
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
            'firstname' => 'required|string|min:2|max:10',
            'lastname' => 'required|string|min:2|max:10',
            'address' => 'required|string|min:8|max:40',
            'phone_number' => 'required|digits:11|unique:owners,phone_number',
            'email' => 'required|unique:owners,email',
        ]);

        Owner::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'status' => $request->status == "" ? 0 : 1,
        ]);

        return redirect()->route('admin.admin_owners.index')->with('success', "Successfully Added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $owner = Owner::find($id);
        return view('admin.owner.edit', compact('owner'));
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
        $this->validate($request, [
            'firstname' => 'required|string|min:2|max:10',
            'lastname' => 'required|string|min:2|max:10',
            'address' => 'required|string|min:8|max:40',
            'phone_number' => "required|digits:11|unique:owners,phone_number," . $id,
            'email' => 'required|unique:owners,email,' . $id,

        ]);

        $update_Owner = Owner::find($id);
        $update_Owner->first_name = $request->firstname;
        $update_Owner->last_name = $request->lastname;
        $update_Owner->address = $request->address;
        $update_Owner->phone_number = $request->phone_number;
        $update_Owner->email = $request->email;
        $update_Owner->status = $request->status == "" ? 0 : 1;
        $update_Owner->save();

        return redirect()->route('admin.admin_owners.index')->with('info', "Successfully Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delOwnwer = Owner::find($id);
        $delOwnwer->delete();
        return redirect()->route('admin.admin_owners.index')->with('success', 'Successfully Deleted.');
    }
}
