<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function getUsers()
    {
        $data = User::get();
        return response()->json($data);
    }

    // public function store(Request $request)
    // {
    //     $position = (is_null($request->position)) ? 'Empleado' : $request->position;
    //     $area = (is_null($request->area)) ? 'Operativa' : $request->area;

    //     $data = User::create([
    //         'name' => ucwords(strtolower($request->name)),
    //         'last_name' => ucwords(strtolower($request->last_name)),
    //         'email' => $request->email,
    //         'document' => $request->document,
    //         'position' => ucwords(strtolower($position)),
    //         'area' => ucwords(strtolower($area)),
    //         'salary' => $request->salary,
    //     ]);
    //     return response()->json($data);
    //     return $data;
    // }

    // public function update(Request $request){
    //     $data = User::find($request->id);
    //     $data->name = ucwords(strtolower($request->name));
    //     $data->last_name = ucwords(strtolower($request->last_name));
    //     $data->document = $request->document;
    //     $data->email = $request->email;
    //     $data->position = $request->position;
    //     $data->area = $request->area;
    //     $data->salary = $request->salary;
    //     $data->save();
        
    //     return $data;
    // }

    // public function destroy(Request $request, $id){
    //     $data = User::find($id)->delete();
    //     return response()->json($data);
    // }

}
