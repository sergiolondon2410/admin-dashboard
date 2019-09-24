<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::all();
        // dd($employees);

        return view('employees.index', compact('employees'));
    }

    // public function show(){
        
    // }

    public function destroy(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
