<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeApiController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index()
    {
        return response()->json(Employee::all()); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'position' => 'required|string',
            'salary' => 'required|numeric'
        ]);

        $employee = Employee::create($request->all());

        return response()->json([
            'message' => 'Employee added successfully',
            // 'employee' => $employee
        ], 201); 
    }

    public function show($id)
    {
        return response()->json(Employee::findOrFail($id)); 
    }

    public function update(Request $request, $id)
    {
        $emp = Employee::findOrFail($id);
        $emp->update($request->all());

        return response()->json([
            'message' => 'Employee updated successfully',
        ], 200); 
    }

    public function destroy($id)
    {
        Employee::destroy($id);

        return response()->json([
            'message' => 'Deleted successfully']);
    }
}
