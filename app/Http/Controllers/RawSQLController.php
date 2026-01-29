<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $TotalEmployees = DB::select("SELECT COUNT(*) AS total FROM employees")[0]->total;
        return view('dashboard', compact('TotalEmployees'));
    }

    public function index()
    {
        $employees = DB::select("SELECT * FROM employees");
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

        DB::insert(
            "INSERT INTO employees (name, email, position, salary, created_at, updated_at) 
             VALUES (?, ?, ?, ?, NOW(), NOW())",
            [
                $request->name,
                $request->email,
                $request->position,
                $request->salary,
            ]
        );

        return redirect()->route('list-employee')
                         ->with('success', 'Employee added successfully!');
    }

    public function edit($id)
    {
        $employee = DB::select("SELECT * FROM employees WHERE id = ?", [$id]);
        return view('employee.add-employee', ['employee' => $employee[0]]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        DB::update(
            "UPDATE employees SET name = ?, email = ?, position = ?, salary = ?, updated_at = NOW() WHERE id = ?",
            [
                $request->name,
                $request->email,
                $request->position,
                $request->salary,
                $id
            ]
        );

        return redirect()->route('list-employee')
                         ->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        DB::delete("DELETE FROM employees WHERE id = ?", [$id]);

        return redirect()->route('list-employee')
                         ->with('success', 'Employee deleted successfully!');
    }
}
