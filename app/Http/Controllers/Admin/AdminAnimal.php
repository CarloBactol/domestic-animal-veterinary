<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Owner;
use Illuminate\Http\Request;

class AdminAnimal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animal = Animal::orderBy('name', 'ASC')->get();
        return view('admin.animal.index', compact('animal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owner = Owner::orderBy('first_name', 'ASC')->get();
        return view('admin.animal.create', compact('owner'));
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
            'species' => 'required|string|min:2|max:20',
            'breed' => 'required|string|min:2|max:10',
            'name' => 'required|string|min:2|max:10',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'color' => 'required|min:2|max:10|max:10',
            'owner' => 'required|numeric',
        ]);

        Animal::create([
            'species' => $request->species,
            'breed' => $request->breed,
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'color' => $request->color,
            'owner_id' => $request->owner,
        ]);

        return redirect()->route('admin.admin_animals.index')->with('success', "Successfully Added.");
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
        $animal = Animal::find($id);
        $owner = Owner::orderBy('email', 'Asc')
            ->where('id', '!=', $animal->owner->id)
            ->get();
        return view('admin.animal.edit', compact('animal', 'owner'));
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
            'species' => 'required|string|min:2|max:20',
            'breed' => 'required|string|min:2|max:10',
            'name' => 'required|string|min:2|max:10',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'color' => 'required|min:2|max:10|max:10',
            'owner' => 'required|numeric',
        ]);

        $update_Animal = Animal::find($id);
        $update_Animal->species = $request->species;
        $update_Animal->breed = $request->breed;
        $update_Animal->name = $request->name;
        $update_Animal->date_of_birth = $request->date_of_birth;
        $update_Animal->gender = $request->gender;
        $update_Animal->color = $request->color;
        $update_Animal->owner_id = $request->owner;
        $update_Animal->save();

        return redirect()->route('admin.admin_animals.index')->with('success', "Successfully Updated.");
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
