<?php

namespace App\Http\Controllers\Admin;

use App\Models\Veterinary;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;

class AdminVeterinary extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veterinary = Veterinary::orderBy('first_name', 'ASC')->get();
        return view('admin.veterinary.index', compact('veterinary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialization = Specialization::orderBy('name', 'asc')->get();
        return view('admin.veterinary.create', compact('specialization'));
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
            'specialization' => 'required',
            'address' => 'required|string|min:8|max:40',
            'phone_number' => 'required|digits:11|unique:veterinaries,phone_number',
            'email' => 'required|unique:veterinaries,email',
        ]);

        Veterinary::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'specialization' => $request->specialization,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'status' => $request->status == "" ? 1 : 0,
        ]);

        return redirect()->route('admin.admin_veterinaries.index')->with('success', "Successfully Added.");
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
        $veterinary = Veterinary::find($id);
        $specialization = Specialization::orderBy('name', 'asc')
            ->where('name', '!=', $veterinary->name)
            ->get();
        return view('admin.veterinary.edit', compact('veterinary', 'specialization'));
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
            'specialization' => 'required',
            'address' => 'required|string|min:8|max:40',
            'phone_number' => 'required|digits:11|unique:veterinaries,phone_number,' . $id,
            'email' => 'required|unique:veterinaries,email,' . $id,
        ]);

        $update_Veterinary = Veterinary::find($id);
        $update_Veterinary->first_name = $request->firstname;
        $update_Veterinary->last_name = $request->lastname;
        $update_Veterinary->specialization = $request->specialization;
        $update_Veterinary->address = $request->address;
        $update_Veterinary->phone_number = $request->phone_number;
        $update_Veterinary->email = $request->email;
        $update_Veterinary->status = $request->status == "" ? 0 : 1;
        $update_Veterinary->save();

        return redirect()->route('admin.admin_veterinaries.index')->with('info', "Successfully Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del_Veterinary = Veterinary::find($id);
        $del_Veterinary->delete();
        return redirect()->route('admin.admin_veterinaries.index')->with('success', 'Successfully Deleted.');
    }
}
