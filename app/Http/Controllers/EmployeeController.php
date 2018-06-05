<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {       
        $this->middleware('auth:admin-web');
    } 

    public function index()
    {
        $employees = Employee::all();
        return view('crud.employees.index')->withEmployees($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.employees.create');
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
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'birth_date' => 'required|max:10|date',
            'inn' => 'required|max:10|min:10|unique:employees'            
        ]);

        // Store in the database.
        $employee = new Employee;
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->birth_date = date('Y-m-d' , strtotime($request->birth_date));
        $employee->inn = $request->inn;

        $employee->save();

        Session::flash('success', 'The employee was successfully saved!');

        // Redirect to another page.
        return redirect()->route('employees.show', $employee->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('crud.employees.show')->withEmployee($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('crud.employees.edit')->withEmployee($employee);
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
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'birth_date' => 'required|max:10|date',
            'inn' => 'required|max:10|min:10|unique:employees'            
        ]);

        // Save the data to the database.
        $employee = Employee::find($id);
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->birth_date = date('Y-m-d' , strtotime($request->birth_date));
        $employee->inn = $request->inn;

        $employee->save();

        // Set flash data with success message.
        Session::flash('success', 'The employee was successfully updated!');

        // Redirect with flash data to employees.show
        return redirect()->route('employees.show', $employee->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        $employee->delete();

        Session::flash('success', 'The employee was successfully deleted!');

        return redirect()->route('employees.index');
    }
}
