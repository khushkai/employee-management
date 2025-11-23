<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function dashboard()
    {
      //  echo "hii";
        $TotalEmployees = Employee::count();
        return view('dashboard', compact('TotalEmployees'));
    }

    public function index(){
        // echo "hello";
        $employees = Employee::all();
        return view('employee.list-employee', compact('employees'));
    }

    public function add(){ 
        return view('employee.add-employee'); 
    }

    public function store(Request $request){
    // dd($request->all());exit;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        Employee::create($request->all());
        return redirect()->route('list-employee')->with('success', 'Employee added successfully!');
    }

    public function edit($id){
        $employee = Employee::findOrFail($id);
        return view('employee.add-employee', compact('employee'));
    }

    public function update(Request $request, $id){
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        $employee->update($request->all());
        return redirect()->route('list-employee')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id){
        Employee::destroy($id);
        return redirect()->route('list-employee')->with('success', 'Employee deleted successfully!');
    }
}
