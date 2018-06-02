<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StaffType;
use Session;

class StaffTypeController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin-web');
    } 

    public function index()
    {
        $types = StaffType::all();
        return view('crud.staff-types.index')->withTypes($types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.staff-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        // Validate the data.
        $this->validate($request, [
            'name' => 'required|max:100'                
        ]);

        // Store in the database.
        $type = new StaffType;
        $type->name = $request->name;
    
        $type->save();

        Session::flash('success', 'The staff type was successfully saved!');

        // Redirect to another page.
        return redirect()->route('staff-types.show', $type->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = StaffType::find($id);
        return view('crud.staff-types.show')->withType($type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = StaffType::find($id);
        return view('crud.staff-types.edit')->withType($type);
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
        // Validate the data.
        $this->validate($request, [
            'name' => 'required|max:100'                
        ]);

        // Save the data to the database.
        $type = StaffType::find($id);
        $type->name = $request->name;

        $type->save();

        // Set flash data with success message.
        Session::flash('success', 'The staff type was successfully updated!');

        // Redirect with flash data to employees.show
        return redirect()->route('staff-types.show', $type->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = StaffType::find($id);

        $type->delete();

        Session::flash('success', 'The staff type was successfully deleted!');

        return redirect()->route('staff-types.index');
    }
}
