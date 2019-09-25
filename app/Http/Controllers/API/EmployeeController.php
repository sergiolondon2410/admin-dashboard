<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee as Employee;

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

        // $data = Employee::create([
        //     'name' => ucwords(strtolower($request->name)),
        //     'last_name' => ucwords(strtolower($request->last_name)),
        //     'email' => $request->email,
        //     'document' => $request->document,
        //     'position' => ucwords(strtolower($position)),
        //     'area' => ucwords(strtolower($area)),
        //     'salary' => $request->salary,
        // ]);
        $data = new Employee;
        $data->name = ucwords(strtolower($request->name));
        $data->last_name = ucwords(strtolower($request->last_name));
        $data->document = $request->document;
        $data->email = $request->email;
        $data->position = ucwords(strtolower($position));
        $data->area = ucwords(strtolower($area));
        $data->salary = $request->salary;
        $data->save();

        return response()->json($data);
        return $data;
    }

    public function update(Request $request){
        $data = Employee::find($request->id);
        $data->name = ucwords(strtolower($request->name));
        $data->last_name = ucwords(strtolower($request->last_name));
        $data->document = $request->document;
        $data->email = $request->email;
        $data->position = $request->position;
        $data->area = $request->area;
        $data->salary = $request->salary;
        $data->save();
        
        return $data;
    }

    public function destroy(Request $request, $id){
        $data = Employee::find($id)->delete();
        return response()->json($data);
    }

}
