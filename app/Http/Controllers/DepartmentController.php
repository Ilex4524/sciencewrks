<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Session;

class DepartmentController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin-web');
    } 

    public function index()
    {
        $departments = Department::all();
        return view('crud.departments.index')->withDepartments($departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.departments.create');
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
        $department = new Department;
        $department->name = $request->name;
    
        $department->save();

        Session::flash('success', 'The department was successfully saved!');

        // Redirect to another page.
        return redirect()->route('departments.show', $department->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);
        return view('crud.departments.show')->withDepartment($department);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        return view('crud.departments.edit')->withDepartment($department);
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
        $department = Department::find($id);
        $department->name = $request->name;

        $department->save();

        // Set flash data with success message.
        Session::flash('success', 'The department was successfully updated!');

        // Redirect with flash data to employees.show
        return redirect()->route('departments.show', $department->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);

        $department->delete();

        Session::flash('success', 'The department was successfully deleted!');

        return redirect()->route('departments.index');
    }
}
