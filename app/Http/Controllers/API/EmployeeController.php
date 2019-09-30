<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;

class EmployeeController extends Controller
{
    public function getEmployees()
    {
        $data = Employee::get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $position = (is_null($request->position)) ? 'Empleado' : $request->position;
        $area = (is_null($request->area)) ? 'Operativa' : $request->area;
        $salary = (integer)$request->salary;

        $data = Employee::create([
            'name' => ucwords(mb_strtolower($request->name)),
            'last_name' => ucwords(mb_strtolower($request->last_name)),
            'email' => $request->email,
            'document' => $request->document,
            'position' => ucwords(strtolower($position)),
            'area' => ucwords(strtolower($area)),
            'salary' => $salary
        ]);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $data = Employee::find($request->id);
        $data->name = ucwords(mb_strtolower($request->name));
        $data->last_name = ucwords(mb_strtolower($request->last_name));
        $data->document = $request->document;
        $data->email = $request->email;
        $data->position = $request->position;
        $data->area = $request->area;
        $data->salary = $request->salary;
        $data->save();
        
        return response()->json($data);
    }

    public function destroy(Request $request, $id)
    {
        $data = Employee::find($id)->delete();
        return response()->json($data);
    }

}
