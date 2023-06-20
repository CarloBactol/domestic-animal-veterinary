<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminBranch extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch = Location::orderBy('address', 'ASC')->get();
        return view('admin.branch.index', compact('branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::orderBy('name', 'ASC')->get();
        return view('admin.branch.create', compact('services'));
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
            'address' => 'required|string|min:2|max:40',
            'lat' => 'required',
            'long' => 'required',
            'service' => 'required',
        ]);


        Location::create([
            'address' => $request->address,
            'lat' => $request->lat,
            'long' => $request->long,
            'content' =>  implode(',', $request->service),
            'status' => $request->status == "" ? 0 : 1,
        ]);

        return redirect()->route('admin.admin_branchs.index')->with('success', "Successfully Added.");
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
        $services = Service::orderBy('name', 'ASC')->get();
        $branch = Location::find($id);
        return view('admin.branch.edit', compact('branch', 'services'));
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
            'address' => 'required|string|min:2|max:40',
            'lat' => 'required',
            'long' => 'required',
            'service' => 'required',
        ]);

        $update_Location = Location::find($id);
        $update_Location->address = $request->address;
        $update_Location->lat = $request->lat;
        $update_Location->long = $request->long;
        $update_Location->content = implode(',', $request->service);
        $update_Location->status = $request->status == "" ? 0 : 1;
        $update_Location->save();
        return redirect()->route('admin.admin_branchs.index')->with('success', "Successfully Updated.");
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
