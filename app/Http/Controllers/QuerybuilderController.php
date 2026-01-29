<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $TotalEmployees = DB::table('employees')->count();
        return view('dashboard', compact('TotalEmployees'));
    }

    public function index()
    {
        $employees = DB::table('employees')->get();
        return view('employee.list-employee', compact('employees'));
    }

    public function add()
    { 
        return view('employee.add-employee'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        DB::table('employees')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'salary' => $request->salary,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('list-employee')
                         ->with('success', 'Employee added successfully!');
    }

    public function edit($id)
    {
        $employee = DB::table('employees')->where('id', $id)->first();
        return view('employee.add-employee', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        DB::table('employees')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'salary' => $request->salary,
            'updated_at' => now(),
        ]);

        return redirect()->route('list-employee')
                         ->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('employees')->where('id', $id)->delete();

        return redirect()->route('list-employee')
                         ->with('success', 'Employee deleted successfully!');
    }
}
