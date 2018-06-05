<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Department;
use App\Employee;
use App\DepartmentEmployee;
use App\User;

class SignupController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showSignupForm()
    {
        $deptNames = Department::get(['name'])->pluck('name')->toArray();
        $deptIds = Department::get(['id'])->pluck('id')->toArray();       
        $departments = array_combine(array_values($deptIds), array_values($deptNames)); 
        $departments[null] = 'No Department Selected';
        return view('auth.register')->withDepartments($departments);
    }

    public function signup(Request $request)
    {         
        // Validate the form data.
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Create new employee.
        $employee = new Employee;
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->birth_date = date('Y-m-d' , strtotime($request->birthdate));
        $employee->inn = $request->inn;
        
        $employee->save();

        // Create new department-employee.
        $demployee = new DepartmentEmployee;
        $demployee->department = $request->department;
        $demployee->employee = $employee->id;

        $demployee->save();

        // Create new user.
        $user = new User;
        $user->ref_employee = $demployee->id;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();  
        
        return redirect()->intended(route('home'));
    }
}
