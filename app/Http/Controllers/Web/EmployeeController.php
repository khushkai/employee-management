<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // public function __construct()
    //     {
    //         $this->middleware('auth');
    //     }

    public function dashboard()
    {
      //  echo "hii";
    //   if (auth()->user()->role !== 'admin') {
    //         abort(403, 'Unauthorized action.');
    //     }
        $TotalEmployees = Employee::count();
        return view('dashboard', compact('TotalEmployees'));
    }

    public function index(){
        // echo "hello";
        $employees = Employee::all();
        return view('employee.list-employee', compact('employees'));
    }

    public function add(){ 
           // Only admin can add
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('employee.add-employee'); 
    }

    public function store(Request $request){

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        // Employee::create($request->all());
         Employee::create([
        'name' => strip_tags($request->name),
        'email' => $request->email,
        'position' => strip_tags($request->position),
        'salary' => $request->salary,
    ]);

    return redirect()->route('list-employee')
                     ->with('success', 'Employee added successfully!');
        
    }

    public function edit($id){
         if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $employees = Employee::findOrFail($id);
        return view('employee.add-employee', compact('employees'));
    }

    public function update(Request $request, $id)
    {
        //  $this->authorize('update', $employee);

         if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized action.');
            }
        $employees = Employee::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employees->id,
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);
        // $employee->update($request->all());
        $employees->update([
            'name' => strip_tags($request->name),
            'email' => $request->email,
            'position' => strip_tags($request->position),
            'salary' => $request->salary,
        ]);

        return redirect()->route('list-employee')
                        ->with('success', 'Employee updated successfully!');
    }

//    public function destroy($id){
//         Employee::destroy($id);
//         return redirect()->route('list-employee')->with('success', 'Employee deleted successfully!');
//     }

    public function destroy($id)
    {
        // $this->authorize('delete', $employee);
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('list-employee')
                        ->with('success', 'Employee deleted successfully!');
    }

}
        
 
