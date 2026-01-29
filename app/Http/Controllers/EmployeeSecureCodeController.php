<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $TotalEmployees = Employee::count();
        return view('dashboard', compact('TotalEmployees'));
    }

    public function index()
    {
        $employees = Employee::all();
        return view('employee.list-employee', compact('employees'));
    }

    public function add()
    { 
        // Only admin can add
        try {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized action.');
            }
            return view('employee.add-employee'); 
        } catch (\Exception $e) {
            return redirect()->route('list-employee')->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Admin check
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized action.');
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email',
                'position' => 'required|string|max:255',
                'salary' => 'required|numeric|min:0',
            ]);

            Employee::create([
                'name' => strip_tags($request->name),
                'email' => $request->email,
                'position' => strip_tags($request->position),
                'salary' => $request->salary,
            ]);

            return redirect()->route('list-employee')
                             ->with('success', 'Employee added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            // Admin check
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized action.');
            }

            $employee = Employee::findOrFail($id);
            return view('employee.add-employee', compact('employee'));
        } catch (\Exception $e) {
            return redirect()->route('list-employee')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Admin check
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized action.');
            }

            $employee = Employee::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email,' . $employee->id,
                'position' => 'required|string|max:255',
                'salary' => 'required|numeric|min:0',
            ]);

            $employee->update([
                'name' => strip_tags($request->name),
                'email' => $request->email,
                'position' => strip_tags($request->position),
                'salary' => $request->salary,
            ]);

            return redirect()->route('list-employee')
                             ->with('success', 'Employee updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }
// public function update(Request $request, $id)
// {
//     try {
//         $request->validate([
//             'name' => 'required',
//         ]);

//         User::findOrFail($id)->update(
//             $request->only(['name','email'])
//         );

//         return back()->with('success','Updated');

//     } catch (\Exception $e) {
//         return back()->with('error',$e->getMessage());
//     }
// }

    public function destroy($id)
    {
        try {
            // Admin check
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized action.');
            }

            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect()->route('list-employee')
                             ->with('success', 'Employee deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('list-employee')->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

}
