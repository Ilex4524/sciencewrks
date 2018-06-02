<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Department;

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
        return redirect()->intended(route('home'));
        // // Validate the form data.
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        // // Attempt to log the user in.
        // if(Auth::guard('admin-web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        //     // If successful, then redirect to their intended location.
        //     return redirect()->intended(route('admin.dashboard'));
        // }        

        // // If unsuccessful, then redirect back to the login with the form data.
        // return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
